@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('master/assesment-form'))
@section('form-create')
<form action="{{ route($modul.'.store')}}" method="POST">
    @csrf
    @endsection
    @section('card-body')
    <div class="form-group row">
        <div class="label col-md-3">Status</div>
        <div class="col-md-9">
            <input type="radio" name="status" id="status" value="0"> Tidak Aktif
            <input type="radio" name="status" id="status" value="1" checked> Aktif
        </div>
    </div>
     <div class="form-group row">
        <label for="formation_category_id" class="label col-sm-3 col-form-label">Kategori</label>
        <div class="col-sm-9">
            <select name="formation_category_id" id="formation_category_id" class="custom-select mt-2" required>
                <option selected>Pilih Kategori</option>
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="label col-md-3">Jabatan</div>
        <div class="col-md-9">
                <select name="position_category_id" id="position_id" class="form-control" ">
                    <option value="">Pilih Jabatan</option>
                    @foreach ($jabatan as $item)
                        <option value=" {{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="label col-md-3">Opsi Penilaian</div>
        <div class="col-md-9">
            <select name="assessment_option[]" id="assessment_option" class="form-control" multiple>
                <option value="">Pilih Opsi Penilaian</option>
                @foreach ($assesmentOption as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endsection
    @section('plugins.Select2', true)
    @section('js')
    <script>
        $("#assessment_option").select2({

        });
    </script>
    @endsection