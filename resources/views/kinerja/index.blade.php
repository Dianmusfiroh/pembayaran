@extends('layouts.app')
@section('card-header-extra')
<div class="float-right">
    <a href="{{ route($modul.'.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i>
        Tambah Data</a>
</div>
@endsection
@section('card-body')
<table class="table table-bordered table-striped table-sm text-center" id="myTable">
    <thead>
        <tr>
            <th style="width: 4%;">No</th>
            <th>NIk Guru</th>
            <th>Nama Guru</th>
            <th>Presentase</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Aksi

            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kinerjas as $key => $item)
        <tr>
            <td>{{ ($key+1) }}</td>
            <td>{{ $item->nik }}</td>
            {{-- <td>{{ $item->gtt ? $item->gtt->nik : '' }}</td> --}}

            <td>{{ $item->nama }}</td>

            <td>{{ $item->presentase }}%</td>
            <td>{{ $item->month }}</td>
            <td>{{ $item->year }}</td>

            <td>
                <a href="{{ route($modul.'.edit', $item->id) }}" class="btn btn-success btn-sm"
                    type="submit"><i class="fas fa-fw fa-edit"></i> Edit</a>
                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id}})"
                    data-target="#DeleteModal" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i>
                    Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>@endsection
@section('plugins.Datatables', true)
@section('js')
<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>
@include('layouts.script.delete')
@endsection
