@extends('layouts.app')
@section('card-title','Detail');
@section('card-body')
<div class="form-group row">
        <div class="label col-md-3">Kategori</div>
        <div class="col-md-9">
            <input type="text" disabled class="form-control" value="{{$formationNeed->formation_category ? $formationNeed->formation_category->name : ''}}" required>
        </div>
    </div>
<div class="form-group row">
        <div class="label col-md-3">Instansi</div>
        <div class="col-md-9">
            <input type="text" disabled class="form-control" value="{{$formationNeed->instansi}}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Jabatan</div>
        <div class="col-md-9">
            <input type="text" disabled class="form-control" value="{{$formationNeed->jabatan}}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Kualifikasi</div>
        <div class="col-md-9">
            <input type="text" disabled class="form-control" value="{{$formationNeed->kualifikasi}}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Kuota</div>
        <div class="col-md-9">
            <input type="text" disabled class="form-control" value="{{$formationNeed->quantity}}" required>
        </div>
    </div>
<table class="table table-bordered table-striped table-sm" id="myTable">
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>NUPTK</th>
            <th>Nama Lengkap</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($formationNeed->formation as $k => $item)
           <tr>
               <td>{{ ($k+1) }}</td>
                <td>{{ $item->candidate->candidateProfile->nik }}</td>
                <td>{{ $item->candidate->candidateProfile->nuptk }}</td>
                <td>{{ $item->candidate->candidateProfile->title_ahead }} {{ $item->candidate->candidateProfile->full_name }} {{ $item->candidate->candidateProfile->back_title }}</td>
           </tr>
       @endforeach
    </tbody>
</table>
@endsection
@section('plugins.Datatables', true)
@section('js')
<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true                        
                });
            var url = '';
</script>
@endsection