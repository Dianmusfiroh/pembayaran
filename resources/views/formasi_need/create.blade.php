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
    <div class="form-group row">
        <label for="quantity" class="col-sm-2 col-form-label">Jumlah Formasi</label>
        <div class="col-sm-10">
            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Masukan Jumlah Formasi"
                required>
        </div>
    </div>
    <div class="form-group row">
        <label for="formation_year" class="col-sm-2 col-form-label">Tahun</label>
        <div class="col-sm-10">
            <select name="formation_year" id="formation_year" class="custom-select mt-2" required>
                <option selected>Pilih Tahun Formasi</option>
                @for ($i = 2020; $i <= date('Y')+1; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="formation_category_id" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
            <select name="formation_category_id" id="formation_category_id" class="custom-select mt-2" required>
                <option selected>Pilih Kategori</option>
                @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="institute_id" class="col-sm-2 col-form-label">Instansi</label>
        <div class="col-sm-10">
            <select name="institute_id" id="institute_id" class="custom-select mt-2" required>
                <option selected>Pilih Instansi</option>
                @foreach ($institute as $item)
                <option value="{{ $item->id }}">{{ $item->name }} | {{ $item->sub_districts->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="qualification_id" class="col-sm-2 col-form-label">Kualifikasi</label>
        <div class="col-sm-10"><select name="qualification_id" id="qualification_id" class="custom-select mt-2"
                required>
                <option selected>Pilih Qualifikasi</option>
                @foreach ($qualification as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="position_id" class="col-sm-2 col-form-label">Jabatan</label>
        <div class="col-sm-10">
            <select name="position_id" id="position_id" class="custom-select mt-2" required>
                <option selected>Pilih Jabatan</option>
                @foreach ($position as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Mulai Tanggal</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="start_date" id="start_date" class="form-control mt-2">
        </div>
    </div>
    <div class="form-group row">
        <label for="end_date" class="col-sm-2 col-form-label">Tanggal Berakhir</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="end_date" id="end_date" class="date form-control mt-2">
        </div>
    </div>
    @endsection
   @section('plugins.Select2', true)
@section('js')
<script>
    $("#institute_id").select2({});
</script>
@endsection