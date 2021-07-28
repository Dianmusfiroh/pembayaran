@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('master/qualifikasi'))
@section('form-create')
<form action="{{ route('qualifikasi.store')}}" method="POST">
    @csrf
    @endsection
    @section('card-body')
    <!-- <h3 class="title text-left">Nama Provinsi</h3> -->
    <input type="text" name="name" id="name" class="form-control" placeholder="Masukan Nama Qualifikasi" required>
    <input type="text" name="description" id="name" class="form-control mt-2" placeholder="Masukan Deskripsi" required>
    @endsection