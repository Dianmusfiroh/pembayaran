@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('master/assesment-form'))
@section('form-create')
<form action="{{ route($modul.'.update', $assesmentForm->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-body')
    <div class="form-group row">
        <div class="label col-md-3">Status</div>
        <div class="col-md-9">
            <input type="number" name="status" id="status" class="form-control mt-2" placeholder="Masukan Status"
                value="{{$assesmentForm->status}}">
        </div>
    </div>

    <div class="form-group row">
        <div class="label col-md-3">Jabatan</div>
        <div class="col-md-9">
            <select name="position_id" id="position_id" class="form-control">
                @foreach ($jabatans as $item)
                    @if ($item->id == $assesmentForm->jabatan_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="formation_category_id" class="label col-sm-3 col-form-label">Kategori</label>
        <div class="col-sm-9">
            <select name="formation_category_id" id="formation_category_id" class="custom-select mt-2" required>
                <option selected>Pilih Kategori</option>
                @foreach ($categories as $item)
                    @if ($item->id == $assesmentForm->formation_category_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Assesment Option</div>
        <div class="col-md-9">
            <select name="assessment_option_id" id="assessment_option_id" class="form-control">
                @foreach ($assesmentOption as $item)
                    @if ($item->id == $assesmentForm->assessment_option_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    @endsection