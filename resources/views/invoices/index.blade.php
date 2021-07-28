@extends('layouts.app')
@section('card-header-extra')
<div class="float-right">
    <a href="{{ route($modul.'.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah
        Data</a>
</div>
@endsection
@section('card-body')
<table class="table table-bordered table-striped table-sm" id="myTable">
    <thead>
        <tr>
            <th>No</th>
            <th>No SPM</th>
            <th>No SP2D</th>
            <th>Tanggal SP2D</th>
            <th>Tanggal Tagihan</th>
            <th>Periode Tagihan</th>
            <th>Tahap</th>
            <th>Jumlah GTK</th>
            <th>Nominal</th>
            <th>Status</th>
            <th class="text-uppercase">aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key => $item)
        <tr>
            <td>{{ ($key+1) }}</td>
            <td><a href="{{ route($modul.'.show', $item->id) }}">{{ $item->no_spm }}</a> </td>
            <td>{{ $item->no_sp2d }}</td>
            <td>{{ $item->date_sp2d }}</td>
            <td>{{ $item->invoice_date }}</td>
            <td>
                @foreach ($item->invoicePeriod as $ip)
                    <small class="badge badge-primary">{{ \Carbon\Carbon::create()->day(1)->month($ip->period)->format('F') }}</small>
                @endforeach
            </td>
            <td>{{ $item->step }}</td>
            <td>{{ $item->invoiceDetail->count() }}</td>
            <td>{{ number_format($item->invoiceDetail->sum('jumlah_bayar')) }}</td>
            <td>{{ $item->status->name }}</td>
            <td>
                <button type="button" class="btn btn-default " data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="{{ route('printTagihan', $item->id) }}">Cetak</a>
                    @if ($item->status_id != 3)
                    <a class="dropdown-item" href="{{ route($modul.'.edit', $item->id) }}">Edit</a>
                    <a class="dropdown-item" href="javascript:;" data-toggle="modal" onclick="deleteData('{{$item->id}}')" data-target="#DeleteModal">Hapus</a>
                    @endif
                </div>
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