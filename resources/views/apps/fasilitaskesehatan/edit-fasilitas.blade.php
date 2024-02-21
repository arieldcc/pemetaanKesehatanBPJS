@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        #map {
            width: 100%;
            height: 380px;
            border: 1px solid lightgray;
            background-color: #f9f9f9;
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center"> <!-- Tambahkan flexbox untuk alignment -->
                    <h4 class="card-title m-0">{{ $title }}</h4>
                </div>
            </div>
            <div class="card-body ">
                <form method="POST" action="/data-fasilitas/{{ $fasilitas->id }}/update" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kategori_id">Kategori</label>
                            <select class="js-example-basic-single form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" {{ $item->id==$fasilitas->kategori_id ? 'selected' : '' }}>{{ $item->nama_kategori }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('kategori_id'))
                                <span class="help-block">{{ $errors->first('kategori_id') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Nama Fasilitas</label>
                            <input type="text" class="form-control @error('nama_fasilitas') is-invalid @enderror" placeholder="Nama Fasilitas" value="{{ $fasilitas->nama_fasilitas }}" name="nama_fasilitas" id="nama_fasilitas" disabled>
                            @if ($errors->has('nama_fasilitas'))
                                <span class="help-block">{{ $errors->first('nama_fasilitas') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" value="{{ $fasilitas->alamat }}" name="alamat" id="alamat" disabled>
                            @if ($errors->has('alamat'))
                                <span class="help-block">{{ $errors->first('alamat') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Kota</label>
                            <input type="text" class="form-control @error('kota') is-invalid @enderror" placeholder="Kota" value="{{ $fasilitas->kota }}" name="kota" id="kota" disabled>
                            @if ($errors->has('kota'))
                                <span class="help-block">{{ $errors->first('kota') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Propinsi</label>
                            <input type="text" class="form-control @error('propinsi') is-invalid @enderror" placeholder="Propinsi" value="{{ $fasilitas->propinsi }}" name="propinsi" id="propinsi" disabled>
                            @if ($errors->has('propinsi'))
                                <span class="help-block">{{ $errors->first('propinsi') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Kode Pos</label>
                            <input type="number" class="form-control @error('kode_pos') is-invalid @enderror" placeholder="Kode Pos" value="{{ $fasilitas->kode_pos }}" name="kode_pos" id="kode_pos" disabled>
                            @if ($errors->has('kode_pos'))
                                <span class="help-block">{{ $errors->first('kode_pos') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Nomor Telp.</label>
                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror" placeholder="Nomor Telp." value="{{ $fasilitas->no_telp }}" name="no_telp" id="no_telp" disabled>
                            @if ($errors->has('no_telp'))
                                <span class="help-block">{{ $errors->first('no_telp') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>E-Mail</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="E-Mail" value="{{ $fasilitas->email }}" name="email" id="email" disabled>
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Latitude</label>
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror" placeholder="Latitude" value="{{ $fasilitas->latitude }}" name="latitude" id="latitude" disabled>
                            @if ($errors->has('latitude'))
                                <span class="help-block">{{ $errors->first('latitude') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Longitude</label>
                            <input type="text" class="form-control @error('longitude') is-invalid @enderror" placeholder="Longitude" value="{{ $fasilitas->longitude }}" name="longitude" id="longitude" disabled>
                            @if ($errors->has('longitude'))
                                <span class="help-block">{{ $errors->first('longitude') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="foto">Foto Lokasi</label>
                            <input type="hidden" name="oldfoto" value="{{ $fasilitas->foto }}">
                            <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto" onchange="previewImage()">
                            @if ($errors->has('foto'))
                            <span class="help-block">{{ $errors->first('foto') }}</span>
                            @endif
                            <div class="d-flex"></div>
                            @if ($fasilitas->foto)
                                <img src="{{ asset('storage') .'/'. $fasilitas->foto }}" alt=""
                                    class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @else
                                <img class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @endif
                        </div>
                    </div>

                    <a href="/data-fasilitas" class="btn btn-warning btn-fill btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-redo"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
                    <button type="submit" class="btn btn-info btn-fill pull-right">
                        <span class="icon text-white-50">
                            <i class="far fa-save"></i>
                        </span>
                        Update Data</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">

        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="card-title m-0">Peta</h4>
            </div>
            <div class="card-body">

                <form method="POST">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div id="map"></div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    function previewImage() {
        const image = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'blok';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

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
        })

        $(document).ready(function() {
            // Cek apakah nilai dari #kategori_id tidak kosong ketika halaman dimuat
            if ($('#kategori_id').val() != "") {
                elmEnabled(false); // Jika tidak kosong, aktifkan semua elemen dengan elmEnabled(false)
            } else {
                elmEnabled(true); // Jika kosong, non-aktifkan semua elemen dengan elmEnabled(true)
            }

            // Sisa kode...
        });


        var baseUrl = "{{ asset('storage') }}";
        var kategoriIconUrl = "{{ asset('storage/'.$fasilitas->kategori->icon) }}"; // Pastikan path ini benar
        var latitude = {{ $fasilitas->latitude }};
        var longitude = {{ $fasilitas->longitude }};

        var customIcon = L.icon({
            iconUrl: kategoriIconUrl,
            iconSize: [42, 42]  // Sesuaikan ukuran jika perlu
        });


        var marker = L.marker([latitude, longitude], {
            draggable: true, icon: customIcon
        }).addTo(map);

        var setIcon;
        // var baseUrl = "{{ asset('storage') }}";

        $('#kategori_id').change(function() {
            var kategori = $(this).val();
            if(kategori) {
                $.getJSON('/get-icon/' + kategori, function(data) {
                    if(data && data.icon){
                        // console.log("{{ asset('storage') }}"+"/"+data.icon);
                        setIcon = data.icon;
                        customIcon = L.icon({
                            iconUrl: baseUrl+"/"+setIcon,  // Path ke gambar ikon Anda
                            iconSize: [42, 42]
                        });
                        // console.log(customIcon);
                        // Jika marker sudah ada, update ikonnya
                        if (marker) {
                            marker.setIcon(customIcon);
                        }
                    }
                });
            }
            if($(this).val() != "") {
                elmEnabled(false);
            }else{
                elmEnabled(true);
                customIcon = L.icon({
                    iconUrl: baseUrl+"/img-marker/default.png",  // Path ke gambar ikon Anda
                    iconSize: [42, 42]
                });
                if (marker) {
                    marker.setIcon(customIcon);
                }
            }
        });

        function elmEnabled(isTrue){
            $('#nama_fasilitas').prop('disabled', isTrue);
            $('#alamat').prop('disabled', isTrue);
            $('#kota').prop('disabled', isTrue);
            $('#propinsi').prop('disabled', isTrue);
            $('#kode_pos').prop('disabled', isTrue);
            $('#no_telp').prop('disabled', isTrue);
            $('#email').prop('disabled', isTrue);
            $('#latitude').prop('disabled', isTrue);
            $('#longitude').prop('disabled', isTrue);
        }

        var baseMaps = {
            'Open Street Map': osm,
            'Esri World': Esri_WorldStreetMap,
            'Stadia Dark': Stadia_Dark
        }

        L.control.layers(baseMaps).addTo(map)

        // CARA PERTAMA
        function onMapClick(e) {
            // var nama_jalan  = document.querySelector("[name=nama_jalan]")
            var latitude  = document.querySelector("[name=latitude]")
            var longitude  = document.querySelector("[name=longitude]")
            var lat = e.latlng.lat
            var lng = e.latlng.lng
            // var addr = e.address.road

            if (!marker) {
                marker = L.marker(e.latlng, {icon: customIcon}).addTo(map)
            } else {
                marker.setLatLng(e.latlng)
            }

            // nama_jalan.value = addr
            latitude.value = lat,
            longitude.value = lng
        }
        map.on('click',onMapClick)

    </script>
@endsection
