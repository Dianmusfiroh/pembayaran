@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save" ><i class="fas fa-fw fa-save"></i> Simpan</button>
@endsection
@section('back-button',url('apps/sk'))
@section('form-create')
    <form action="{{ route('sk.store')}}" method="POST">
        @csrf
@endsection
@section('card-body')

    {{-- <input type="number" name="id" id="id" placeholder="masukan id" class="form-control"> --}}
    <div class="form-group row">
        <div class="label col-md-3">No SK</div>
        <div class="col-md-9">
            <input type="text" name="no_sk" id="no_sk" class="form-control" placeholder="Masukan No SK" required value="{{ old('no_sk') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tanggal Mulai</div>
        <div class="col-md-9">
            <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Masukan Waktu Mulai" required value="{{ old('start_date') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tanggal Selesai</div>
        <div class="col-md-9">
            <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Masukan Waktu Selesai" required value="{{ old('end_date') }}">
        </div>
    </div>

@endsection