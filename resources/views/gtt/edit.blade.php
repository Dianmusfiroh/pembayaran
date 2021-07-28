@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button', url('master/gtt'))
{{-- , $sk_id --}}
{{-- @section('back-button', url()->previous()) --}}
@section('form-create')
<form action="{{ route($modul.'.update', $gtt->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-body')

    <div class="form-group row">
        <div class="label col-md-3">NIK</div>
        <div class="col-md-9">
            <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukan NIK"
                value="{{ $gtt->nik }}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">NUPTK</div>
        <div class="col-md-9">
            <input type="text" name="nuptk" id="nuptk" class="form-control" placeholder="Masukan"
                value="{{ $gtt->nuptk }}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Nama Lengkap</div>
        {{-- <div class="col-md-9"> --}}
        <div class="col-md-2">
            <input type="text" name="title_ahead" id="title_ahead" class="form-control" placeholder="Gelar Depan"
                value="{{ $gtt->title_ahead }}">
        </div>
        <div class="col-md-5">
            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Masukan Nama Lengkap"
                value="{{ $gtt->full_name }}" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="back_title" id="back_title" class="form-control" placeholder="Gelar Belakang"
                value="{{ $gtt->back_title }}" required>
        </div>
        {{-- </div> --}}
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tanggal Lahir</div>
        <div class="col-md-9">
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                placeholder="Masukan Tanggal Lahir" value="{{ $gtt->date_of_birth }}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tempat Lahir</div>
        <div class="col-md-9">
            <input type="text" name="place_of_birth" id="place_of_birth" class="form-control"
                placeholder="Masukan Tempat Lahir" value="{{ $gtt->place_of_birth }}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Nama Bank</div>
        <div class="col-md-9">
            <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Masukan Nama Bank" value="{{ $gtt->bank_name }}" required>

        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Nama Akun Bank</div>
        <div class="col-md-9">
            <input type="text" name="account_name" id="account_name" class="form-control" placeholder="Masukan Nama Akun Bank" value="{{ $gtt->account_name }}" required>

        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">No Akun Bank</div>
        <div class="col-md-9">
            <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Masukan No Bank" value="{{ $gtt->account_number }}" required>

        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Institut</div>
        <div class="col-md-9">
            <select name="institute_id" id="institute_id" class="form-control" required>
                @foreach ($institutes as $item)
                    @if ($item->id == $gtt->institute_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Qualifikasi</div>
        <div class="col-md-9">
            <select name="qualification_id" id="qualification_id" class="form-control" required>
                @foreach ($qualifications as $item)
                    @if ($item->id == $gtt->qualification_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Jabatan</div>
        <div class="col-md-9">
            <select name="position_id" id="position_id" class="form-control" required>
                @foreach ($jabatans as $item)
                    @if ($item->id == $gtt->jabatans_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    @endsection
