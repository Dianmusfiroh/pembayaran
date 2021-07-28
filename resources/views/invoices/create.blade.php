@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save" ><i class="fas fa-fw fa-save"></i> Simpan</button>
@endsection
@section('back-button',url('pembayaran/tagihan'))
@section('form-create')
    <form action="{{ route('tagihan.store')}}" method="POST">
        @csrf
@endsection
@section('card-body')

    {{-- <input type="number" name="id" id="id" placeholder="masukan id" class="form-control"> --}}
    <div class="form-group row">
        <div class="label col-md-3">No SPM</div>
        <div class="col-md-9">
            <input type="text" name="no_spm" id="no_spm" class="form-control" placeholder="Masukan No SPM" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Periode Realisasi</div>
        <div class="col-md-9">
            <div class="row">
                @foreach (range(1,12) as $p)
                    <div class="col-md-2">
                        <input type="checkbox" name="periode_realisasi[]" id="periode_realisasi_{{$p}}" value="{{ $p }}"> {{ \Carbon\Carbon::create()->day(1)->month($p)->format('F') }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tahap</div>
        <div class="col-md-9">
            <input type="number" name="step" id="step" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tanggal Terbit</div>
        <div class="col-md-9">
            <input type="date" name="invoice_date" id="invoice_date" class="form-control" placeholder="Masukan Tanggal SP2D">
        </div>
    </div>

@endsection
