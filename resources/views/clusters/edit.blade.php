@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('master/cluster'))
@section('form-create')
<form action="{{ route('cluster.update', $cluster->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-body')
    <!-- <h3 class="title text-left">Nama Provinsi</h3> -->
    {{-- @foreach ($cluster as $item) --}}
    <input type="text" name="name" id="name" class="form-control" placeholder="Masukan cluster"
        value=" {{ $cluster->name }} ">
    @endsection