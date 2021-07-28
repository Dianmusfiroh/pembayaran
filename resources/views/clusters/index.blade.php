@extends('layouts.app')
@section('card-header-extra')
<div class="float-right">
    <a href="{{ url('master/cluster/create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i>
        Tambah Data</a>
</div>
@endsection
@section('card-body')
<table class="table table-bordered table-striped table-sm text-center" id="myTable">
    <thead>
        <tr>
            <th style="width: 4%;">No</th>
            <th>Name </th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clusters as $key => $item)
        <tr>
            <td>{{ ($key+1) }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <a href="{{ url('master/cluster/' . $item->id . '/edit') }}" class="btn btn-success btn-sm"
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
@section('js')
@include('layouts.script.delete')
@endsection