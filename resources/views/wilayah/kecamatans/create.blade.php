@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save" ><i class="fas fa-fw fa-save"></i> Simpan</button>
@endsection
@section('back-button',url('master/wilayah/kecamatan'))
@section('form-create')
    <form action="{{ route('kecamatan.store')}}" method="POST">
        @csrf
@endsection
@section('card-body')
    <!-- <h3 class="title text-left">Nama Provinsi</h3> -->
    <input type="text" name="name" id="name" class="form-control" placeholder="Masukan Nama Kecamatan" required>
    <select name="districts_id" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" required>
        @foreach ($districts as $item)
        <option value="{{ $item->id }}"> {{ $item->name }}</option>
        @endforeach
    </select>
@endsection