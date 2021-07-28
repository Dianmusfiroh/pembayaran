@extends('layouts.app')
@section('card-title-before','Import')
@section('card-title','Form')
@section('back-button',url()->previous())
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('form-create')
    <form action="{{ url('apps/import?q='.$modul) }}" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post">
        @csrf
@endsection
@section('card-body')
<div class="form-group row">
    <label for="file" class="col-sm-2">File</label>
    <div class="col-sm-10">
        <input type="file" class="form-control @error('name') is-invalid @enderror" name="file" id="file" required>
        @error('title')
        <span for="name" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <input type="hidden" id="url-back" value="{{url('master/'.$modul)}}">
</div>
<div class="form-group row">
    <label for="file" class="col-sm-2">Format File</label>
    <div class="col-sm-10">
        <a href="{{ url('apps/export?q='.$modul) }}" class="btn btn-primary">Download</a>
    </div>
</div>
@endsection
