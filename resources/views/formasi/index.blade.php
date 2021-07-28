@extends('layouts.app')
@section('card-header-extra')
<div class="float-right">
    <a href="{{ route($modul.'.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah
        Data</a>
</div>
@endsection
@section('card-body')
<table class="table table-bordered table-striped table-sm text-center" id="myTable">
    <thead>
        <tr class="text-center">
            <th style="width: 5%;">No</th>
            <th>Jumlah</th>
            <th style="width: 15%;">Tahun Formasi</th>
            <th>Instansi</th>
            <th>Kualifikasi</th>
            <th>Jabatan</th>
            <th style="width: 15%;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($formationNeeds as $key => $item)
        <tr class="text-center">
            <td>{{ ($key+1) }}</td>
            <td>{{ $item->quantity }}</td>
            <td> {{ $item->formation_year }} </td>
            <td>{{ $item->institute->name }}</td>
            <td>{{ $item->qualification->name }}</td>
            <td>{{ $item->position->name }}</td>
            <td>
                <a href="{{ route($modul.'.edit', $item->id) }}" class="btn btn-success btn-sm" type="submit"><i
                        class="fas fa-fw fa-edit"></i> Edit</a>
                <a href="javascript:;" data-toggle="modal" onclick="deleteData('{{ $item->id }}')"
                    data-target="#DeleteModal" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i>
                    Delete</a>
            </td>
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
</script>
@include('layouts.script.delete')
@endsection