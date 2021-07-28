@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('master/formasi'))
@section('form-create')
<form action="{{ route('formasi.update',$formationNeed->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-body')
    <!-- <h3 class="title text-left">Nama Provinsi</h3> -->
    <input type="number" name="name" id="name" class="form-control" placeholder="Masukan Jabatan"
        value="{{ $formationNeed->quantity }}">
    <select name="formation_year" id="formation_year" class="custom-select mt-2" required>
        <option selected value=" {{ $formationNeed->formation_year }} ">{{ $formationNeed->formation_year }}</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
    </select>
    <select name="institute_id" id="institute_id" class="custom-select mt-2" required>
        @foreach ($institute as $item)
        @if ($item->id == $formationNeed->institute->id)
        <option value="{{ $item->id }}" selected> {{ $item->name }}</option>
        @else
        <option value="{{ $item->id }}"> {{ $item->name }}</option>
        @endif
        @endforeach
    </select>
    <select name="qualification_id" id="qualification_id" class="custom-select mt-2" required>
        @foreach ($qualification as $item)
        @if ($item->id == $formationNeed->qualification->id)
        <option value="{{ $item->id }}" selected> {{ $item->name }}</option>
        @else
        <option value="{{ $item->id }}"> {{ $item->name }}</option>
        @endif
        @endforeach
    </select>
    <select name="position_id" class="form-control mt-2" id="position_id">
        {{-- <option selected>Pilih Jenjang Pendidikan</option> --}}
        @foreach ($position as $item)
        @if ($item->id == $formationNeed->position->id)
        <option value="{{ $item->id }}" selected> {{ $item->name }}</option>
        @else
        <option value="{{ $item->id }}"> {{ $item->name }}</option>
        @endif
        @endforeach
    </select>
    @endsection