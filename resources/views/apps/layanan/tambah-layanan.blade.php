@extends('layouts.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
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
                <form method="POST" action="/simpan-layanan" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="fasilitas_kesehatan_id">Lokasi Fasilitas Kesehatan</label>
                            <select class="js-example-basic-single form-control @error('fasilitas_kesehatan_id') is-invalid @enderror" id="fasilitas_kesehatan_id" name="fasilitas_kesehatan_id">
                                <option value="">-- Pilih Lokasi Fasilitas Kesehatan --</option>
                                @foreach ($fasilitas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_fasilitas.' | '.$item->alamat }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('fasilitas_kesehatan_id'))
                                <span class="help-block">{{ $errors->first('fasilitas_kesehatan_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nama_layanan">Nama Layanan</label>
                            <input type="text" class="form-control @error('nama_layanan') is-invalid @enderror" placeholder="Nama atau Jenis Layanan" value="{{ old('nama_layanan') }}" name="nama_layanan" id="nama_layanan" disabled>
                            @if ($errors->has('nama_layanan'))
                                <span class="help-block">{{ $errors->first('nama_layanan') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="4" cols="4" name="keterangan" id="keterangan" disabled></textarea>
                            @if ($errors->has('keterangan'))
                            <span class="help-block">{{ $errors->first('keterangan') }}</span>
                            @endif
                        </div>
                    </div>

                    <a href="/data-layanan" class="btn btn-warning btn-fill btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-redo"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
                    <button type="submit" class="btn btn-info btn-fill pull-right">
                        <span class="icon text-white-50">
                            <i class="far fa-save"></i>
                        </span>
                        Tambah Data</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">

        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="card-title m-0">Data Lokasi Fasilitas Kesehatan</h4>
            </div>
            <div class="card-body">

                {{-- Ganti 'path_to_foto_dokter.jpg' dengan variabel dinamis atau path yang sesuai --}}
                <img src="{{ asset('storage') .'/img-lokasifasilitas/avatar_fasilitas.jpg' }}" class="card-img-top rounded-circle mx-auto d-block" alt="Foto Dokter" style="width: 150px; height: 150px; object-fit: cover; margin-top: 0px;">

                <div class="card-body text-center">
                    <h3 class="card-title"><span id="nama_fasilitas">Nama Lokasi Kesehatan</span></h3>
                    <p class="card-text"><strong>Alamat:</strong>&nbsp;<span id="alamat">Jalan contoh alamat no. 123</span></p>
                    <p class="card-text"><strong>No. Telp:</strong>&nbsp;<span id="no_telp">(123) 456-7890</span></p>
                    <p class="card-text"><strong>Email:</strong>&nbsp;<span id="email">info@lokasikesehatan.com</span></p>
                </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        $('#fasilitas_kesehatan_id').change(function() {
            var fasilitas = $(this).val();
            if(fasilitas) {
                $.getJSON('/get-fasilitas/' + fasilitas, function(data) {
                    // console.log(data);
                    $('#nama_fasilitas').text(data.nama_fasilitas);
                    $('#alamat').text(data.alamat);
                    $('#no_telp').text(data.no_telp);
                    $('#email').text(data.email);

                    // Ubah URL foto dokter
                    var newFotoUrl = "{{ asset('storage') }}/" + data.foto; // Ganti dengan path yang benar
                    $('img.card-img-top').attr('src', newFotoUrl);
                });
            }else{
                $('#nama_fasilitas').text('');
                $('#alamat').text('');
                $('#no_telp').text('');
                $('#email').text('');

                // Ubah URL foto dokter
                var newFotoUrl = "{{ asset('storage') }}/img-lokasifasilitas/avatar_fasilitas.jpg";
                $('img.card-img-top').attr('src', newFotoUrl);
            }

            if($(this).val() != "") {
                elmEnabled(false);
            }else{
                elmEnabled(true);
            }
        });

        function elmEnabled(isTrue){
            $('#nama_layanan').prop('disabled', isTrue);
            $('#keterangan').prop('disabled', isTrue);
        }

    </script>
@endsection
