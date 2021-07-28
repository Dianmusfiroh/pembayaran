@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save" ><i class="fas fa-fw fa-save"></i> Simpan</button>
@endsection
@section('back-button',url('pembayaran/tagihan'))
@section('form-create')
    <form action="{{ route('tagihan.update',$edit->id)}}" method="POST">
        @csrf
        @method('PUT')
@endsection
@section('card-body')

    <div class="form-group row">
        <div class="label col-md-3">No SPM</div>
        <div class="col-md-9">
            <input type="text" name="no_spm" id="no_spm" class="form-control" placeholder="Masukan No SPM" value="{{ $edit->no_spm }}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Periode Realisasi</div>
        <div class="col-md-9">
            <div class="row">
                 @foreach (range(1,12) as $p)
                    <div class="col-md-2">
                        <input type="checkbox" name="periode_realisasi[]" id="periode_realisasi_{{$p}}" value="{{ $p }}" {{ in_array($p,$periods) ? 'checked' : '' }}> {{ \Carbon\Carbon::create()->day(1)->month($p)->format('F') }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tanggal Terbit</div>
        <div class="col-md-9">
            <input type="date" name="invoice_date" id="invoice_date" class="form-control" value="{{ $edit->invoice_date }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Status</div>
        <div class="col-md-9">
            <select name="status_id" id="status_id" class="form-control">
                <option value="">Pilih Status</option>
                 @foreach ($status as $item)
                 @if ($item->id == $edit->status_id)
                     <option value="{{ $item->id }}" selected>{{ $item->description }}</option>
                 @else
                    <option value="{{ $item->id }}">{{ $item->description }}</option>
                 @endif
                @endforeach
            </select>
        </div>
    </div>
    <div id="showHideSP2DForm">
        <div class="form-group row">
            <div class="label col-md-3">No SP2D</div>
            <div class="col-md-9">
                <input type="text" name="no_sp2d" id="no_sp2d" class="form-control" value="{{ $edit->no_sp2d }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="label col-md-3">Tanggal SP2D</div>
            <div class="col-md-9">
                <input type="date" name="date_sp2d" id="date_sp2d" class="form-control" value="{{ $edit->date_sp2d }}">
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#status_id").on("change",function(){
            const status = $(this).val();
            if (status == 3){
                $("#showHideSP2DForm").show();
            }else{
                $("#showHideSP2DForm").hide();
            }
        });
        if ($("#status_id").val() == 3){
             $("#showHideSP2DForm").show();
        }else{
             $("#showHideSP2DForm").hide();
        }
    </script>
@endsection
