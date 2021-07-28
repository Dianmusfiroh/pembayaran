@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('pengaturan/sumber-anggaran'))
@section('form-create')
<form action="{{ route('sumber-anggaran.update',$sumber->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-body')
    <!-- <h3 class="title text-left">Nama Provinsi</h3> -->
    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Provinsi"
        value="{{$sumber->nama}}">
    @endsection