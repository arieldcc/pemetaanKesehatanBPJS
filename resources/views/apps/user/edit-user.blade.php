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
                <form method="POST" action="/data-user/{{ $user->id }}/update">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mr-2">
                            <div class="form-group">
                                <label for="name">Nama User</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama User" value="{{ $user->name }}" name="name" id="name">
                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mr-2">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Nama user" value="{{ $user->email }}" name="email" id="email">
                                @if ($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mr-2">
                            <div class="form-group">
                                <label for="reset_passw">
                                    Reset Passsword [Centang jika ingin mereset password]
                                </label>
                                <input class="form-control" value="1" type="checkbox" id="reset_passw"
                                    name="reset_passw">
                            </div>
                        </div>
                    </div>
                    <a href="/data-user" class="btn btn-warning btn-fill btn-icon-split">
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
