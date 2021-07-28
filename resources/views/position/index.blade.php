@extends('layouts.app')
@section('card-header-extra')
<div class="float-right">
    <a href="{{ url('master/jabatan/create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah
        Data</a>
</div>
@endsection
@section('card-body')
<table class="table table-bordered table-striped table-sm" id="myTable">
    <thead>
        <tr class="text-center">
            <th style="width: 5%;">No</th>
            <th>Kategori</th>
            <th>Nama Jabatan</th>
            <th style="width: 18%;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jabatans as $key => $item)
        <tr>
            <td class="text-center">{{ ($key+1) }}</td>
            <td>{{ $item->positionCategory ? $item->positionCategory->name : '' }}</td>
            <td>{{ $item->name }}</td>
            <td class="text-center">
                <a href="{{ url('master/jabatan/' . $item->id . '/edit') }}" class="btn btn-success btn-sm"
                    type="submit"><i class="fas fa-fw fa-edit"></i> Edit</a>
                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id}})"
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