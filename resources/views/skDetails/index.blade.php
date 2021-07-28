@extends('layouts.app')
@canany(['isPendaftaran','isAdmin'])
    @section('card-header-extra')
<div class="float-right">
    <a href="{{ route($modul.'.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah
        Data</a>
        {{-- <a href="{{ route("generatePesertaSk") }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Generate SK</a> --}}

    </div>

@endsection
@endcanany
@section('card-body')
<table class="table table-bordered table-striped table-sm" id="myTable">
    <thead>
        <tr>
            <th>No</th>
            <th>No.SK</th>
            <th>Tanggal SK</th>
            <th>Mulai Berlaku</th>
            <th>Selesai Berlaku</th>
            @canany(['isPembayaran','isAdmin'])
                <th>Jumlah GTK</th>
                <th>Jumlah Diproses</th>
            @endcanany
            @canany(['isPendaftaran','isAdmin'])
                <th>Jumlah GTK</th>
                <th>Aksi</th>
            @endcanany
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key => $item)
        <tr>
            <td>{{ ($key+1) }}</td>
            <td>
                <a href="{{ url('apps/sk', $item->id) }}" type="submit">
                    {{ $item->no_sk }}
                </a>
            </td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->start_date }}</td>
            <td>{{ $item->end_date }}</td>
            <td>{{ $item->sk_detail->count() }}</td>
             @canany(['isPembayaran','isAdmin'])
                <td>0</td>
            @endcanany
            @canany(['isPendaftaran','isAdmin'])
                <td>
                <a href="{{ route($modul.'.edit', $item->id) }}" class="btn btn-success btn-sm" type="submit"><i
                        class="fas fa-fw fa-edit"></i> Edit</a>
                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id}})"
                    data-target="#DeleteModal" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i>
                    Delete</a>
            </td>
            @endcanany
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
