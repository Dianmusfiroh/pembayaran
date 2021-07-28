@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save" ><i class="fas fa-fw fa-save"></i> Simpan</button>
@endsection
@section('back-button', url('apps/sk'))
@section('form-create')
    <form action="{{ route('sk.update',$sk->id)}}" method="POST">
        @csrf
        @method('PUT')
@endsection
@section('card-body')

    <div class="form-group row">
        <div class="label col-md-3">No SK</div>
        <div class="col-md-9">
            <input type="text" name="no_sk" id="no_sk" class="form-control" placeholder="Masukan No SK" value="{{$sk->no_sk}}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tanggal Mulai</div>
        <div class="col-md-9">
            <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Masukan Waktu Mulai" value="{{$sk->start_date}}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tanggal Selesai</div>
        <div class="col-md-9">
            <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Masukan Waktu Selesai" value="{{$sk->end_date}}" required>
        </div>
    </div>

@endsection
