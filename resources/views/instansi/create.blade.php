@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('master/instansi'))
@section('form-create')
<form action="{{ route('instansi.store')}}" method="POST">
    @csrf
    @endsection
    @section('card-body')
    <!-- <h3 class="title text-left">Nama Provinsi</h3> -->
    <input type="text" name="npsn" id="name" class="form-control" placeholder="Masukan NPSN">
    <input type="text" name="name" id="name" class="form-control mt-2" placeholder="Masukan Nama Sekolah">
    <input type="text" name="address" id="name" class="form-control mt-2" placeholder="Masukan Alamat">
    <select name="educational_stage_id" class="form-control mt-2" id="educational_stage">
        <option selected>Pilih Jenjang Pendidikan</option>
        @foreach ($educational as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <select name="sub_districts_id" class="form-control mt-2" id="educational_stage">
        <option selected>Pilih Kecamatan</option>
        @foreach ($sub_district as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <select name="cluster_id" class="form-control mt-2" id="educational_stage">
        <option selected>Pilih Cluster</option>
        @foreach ($cluster as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    @endsection