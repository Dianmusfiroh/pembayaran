@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('master/assesment'))
@section('form-create')
<form action="{{ route('assesment.update', $assesment->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-body')

    <div class="form-group row">
        <div class="label col-md-3">Score</div>
        <div class="col-md-9">
            <input type="number" name="score" id="score" class="form-control mt-2" placeholder="Masukan Score" value="{{ $assesment->score }}">
        </div>
    </div>

    <div class="form-group row">
        <div class="label col-md-3">Jabatan</div>
        <div class="col-md-9">
            <select name="position_id" class="form-control mt-2" id="position_id">
                @foreach ($position as $item)
                    @if ($item->id == $assesment->position_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>                        
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>                        
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Opsi Penilaian</div>
        <div class="col-md-9">
            <select name="assessment_option_id" class="form-control mt-2" id="assessment_option_id">
                @foreach ($assesmentOption as $item)
                    @if ($item->id == $assesment->assessment_option_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>                        
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>                        
                    @endif 
                @endforeach
            </select> 
        </div>
    </div>

    <div class="form-group row">
        <div class="label col-md-3">Tanggal Penialaian</div>
        <div class="col-md-9">
            <input type="date" name="assessment_date" id="assessment_date" class="form-control mt-2" placeholder="Masukan Tanggal Penialaian " value="{{ $assesment->assessment_date }}">
        </div>
    </div>

    <div class="form-group row">
        <div class="label col-md-3">Kandidat</div>
        <div class="col-md-9">
            <select name="candidate_id" class="form-control mt-2" id="candidate_id">
                @foreach ($kandidat as $item)
                    @if ($item->id == $assesment->candidate_id)
                        <option value="{{ $item->id }}" selected>{{ $item->full_name }}</option>                        
                    @else
                        <option value="{{ $item->id }}">{{ $item->full_name }}</option>                        
                    @endif
                @endforeach
            </select>
        </div>
    </div>

@endsection
