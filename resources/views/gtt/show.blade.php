@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button', url('master/gtt'))
@section('form-create')
<form action="{{ route($modul.'.update',$gtt->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-body')

    {{-- <div class="form-group row">
        <div class="label col-md-3">NO SK</div>
        <div class="col-md-9">
            <select name="sk_id" id="sk_id" class="form-control" disabled>
                @foreach ($sks as $item)
                    <option value="{{ $item->id }}">{{ $item->no_sk }}</option>
                @endforeach
            </select>
        </div> --}}
    </div>
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
                value="{{ $gtt->title_ahead }}" required>
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
        <div class="label col-md-12 pl-5">TMT ( Terhitung Mulai Tanggal )
            <hr>
        </div>

    </div>

    {{-- <div class="form-group row">
        <div class="label col-md-3">TMT Mulai</div>
        <div class="col-md-9">
        @foreach ($sks as $item)
            <input type="date" name="tmt_start" id="tmt_start" class="form-control" value="{{ $item->start_date }}" required disabled>
        @endforeach
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">TMT Selesai</div>
        <div class="col-md-9">
        @foreach ($sks as $item)
            <input type="date" name="tmt_end" id="tmt_end" class="form-control" value="{{ $item->end_date }}" required disabled>
        @endforeach
        </div>
    </div> --}}
    <div class="form-group row">
        <div class="label col-md-3">TMT Mulai</div>
        <div class="col-md-9">
            <input type="date" name="tmt_start" id="tmt_start" class="form-control" placeholder="Masukan"
                value="{{ $gtt->tmt_start }}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">TMT Selesai</div>
        <div class="col-md-9">
            <input type="date" name="tmt_end" id="tmt_end" class="form-control" placeholder="Masukan"
                value="{{ $gtt->tmt_end }}" required>
        </div>
    </div>
    {{-- <div class="form-group row">
        <div class="label col-md-3">Institut</div>
        <div class="col-md-9">
            <select name="institute_id" id="institute_id" class="form-control" required>
                <option value="">Pilih Institus</option>
                @foreach ($institutes as $item)
                    {{-- @if ($item->id == $gtt->institutes->id) --}}
                        {{-- <option value="{{ $item->id }}" selected>{{ $item->name }}</option>                         --}}
                    {{-- @else --}}
                        {{-- <option value="{{ $item->id }}">{{ $item->name }}</option> --}}
                    {{-- @endif --}}
                {{-- @endforeach --}}
            {{-- </select> --}}
        {{-- </div> --}}
    {{-- </div> --}} --}}
    {{-- <div class="form-group row">
        <div class="label col-md-3">Qualifikasi</div>
        <div class="col-md-9">
            <select name="qualification_id" id="qualification_id" class="form-control" required>
                {{-- <option value="">Pilih Qualifikasi</option> --}}
                {{-- @foreach ($qualifications as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div> --}}

    {{-- @endsection --}}
