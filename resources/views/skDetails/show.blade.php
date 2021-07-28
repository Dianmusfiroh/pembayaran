@extends('layouts.app')
@canany(['isPembayaran','isAdmin'])
    @section('card-header-extra')
<div class="float-right">
    <a href="{{ route("createPesertaSK",$sk->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Tambahh
        Data</a>
    {{-- <a href="{{ route("generatePesertaSk") }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Generate SK</a> --}}

</div>
@endsection
@endcanany
@section('card-body')
<div class="form-group row">
        <div class="label col-md-3">No SK</div>
        <div class="col-md-9">
            <input type="text" name="no_sk" id="no_sk" disabled class="form-control" placeholder="Masukan No SK" value="{{$sk->no_sk}}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tanggal Mulai</div>
        <div class="col-md-9">
            <input type="date" name="start_date" id="start_date" disabled class="form-control" placeholder="Masukan Waktu Mulai" value="{{$sk->start_date}}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tanggal Selesai</div>
        <div class="col-md-9">
            <input type="date" name="end_date" id="end_date" disabled class="form-control" placeholder="Masukan Waktu Selesai" value="{{$sk->end_date}}" required>
        </div>
    </div>
<table class="table table-bordered table-striped table-sm" id="myTable">
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>NUPTK</th>
            <th>Nama Lengkap</th>
            <th>Instansi</th>
            <th>Kualifikasi</th>
            <th>Jabatan</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($sk->sk_detail as $k => $item)
           <td>{{ ($k+1) }}</td>
           <td>{{ $item->gtt->nik }}</td>
           <td>{{ $item->gtt->nuptk }}</td>
           <td>{{ $item->gtt->full_name }}</td>
           <td>{{ $item->gtt->institute->name }}</td>
           <td>{{ $item->gtt->qualification->name }}</td>
           <td>{{ $item->gtt->position->name }}</td>
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
                var url = '';
    const deleteData = (id) =>{
        url = '{{route("skdetail.destroy",":id")}}';
        url = url.replace(':id',id);
        $("#deleteForm").attr('action',url);
    }
    const formSubmit = () => {
        $("#deleteForm").submit();
    }
</script>
@endsection
