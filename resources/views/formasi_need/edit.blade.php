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
    <div class="form-group row">
        <label for="quantity" class="col-sm-2 col-form-label">Jumlah</label>
        <div class="col-sm-10">
            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Masukan Jumlah"
                value="{{$formationNeed->quantity}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="formation_year" class="col-sm-2 col-form-label">Tahun Formasi</label>
        <div class="col-sm-10">
            <select name="formation_year" id="formation_year" class="custom-select mt-2" required>
                <option selected value=" {{ $formationNeed->formation_year }} ">{{ $formationNeed->formation_year }}
                </option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="formation_category_id" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
            <select name="formation_category_id" id="formation_category_id" class="custom-select mt-2" required>
                <option selected>Pilih Kategori</option>
                @foreach ($categories as $item)
                    @if ($item->id == $formationNeed->formation_category_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="institute_id" class="col-sm-2 col-form-label">Instansi</label>
        <div class="col-sm-10">
            <select name="institute_id" id="institute_id" class="custom-select mt-2" required>
                @foreach ($institute as $item)
                @if ($item->id == $formationNeed->institute->id)
                <option value="{{ $item->id }}" selected> {{ $item->name }}</option>
                @else
                <option value="{{ $item->id }}"> {{ $item->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="qualification_id" class="col-sm-2 col-form-label">Kualifikasi</label>
        <div class="col-sm-10">
            <select name="qualification_id" id="qualification_id" class="custom-select mt-2" required>
                @foreach ($qualification as $item)
                @if ($item->id == $formationNeed->qualification->id)
                <option value="{{ $item->id }}" selected> {{ $item->name }}</option>
                @else
                <option value="{{ $item->id }}"> {{ $item->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="position_id" class="col-sm-2 col-form-label">Jabatan</label>
        <div class="col-sm-10">
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
        </div>
    </div>
    <div class="form-group row">
        <label for="start_date" class="col-sm-2 col-form-label">Mulai Tanggal</label>
        <div class="col-sm-10">
            <input type="text" name="start_date" id="start_date" class="date form-control mt-2"
                value=" {{ $formationNeed->start_date }} ">
        </div>
    </div>
    <div class="form-group row">
        <label for="end_date" class="col-sm-2 col-form-label">Tanggal Berakhir</label>
        <div class="col-sm-10">
            <input type="text" name="end_date" id="end_date" class="date form-control mt-2"
                value=" {{str_replace('-','/',$formationNeed->end_date)}} ">
        </div>
    </div>
    @endsection

      @section('plugins.Select2', true)
@section('js')
<script>
    $("#institute_id").select2({});
</script>
@endsection