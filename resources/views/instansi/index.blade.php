@extends('layouts.app')
@section('card-header-extra')
<div class="float-right">
    <a href="{{ url('master/instansi/create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i>
        Tambah Data</a>
</div>
@endsection
@section('card-body')
<table class="table table-bordered table-striped table-sm text-center" id="myTable">
    <thead>
        <tr>
            <th style="width: 4%;">No</th>
            <th>NPSN</th>
            <th>Name</th>
            <th>Address</th>
            <th>Jenjang</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Klaster</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($institutes as $key => $item)
        <tr>
            <td>{{ ($key+1) }}</td>
            <td>{{ $item->npsn }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->address }}</td>
            <td>{{ $item->educational_stage->name }}</td>
            <td> {{ $item->province->name }} </td>
            <td>{{ $item->districts->name }}</td>
            <td>{{ $item->sub_districts->name }}</td>
            <td>{{ $item->cluster->name }}</td>

            <td>
                <a href="{{ url('master/instansi/' . $item->id . '/edit') }}" class="btn btn-success btn-sm"
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
