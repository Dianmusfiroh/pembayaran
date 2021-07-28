@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save" ><i class="fas fa-fw fa-save"></i> Simpan</button>
@endsection
@section('back-button',url('master/gtt'))
@section('form-create')
    <form action="{{ route($modul.'.store')}}" method="POST">
        @csrf
@endsection
@section('card-body')
@if($errors->any())
<div class="alert alert-danger">
    <p><strong>Opps Something went wrong</strong></p>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    {{-- <input typ<e="hidden" name="sk_id" value="{{ $sk_id }}"> --}}
    <div class="form-group row">
        <div class="label col-md-3">NIK</div>
        <div class="col-md-9">
            <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukan NIK" required value="{{ old('nik') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">NUPTK</div>
        <div class="col-md-9">
            <input type="text" name="nuptk" id="nuptk" class="form-control" placeholder="Masukan" required value="{{ old('nuptk') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Nama Lengkap</div>
        {{-- <div class="col-md-9"> --}}
            <div class="col-md-2">
                <input type="text" name="title_ahead" id="title_ahead" class="form-control" placeholder="Gelar Depan"  value="{{ old('title_ahead') }}">
            </div>
            <div class="col-md-5">
                <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Masukan Nama Lengkap" required value="{{ old('full_name') }}">
            </div>
            <div class="col-md-2">
                <input type="text" name="back_title" id="back_title" class="form-control" placeholder="Gelar Belakang" required value="{{ old('back_title') }}">
            </div>
        {{-- </div> --}}
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tanggal Lahir</div>
        <div class="col-md-9">
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Masukan Tanggal Lahir" required value="{{ old('date_of_birth') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tempat Lahir</div>
        <div class="col-md-9">
            <select name="place_of_birth" id="place_of_birth" class="form-control" placeholder="Pilih Tempat Lahir">
                <option value="Gorontalo">Gorontalo</option>
                <option value="GorontaloUtara">Gorontalo Utara</option>
                <option value="Pohuwato">Pohuwato</option>
                <option value="BoneBolango">Bone Bolango</option>
                <option value="KotaGorontalo">Kota Gorontalo</option>
                <option value="Boalemo">Boalemo</option>

            </select>
            {{-- <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" placeholder="Masukan Tempat Lahir" required value="{{ old('place_of_birth') }}"> --}}
        </div>
    </div>

    <div class="form-group row">
        <div class="label col-md-3">TMT Kontrak Pertama</div>
        <div class="col-md-9">
            <input type="date" name="tmt_start" id="tmt_start" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">TMT Kontrak Selesai</div>
        <div class="col-md-9">
            <input type="date" name="tmt_end" id="tmt_end" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Nama Bank</div>
        <div class="col-md-9">
            <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Masukan Nama Bank">

        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Nama Akun Bank</div>
        <div class="col-md-9">
            <input type="text" name="account_name" id="account_name" class="form-control" placeholder="Masukan Nama Akun Bank">

        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">No Akun Bank</div>
        <div class="col-md-9">
            <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Masukan No Bank">

        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Institut</div>
        <div class="col-md-9">
            <select name="institute_id" id="institute_id" class="form-control">
                <option value="">Pilih Institus</option>
                @foreach ($institutes as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Qualifikasi</div>
        <div class="col-md-9">
            <select name="qualification_id" id="qualification_id" class="form-control" required>
                <option value="">Pilih Qualifikasi</option>
                @foreach ($qualifications as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Jabatan</div>
        <div class="col-md-9">
            <select name="position_id" id="position_id" class="form-control" required>
                <option value="">Pilih Jabatan</option>
                @foreach ($jabatans as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

@endsection
