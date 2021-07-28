@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('master/wilayah/kabupaten'))
@section('form-create')
<form action="{{ route('kabupaten.update',$kabupaten->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-body')
    <h3 class="title text-left">Provinsi {{ $kabupaten->province->name }} </h3>
    {{-- <h3 class="title text-left">Nama Provinsi {{ $kabupaten->provinces->name }}</h3> --}}
    <input type="text" name="name" id="name" class="form-control" placeholder="Masukan Nama Kabupaten"
        value="{{$kabupaten->name}}">
    <select name="province_id" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" required>
        @foreach ($provinces as $item)
        @if ($item->id == $kabupaten->province->id)
        <option value="{{ $item->id }}" selected> {{ $item->name }}</option>
        @else
        <option value="{{ $item->id }}"> {{ $item->name }}</option>
        @endif
        @endforeach
    </select>
    @endsection