@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('pengaturan/sumber-anggaran'))
@section('form-create')
<form action="{{ route('umum.store')}}" method="POST">
    @csrf
    @endsection
    @section('card-body')
    <!-- <h3 class="title text-left">Nama Provinsi</h3> -->
    <input type="text" name="nama" id="nama" class="form-control" placeholder="Sumber Anggaran">
    @endsection