@extends('layouts.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center"> <!-- Tambahkan flexbox untuk alignment -->
                    <h4 class="card-title m-0">{{ $title }}</h4>
                </div>
            </div>
            <div class="card-body ">
                <form method="POST" action="/data-dokter/{{ $dokter->id }}/update" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nama Dokter</label>
                            <input type="text" class="form-control @error('nama_dokter') is-invalid @enderror" placeholder="Nama Dokter" value="{{ $dokter->nama_dokter }}" name="nama_dokter" id="nama_dokter">
                            @if ($errors->has('nama_dokter'))
                                <span class="help-block">{{ $errors->first('nama_dokter') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fasilitas_kesehatan_id">Tempat Kerja Dokter</label>
                            <select class="js-example-basic-single form-control @error('fasilitas_kesehatan_id') is-invalid @enderror" id="fasilitas_kesehatan_id" name="fasilitas_kesehatan_id">
                                <option value="">-- Pilih Fasilitas Kesehatan --</option>
                                @foreach ($fasilitas as $item)
                                    <option value="{{ $item->id }}" {{ $item->id==$dokter->fasilitas_kesehatan_id ? 'selected' : '' }}>{{ $item->nama_fasilitas.' | '.$item->alamat }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('fasilitas_kesehatan_id'))
                                <span class="help-block">{{ $errors->first('fasilitas_kesehatan_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Spesialis Dokter</label>
                            <input type="text" class="form-control @error('spesialis') is-invalid @enderror" placeholder="Spesialis Dokter" value="{{ $dokter->spesialis }}" name="spesialis" id="spesialis">
                            @if ($errors->has('spesialis'))
                                <span class="help-block">{{ $errors->first('spesialis') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Nomor Telp.</label>
                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror" placeholder="Nomor Telp." value="{{ $dokter->no_telp }}" name="no_telp" id="no_telp">
                            @if ($errors->has('no_telp'))
                                <span class="help-block">{{ $errors->first('no_telp') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>E-Mail</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="E-Mail" value="{{ $dokter->email }}" name="email" id="email">
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="foto">Foto Dokter</label>
                            <input type="hidden" name="oldfoto" value="{{ $dokter->foto }}">
                            <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto" onchange="previewImage()">
                            @if ($errors->has('foto'))
                            <span class="help-block">{{ $errors->first('foto') }}</span>
                            @endif
                            <div class="d-flex"></div>
                            @if ($dokter->foto)
                                <img src="{{ asset('storage') .'/'. $dokter->foto }}" alt=""
                                    class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @else
                                <img class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @endif
                        </div>
                    </div>

                    <a href="/data-dokter" class="btn btn-warning btn-fill btn-icon-split">
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
