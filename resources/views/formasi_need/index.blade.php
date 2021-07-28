@extends('layouts.app')
@section('card-title',$title)
    @section('card-header-extra')
    <div class="float-right">
        <a href="{{ route($modul.'.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah
            Data</a>
    </div>
    @endsection
@section('card-body')
<h3 class="text-center">Total Kuota : {{ $total_kuota }}</h3>
<table class="table table-bordered table-striped table-sm text-center" id="myTable">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>Kategori</th>
            <th>Instansi</th>
            <th>Jabatan</th>
            <th>Kualifikasi</th>
            <th>Kuota</th>
            <th>Tahun</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($formationNeeds as $key => $item)
        <tr class="text-center">
            <td>{{ ($key+1) }}</td>
            <td>{{ $item->formation_category ? $item->formation_category->name : '' }}</td>
             <td>{{ $item->instansi }}</td>
             <td>{{ $item->jabatan }}</td>
             <td>{{ $item->kualifikasi }}</td>
            <td> {{ $item->quantity }}</td>
            <td> {{ $item->formation_year }} </td>
            <td> {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }} </td>
            <td> {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }} </td>
            <td>
                @can('isAdmin')
                     <button type="button" class="btn btn-default " data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="{{ route($modul.'.edit', $item->id) }}">Edit</a>
                <a class="dropdown-item" href="javascript:;" data-toggle="modal" onclick="deleteData('{{ $item->id }}')"
                data-target="#DeleteModal">Hapus</a>
                </div>
                @endcan
                @can('isPendaftaran')
                     <button type="button" class="btn btn-default " data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="{{ route($modul.'.edit', $item->id) }}">Edit</a>
                <a class="dropdown-item" href="javascript:;" data-toggle="modal" onclick="deleteData('{{ $item->id }}')"
                data-target="#DeleteModal">Hapus</a>
                </div>
                @endcan
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