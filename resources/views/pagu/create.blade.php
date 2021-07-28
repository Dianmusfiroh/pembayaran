@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="button" class="btn btn-primary float-right ml-2" id="btnSave" title="Save" ><i class="fas fa-fw fa-save"></i> Simpan</button>
@endsection
@section('back-button',url('pengaturan/pagu'))
@section('form-create')
    <form action="{{ route($modul.'.store')}}" method="POST" class="form-horizontal" id=frm"">
        @csrf
@endsection
@section('card-body')
    <div class="form-group row">
        <label for="year" class="col-sm-2 col-form-label">Sumber Anggaran</label>
        <div class="col-sm-10">
            <select name="sumber_anggaran" id="sumberAnggaran" class="form-control">
                <option value="">Pilih Sumber Anggaran</option>
                @foreach ($sumbers as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>    
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="year" class="col-sm-2 col-form-label">Tahun Anggaran</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="year" name="year" placeholder="Tahun Anggaran">
        </div>
    </div>
    <div class="form-group row">
        <label for="jumlah" class="col-sm-2 col-form-label">Total Pagu</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Total Pagu">
        </div>
    </div>
@endsection
@section('js')
@include('layouts.script.sweetAlert')
    <script>
        $("#btnSave").click(function(){
            $.ajax({
                url:'{{Route($modul.".store")}}',
                type: 'POST',
                data:{
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    sumber_id:$("#sumberAnggaran").val(),
                    year:$("#year").val(),
                    jumlah:$("#jumlah").val(),
                },
                success: function (result) {
                    showToast('success','Berhasil tambah pagu');
                    $("#sumberAnggaran").val('');
                    $("#year").val('');
                    $("#jumlah").val('');
                },
                error: function (er) {
                    showToast('error',er.responseJSON.message);
                }
            });
        })
    </script>
@endsection