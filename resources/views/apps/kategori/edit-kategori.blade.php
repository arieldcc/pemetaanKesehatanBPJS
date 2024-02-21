@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center"> <!-- Tambahkan flexbox untuk alignment -->
                    <h4 class="card-title m-0">{{ $title }}</h4>
                </div>
            </div>
            <div class="card-body ">
                <form method="POST" action="/data-kategori/{{ $kategori->id }}/update" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mr-2">
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Nama Kategori" value="{{ $kategori->nama_kategori }}" name="nama_kategori" id="nama_kategori">
                                @if ($errors->has('nama_kategori'))
                                    <span class="help-block">{{ $errors->first('nama_kategori') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="icon">Marker</label>
                            <input type="hidden" name="oldicon" value="{{ $kategori->icon }}">
                            <input class="form-control @error('icon') is-invalid @enderror" type="file" id="icon" name="icon" onchange="previewImage()">
                            @if ($errors->has('icon'))
                            <span class="help-block">{{ $errors->first('icon') }}</span>
                            @endif
                            <div class="d-flex"></div>
                            @if ($kategori->icon)
                                <img src="{{ asset('storage') .'/'. $kategori->icon }}" alt=""
                                    class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @else
                                <img class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @endif
                        </div>
                    </div>
                    <a href="/data-kategori" class="btn btn-warning btn-fill btn-icon-split">
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
            const image = document.querySelector('#icon');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'blok';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
