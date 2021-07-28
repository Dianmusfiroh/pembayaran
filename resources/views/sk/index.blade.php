@extends('layouts.app')
@canany(['isPembayaran','isAdmin'])
    @section('card-header-extra')
<div class="float-right">
    <a href="{{ route($modul.'.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah
        Data</a>

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
            <th>Jumlah GTK</th>
            @canany(['isPembayaran','isAdmin'])

            @endcanany
            @canany(['isPembayaran','isAdmin'])
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
            {{-- <td>6</td> --}}
            @canany(['isPembayaran','isAdmin'])
                <td>
                     <button type="button" class="btn btn-default " data-toggle="dropdown">
                      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu" style="">
                        <a class="dropdown-item" href="{{ route('printSk', $item->id) }}">Cetak</a>
                      <a class="dropdown-item" href="{{ route($modul.'.edit', $item->id) }}">Edit</a>
                      <a class="dropdown-item" href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id}})"
                    data-target="#DeleteModal">Hapus</a>
                         <a class="dropdown-item" href="{{ route("generatePesertaSk", $item->id) }}" > Generate SK</a>

                    </div>
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
