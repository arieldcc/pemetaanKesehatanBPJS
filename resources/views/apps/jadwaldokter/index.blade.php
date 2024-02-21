@extends('layouts.master')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ url('/') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center"> <!-- Tambahkan flexbox untuk alignment -->
                    <h4 class="card-title m-0">{{ $title }}</h4>
                    <a href="tambah-jadwal" class="btn btn-primary btn-fill btn-wd"> <!-- Hapus float-right jika menggunakan flexbox -->
                        <span class="btn-label">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        Tambah Data
                    </a>
                </div>
            </div>
            <div class="card-body ">
                <div class="d-flex"></div>
                <div class="clearfix"></div>

                <table class="table table-responsive table-hover table-striped table-wd" width="100%" cellspacing="0" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Dokter</th>
                            <th>Tempat Kerja</th>
                            <th>Jadwal Praktek Dokter</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama Dokter</th>
                            <th>Tempat Kerja</th>
                            <th>Jadwal Praktek Dokter</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td align="center">{{ $no++ }}</td>
                                <td>{{ $item->dokter->nama_dokter }}</td>
                                <td>{{ $item->dokter->fasilitasKesehatan->nama_fasilitas }}</td>
                                <td>{{ $item->hari.' | '.$item->jam_mulai.' s/d '.$item->jam_selesai }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    <a href="/data-jadwal/{{ $item->id }}/edit"
                                        class="btn btn-info btn-fill btn-sm">
                                        {{-- <i class="fas fa-info-fill"></i> --}}
                                        <i class="far fa-edit"></i>
                                    </a> &nbsp;
                                    <a href="#" class="btn btn-danger btn-fill btn-sm hapus"
                                        jadwal-id="{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-history"></i>Last Update at: {{ $lastUpdatedTime }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="{{ url('/') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ url('/') }}/js/demo/datatables-demo.js"></script>
    <script src="{{ url('/') }}/js/sweetalert.min.js"></script>

    <script>
        $('.hapus').click(function() {
            var jadwal_id = $(this).attr('jadwal-id')

            swal({
                    title: "Yakin ?",
                    text: "Data akan di hapus?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/data-jadwal/" + jadwal_id + "/delete";
                    }
                });
        });
    </script>
@endsection
