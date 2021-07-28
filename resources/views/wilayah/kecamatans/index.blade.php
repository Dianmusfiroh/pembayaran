@extends('layouts.app')
@section('card-header-extra')
<div class="float-right">
    <a href="{{ url('master/wilayah/kecamatan/create') }}" class="btn btn-primary btn-sm"><i
            class="fas fa-fw fa-plus"></i> Tambah Data</a>
</div>
@endsection
@section('card-body')
<table class="table table-bordered table-striped table-sm text-center" id="myTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Kecamatan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kecamatans as $key => $item)
        <tr>
            <td style="width: 5%">{{ ($key+1) }}</td>
            <td>{{ $item->name }}</td>
            <td style="width: 30%">
                <a href="{{ url('master/wilayah/kecamatan/' . $item->id . '/edit') }}" class="btn btn-success btn-sm"
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