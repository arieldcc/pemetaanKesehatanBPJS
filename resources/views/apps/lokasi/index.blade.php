@extends('layouts.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.0.2/Control.FullScreen.min.css" />
    <style>
        #map {
            width: 100%;
            height: 500px;
            border: 1px solid lightgray;
            background-color: #f9f9f9;
        }

        .img-flag {
            height: 20px; /* or any size you prefer */
            width: auto;
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">{{ $title }}</h4>
                </div>
            </div>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="categoryFilter">Mengelompokkan Data berdasarkan Kategori</label>
                        <div class="card-body ">
                            <select id="categoryFilter" style="width: 100%;" class="js-example-basic-single form-control">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $category)
                                    <option value="{{ $category->id }}" data-icon="{{ $category->icon }}">{{ $category->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="searchInput">Cari Lokasi dan Layanan</label>
                        <div class="card-body">
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari Lokasi">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div id="map"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.0.2/Control.FullScreen.min.js"></script>

    <script>
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        var Stadia_Dark = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
            });

        var Esri_WorldStreetMap = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
            });

        var map = L.map('map', {
            center: [0.553839, 123.049102],
            zoom: 12,
            layers: [osm]
        });

        var baseUrl = "{{ asset('storage') }}/";
        var markers = L.markerClusterGroup();

        function addMarkers(facilities) {
            markers.clearLayers();
            facilities.forEach(function(facility) {
                if(facility.latitude && facility.longitude) {
                    var customIcon = L.icon({
                        iconUrl: baseUrl + facility.kategori.icon,
                        iconSize: [38, 38],
                        popupAnchor: [0, -28]
                    });

                    var marker = L.marker([facility.latitude, facility.longitude], {icon: customIcon});
                    marker.bindPopup(getPopupContent(facility));
                    markers.addLayer(marker);
                }
            });
            map.addLayer(markers);
        }

        function getPopupContent(facility) {
            var content = '<table>' +
                  '<tr><td colspan="2"><b>' + facility.nama_fasilitas + '</b></td></tr>' +
                  '<tr><td colspan="2"><img src="'+baseUrl + facility.foto + '" style="width: 150px; height: 150px; object-fit: cover; margin-top: 0px;" class="card-img-top rounded-circle mx-auto d-block"></td></tr>' +
                  '<tr><td>Alamat</td><td>: ' + facility.alamat + '</td></tr>'+
                  '<tr><td>No. Telp.</td><td>: ' + facility.no_telp + '</td></tr>'+
                  '<tr><td>E-Mail</td><td>: ' + facility.email + '</td></tr>';

            facility.dokter.forEach(function(doctor) {
                content += '<tr><td colspan="2"><h4>Dr. ' + doctor.nama_dokter + ' (' + doctor.spesialis + ')</h4></td></tr>' +
                        '<tr><td colspan="2"><img src="'+baseUrl + doctor.foto + '" style="width: 150px; height: 150px; object-fit: cover; margin-top: 0px;" class="card-img-top rounded-circle mx-auto d-block"></td></tr>'+
                        '<tr><td>No. Telp.</td><td>: ' + doctor.no_telp + '</td></tr>'+
                  '<tr><td>E-Mail</td><td>: ' + doctor.email + '</td></tr>';
                doctor.jadwal_dokter.forEach(function(schedule) {
                    content += '<tr><td>' + schedule.hari + ':</td><td>' + schedule.jam_mulai + ' - ' + schedule.jam_selesai + '</td></tr>';
                });
            });

            facility.layanan.forEach(function(service) {
                content += '<tr><td>Layanan Kesehatan </td><td>: ' + service.nama_layanan + '</td></tr>'+
                '<tr><td>Keterangan </td><td>: ' + service.keterangan + '</td></tr>';
            });

            content += '</table>';

            return content;
        }

        $(document).ready(function() {
            function formatCategory (category) {
                if (!category.id) {
                    return category.text;
                }
                var $category = $(
                    '<span><img src="'+baseUrl + $(category.element).data('icon') + '" class="img-flag" /> ' + category.text + '</span>'
                );
                return $category;
            };

            $('#categoryFilter').select2({
                templateResult: formatCategory
            });

            $('#searchInput').on('keypress', function(event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                }
            });

            $('#categoryFilter, #searchInput').on('change keyup', function() {
                var selectedCategory = $('#categoryFilter').val();
                var searchQuery = $('#searchInput').val();

                $.ajax({
                    url: '{{ route("cariLokasi") }}',
                    type: 'GET',
                    data: {
                        kategori_id: selectedCategory,
                        search: searchQuery
                    },
                    success: function(data) {
                        addMarkers(data);
                    }
                });
            });

            // Load initial markers
            $.ajax({
                url: '{{ route("cariLokasi") }}',
                type: 'GET',
                success: function(data) {
                    addMarkers(data);
                }
            });
        });

        var baseMaps = {
            'Open Street Map': osm,
            'Esri World': Esri_WorldStreetMap,
            'Stadia Dark': Stadia_Dark
        };

        L.control.layers(baseMaps).addTo(map);
    </script>
@endsection

