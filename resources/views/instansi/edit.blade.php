@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('master/instansi'))
@section('form-create')
<form action="{{ route('instansi.update', $institute->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-body')
    <!-- <h3 class="title text-left">Nama Provinsi</h3> -->
    {{-- @foreach ($institute as $item) --}}
    <input type="text" name="npsn" id="name" class="form-control" placeholder="Masukan NPSN"
        value=" {{ $institute->npsn }} ">
    <input type="text" name="name" id="name" class="form-control mt-2" placeholder="Masukan Nama Sekolah"
        value=" {{ $institute->name }} ">
    <input type="text" name="address" id="name" class="form-control mt-2" placeholder="Masukan Alamat"
        value=" {{ $institute->address }} ">
    {{-- @endforeach --}}
    <select name="educational_stage_id" class="form-control mt-2" id="educational_stage">
        {{-- <option selected>Pilih Jenjang Pendidikan</option> --}}
        @foreach ($educational as $item)
        @if ($item->id == $institute->educational_stage->id)
        <option value="{{ $item->id }}" selected> {{ $item->name }}</option>
        @else
        <option value="{{ $item->id }}"> {{ $item->name }}</option>
        @endif
        @endforeach
    </select>
    <select name="sub_districts_id" class="form-control mt-2" id="educational_stage">
        @foreach ($sub_district as $item)
        @if ($item->id == $institute->sub_districts->id)
        <option value="{{ $item->id }}" selected> {{ $item->name }}</option>
        @else
        <option value="{{ $item->id }}"> {{ $item->name }}</option>
        @endif
        @endforeach
    </select>
    <select name="cluster_id" class="form-control mt-2" id="educational_stage">
        @foreach ($cluster as $item)
        @if ($item->id == $institute->cluster->id)
        <option value="{{ $item->id }}" selected> {{ $item->name }}</option>
        @else
        <option value="{{ $item->id }}"> {{ $item->name }}</option>
        @endif
        @endforeach
    </select>
    @endsection