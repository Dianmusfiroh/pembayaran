@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('pengaturan/umum'))
@section('form-create')
<form action="{{ route('umum.update',$setting->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-body')
    <!-- <h3 class="title text-left">Nama Provinsi</h3> -->
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $setting->label }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" name="nilai" value="{{ $setting->nilai }}">
        </div>
    </div>
    @endsection