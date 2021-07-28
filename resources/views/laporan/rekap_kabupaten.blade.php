@extends('layouts.app')
@section('card-body')
@section('card-header-extra')
<div class="float-right">
    <select name="f_tahun" id="f_tahun" class="form-control">
        @foreach (range(2019,date('Y')) as $f)
        <option value="{{ $f }}" {{ $f == date('Y') ? 'selected' : '' }}>{{ $f }}</option>
        @endforeach
    </select>
</div>
@endsection
<table class="table table-bordered table-sm" id="myTable">
    <thead>
        <tr>
            <th rowspan="2">Kabupaten</th>
            <th colspan="2">Jumlah</th>
            <th rowspan="2">Total</th>
            <th rowspan="2">Jumlah Bayar</th>
            {{-- <th rowspan="2">Aksi</th> --}}
        </tr>
        <tr>
            <th>Guru</th>
            <th>Tendik</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($detail as $item)
        <tr>
            <td>
                {{ $item->Kabupaten }}
            </td>
            <td>
                {{$item->Guru}}
            </td>
            <td>{{$item->tendik}}</td>
            <td>
                {{ $item->jumlah_bayar }}
            </td>
            <td>
                {{ $item->jumlah_bayar }}
            </td>
            <td>
                <!-- {{-- <a href="#" class="btn badge-primary">cetak</a> --}}
                {{-- <a href="#" class="btn badge-danger">hapus</a> --}}
                {{-- <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id}})"
                    data-target="#DeleteModal" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i>
                    Delete</a> --}} -->
            </td>
        </tr>
        <tr>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('css')
<style>
    #myTable th {
        vertical-align: middle;
        text-align: center;
    }
</style>
@endsection
@section('plugins.Datatables', true)
@section('js')
<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });

</script>
{{-- @include('layouts.script.delete') --}}
@endsection
