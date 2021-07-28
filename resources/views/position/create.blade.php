@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save" ><i class="fas fa-fw fa-save"></i> Simpan</button>
@endsection
@section('back-button',url('master/jabatan'))
@section('form-create')
    <form action="{{ route('jabatan.store')}}" method="POST">
        @csrf
@endsection
@section('card-body')
    <div class="form-group row">
        <label for="kategori" class="control-label col-md-2">Kategori</label>
        <div class="col-md-6">
            @foreach ($kategori as $key => $item)
                <input type="radio" name="position_category_id" value="{{ $item->id }}" {{ $key == 0 ? 'checked' : '' }}> {{ $item->name }}
            @endforeach
        </div>
    </div>
    <div class="form-group row">
        <label for="kategori" class="control-label col-md-2">Jabatan</label>
        <div class="col-md-6">
            <input type="text" name="name" id="name" class="form-control" placeholder="Masukan Nama Jabatan" required>
        </div>
    </div>
@endsection