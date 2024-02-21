@extends('layouts.master')

@section('content')
<div class="container-fluid">
    {{-- Pastikan Font Awesome terintegrasi dalam proyek Anda --}}

<div class="row">
    <!-- Panel Kategori -->
    <div class="col-lg-4 col-md-12 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="my-0 font-weight-normal">Kategori</h4>
                <i class="fas fa-tags fa-2x text-gray-300"></i> {{-- Contoh ikon kategori --}}
            </div>
            <div class="card-body">
                <div class="h3 mb-0 font-weight-bold text-gray-800">
                    {{ $data['kategoriCount'] }}
                </div>
            </div>
        </div>
    </div>

    <!-- Panel Fasilitas Kesehatan -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="my-0 font-weight-normal">Fasilitas Kesehatan</h4>
                <i class="fas fa-hospital fa-2x text-gray-300"></i> {{-- Contoh ikon fasilitas kesehatan --}}
            </div>
            <div class="card-body">
                <div class="h3 mb-0 font-weight-bold text-gray-800">
                    {{ $data['fasilitasCount'] }}
                </div>
            </div>
        </div>
    </div>

    <!-- Panel Dokter -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="my-0 font-weight-normal">Dokter</h4>
                <i class="fas fa-user-md fa-2x text-gray-300"></i> {{-- Contoh ikon dokter --}}
            </div>
            <div class="card-body">
                <div class="h3 mb-0 font-weight-bold text-gray-800">
                    {{ $data['dokterCount'] }}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="my-0 font-weight-normal">Jadwal Dokter</h4>
                <i class="fas fa-calendar-alt fa-2x text-gray-300"></i> {{-- Ganti dengan ikon pilihan Anda --}}
            </div>
            <div class="card-body">
                <div class="h3 mb-0 font-weight-bold text-gray-800" id="jmllayanan">
                    {{ $data['jadwalCount'] }}
                </div>
            </div>
        </div>
    </div>

    <!-- Panel Layanan Fasilitas Kesehatan -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="my-0 font-weight-normal">Layanan Fasilitas Kesehatan</h4>
                <i class="fas fa-stethoscope fa-2x text-gray-300"></i> {{-- Ganti dengan ikon pilihan Anda --}}
            </div>
            <div class="card-body">
                <div class="h3 mb-0 font-weight-bold text-gray-800" id="jmlLayanan">
                    {{ $data['layananCount'] }}
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
