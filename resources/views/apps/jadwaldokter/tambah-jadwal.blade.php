@extends('layouts.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                <form method="POST" action="/simpan-jadwal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="dokter_id">Nama Dokter</label>
                            <select class="js-example-basic-single form-control @error('dokter_id') is-invalid @enderror" id="dokter_id" name="dokter_id">
                                <option value="">-- Pilih Nama Dokter --</option>
                                @foreach ($dokter as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_dokter.' | '.$item->fasilitasKesehatan->nama_fasilitas }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('dokter_id'))
                                <span class="help-block">{{ $errors->first('dokter_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Hari Kerja</label>
                            <input type="text" class="form-control @error('hari') is-invalid @enderror" placeholder="Hari Kerja. cth. Senin s/d Jumat" value="{{ old('hari') }}" name="hari" id="hari" disabled>
                            @if ($errors->has('hari'))
                                <span class="help-block">{{ $errors->first('hari') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Jam Buka</label>
                            <input type="text" class="form-control @error('jam_mulai') is-invalid @enderror" placeholder="Jam Buka. cth: 07.30" value="{{ old('jam_mulai') }}" name="jam_mulai" id="jam_mulai" disabled>
                            @if ($errors->has('jam_mulai'))
                                <span class="help-block">{{ $errors->first('jam_mulai') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Jam Tutup/Selesai</label>
                            <input type="text" class="form-control @error('jam_selesai') is-invalid @enderror" placeholder="Jam Tutup/Selesai" value="{{ old('jam_selesai') }}" name="jam_selesai" id="jam_selesai" disabled>
                            @if ($errors->has('jam_selesai'))
                                <span class="help-block">{{ $errors->first('jam_selesai') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="4" cols="4" name="keterangan" id="keterangan" disabled></textarea>
                            @if ($errors->has('keterangan'))
                            <span class="help-block">{{ $errors->first('keterangan') }}</span>
                            @endif
                        </div>
                    </div>

                    <a href="/data-jadwal" class="btn btn-warning btn-fill btn-icon-split">
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

    <div class="col-lg-4">

        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="card-title m-0">Data Dokter</h4>
            </div>
            <div class="card-body">

                {{-- Ganti 'path_to_foto_dokter.jpg' dengan variabel dinamis atau path yang sesuai --}}
                <img src="{{ asset('storage') .'/img-dokter/avatar_dokter.png' }}" class="card-img-top rounded-circle mx-auto d-block" alt="Foto Dokter" style="width: 150px; height: 150px; object-fit: cover; margin-top: 0px;">

                <div class="card-body text-center">
                    {{-- Ganti 'Nama Dokter' dan data lain dengan data dinamis yang sesuai --}}
                    <h3 class="card-title"><span id="nama_dokter"></span></h3>
                    <p class="card-text"><strong>Spesialisasi:</strong>&nbsp;<span id="spesialis"></span></p>
                    <p class="card-text"><strong>No. Telp:</strong>&nbsp;<span id="no_telp"></span></p>
                    <p class="card-text"><strong>Email:</strong>&nbsp;<span id="email"></span></p>
                </div>

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

        $('#dokter_id').change(function() {
            var dokter = $(this).val();
            if(dokter) {
                $.getJSON('/get-dokter/' + dokter, function(data) {
                    // console.log(data);
                    $('#nama_dokter').text(data.nama_dokter);
                    $('#spesialis').text(data.spesialis);
                    $('#no_telp').text(data.no_telp);
                    $('#email').text(data.email);

                    // Ubah URL foto dokter
                    var newFotoUrl = "{{ asset('storage') }}/" + data.foto; // Ganti dengan path yang benar
                    $('img.card-img-top').attr('src', newFotoUrl);
                });
            }else{
                $('#nama_dokter').text('');
                $('#spesialis').text('');
                $('#no_telp').text('');
                $('#email').text('');

                // Ubah URL foto dokter
                var newFotoUrl = "{{ asset('storage') }}/img-dokter/avatar_dokter.png";
                $('img.card-img-top').attr('src', newFotoUrl);
            }

            if($(this).val() != "") {
                elmEnabled(false);
            }else{
                elmEnabled(true);
            }
        });

        function elmEnabled(isTrue){
            $('#hari').prop('disabled', isTrue);
            $('#jam_mulai').prop('disabled', isTrue);
            $('#jam_selesai').prop('disabled', isTrue);
            $('#keterangan').prop('disabled', isTrue);
        }

    </script>
@endsection
