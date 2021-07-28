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
            <th>Status</th>
            <th>Formasi</th>
            <th>Kategori Jabatan</th>
            <th>Assesment Option</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($assesmentForms as $key => $item)
        <tr>
            <td>{{ ($key+1) }}</td>
            <td>{{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
            <td>{{ $item->formation_category ? $item->formation_category->name : '' }}</td>
            <td>{{ $item->positionCategory->name }}</td>
            <td>{{ $item->assessment_option->name }}</td>

            <td>
                <a href="{{ route($modul.'.edit', $item->id) }}" class="btn btn-success btn-sm" type="submit"><i
                        class="fas fa-fw fa-edit"></i> Edit</a>
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
