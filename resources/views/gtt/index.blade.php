@extends('layouts.app')
@section('card-header-extra')
<div class="float-right">
    <a href="{{ route($modul.'.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i>
        Tambah Data</a>
</div>
@endsection
@section('card-body')
<div class="row">
    <div class="col">
        <div class="table-responsive">

<table class="table table-bordered table-striped table-sm" id="myTable">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>NIK</th>
            <th>NUPTK</th>
            <th colspan="3">Nama</th>
            <th>Tanggal Lahir</th>
            <th>Tempat Lahir</th>
            <th>TMT Mulai</th>
            <th>TMT Selesai</th>
            <th>No. Rekening</th>
            <th>Nama Rekening</th>
            <th>Institut</th>
            <th>Qualifikasi</th>
            <th>Jabatan</th>
            <th>AKSI</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($gtts as $key => $item)
        <tr>
            <td class="text-center">{{ ($key+1) }}</td>
            <td>{{ $item->nik }}</a></td>
            <td>{{ $item->nuptk }}</td>
            <td colspan="3">
                {{ $item->title_ahead  }}
                {{ $item->full_name }}
                {{ $item->back_title  }}
            </td>


            <td>{{ $item->date_of_birth }}</td>
            <td>{{ $item->place_of_birth  }}</td>
            <td>{{ $item->tmt_start  }}</td>
            <td>{{ $item->tmt_end  }}</td>
            <td>{{ $item->bank_name  }}</td>
            <td>{{ $item->account_name  }}</td>
            <td>{{ $item->account_number  }}</td>
            {{-- <td>{{ $item->bankAccount ? $item->bankAccount->account_number : '' }}</td> --}}
            {{-- <td>{{ $item->bankAccount ? $item->bankAccount->account_name : '' }}</td> --}}

            <td>{{ $item->institute ? $item->institute->name  : ''}}</td>
            <td>{{ $item->qualification ? $item->qualification->name : '' }}</td>
            <td>{{ $item->position ? $item->position->name :'' }}</td>
            <td>
                <a href="{{ route($modul.'.edit', $item->id)}}" class="btn btn-success btn-sm" type="submit"><i
                    class="fas fa-fw fa-edit"></i> Edit</a>
            <a href="javascript:;" data-toggle="modal" onclick="deleteData('{{$item->id}}')"
                data-target="#DeleteModal" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i>
                Delete</a>
        </td>

        </tr>
        @endforeach
    </tbody>
</table>

</div>
</div>
</div>
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
