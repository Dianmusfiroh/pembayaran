@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('master/formasi'))
@section('form-create')
<form action="{{ route('formasi.store')}}" method="POST">
    @csrf
    @endsection
    @section('card-body')
    <input type="number" name="quantity" id="name" class="form-control" placeholder="Masukan Jumlah Formasi" required>
    <select name="formation_year" id="formation_year" class="custom-select mt-2" required>
        <option selected>Pilih Tahun Formasi</option>
        @for ($i = 2020; $i < date('Y'); $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    <select name="institute_id" id="institute_id" class="custom-select mt-2" required>
        <option selected>Pilih Instansi</option>
        @foreach ($institute as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <select name="qualification_id" id="qualification_id" class="custom-select mt-2" required>
        <option selected>Pilih Qualifikasi</option>
        @foreach ($qualification as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <select name="position_id" id="position_id" class="custom-select mt-2" required>
        <option selected>Pilih Jabatan</option>
        @foreach ($position as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>

    @endsection