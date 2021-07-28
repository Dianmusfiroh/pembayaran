@extends('adminlte::page')

@section('title', 'Info Loker | SIPENAS')

@section('content_header')
<h1 class="m-0 text-dark">Informasi Lowongan Pekerjaan</h1>
@stop

@section('content')

@if (strlen($nik->nik) != 16)

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ $nik->full_name }}</strong>, Mohon lengkapi biodata anda terlabih dahulu
    <br>
    <a href="{{ url('apps/biodata/'. $nik->id . '/edit' ) }}">Lengkapi biodata</a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@elseif (!empty($status_pendaftar) && $status_pendaftar->status_id >= 4)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">Anda sudah terdaftar jadi <strong>{{ $status_pendaftar->formation_needs->position->name }}</strong> di <strong>{{ $status_pendaftar->formation_needs->institute->name }}</strong></p>
                <p>Informasi Lowongan Kerja hanya akan muncul jika anda belum terdaftar di <strong>Instansi Pendidikan</strong> Gorontalo Utara</p>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">Halaman ini memuat informasi terkait kebutuhan tenaga honor daerah di lingkungan Dinas Pendidikan Kabupaten Gorontalo Utara</p>
            </div>
        </div>
    </div>
</div>
{{-- <ul class="nav nav-tabs nav-pills nav-fill" id="InformationTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="apbd-tab" data-toggle="tab" href="#apbd" role="tab" aria-controls="apbd" aria-selected="true">FORMASI APBD</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="dana-bos-tab" data-toggle="tab" href="#dana-bos" role="tab" aria-controls="dana-bos" aria-selected="false">FORMASI DANA BOS</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="apbd-desa-tap" data-toggle="tab" href="#apbddesa" role="tab" aria-controls="apbddesa" aria-selected="false">FORMASI APBD DESA</a>
    </li>
</ul>
<div class="tab-content" id="InformationTabContent">
    <div class="tab-pane fade show active" id="apbd" role="tabpanel" aria-labelledby="apbd-tab">
        Formasi APBD
    </div>
    <div class="tab-pane fade" id="dana-bos" role="tabpanel" aria-labelledby="dana-bos-tab">
        Formasi DANA BOS
    </div>
    <div class="tab-pane fade" id="apbddesa" role="tabpanel" aria-labelledby="apbd-desa-tap">Formasi APB DES</div>
</div> --}}
<div class="table-responsive">
<table class="table table-hover" id="myTable">
    <thead>
        <tr>
            <th>Kategori</th>
            <th>NPSN</th>
            <th>NAMA SEKOLAH</th>
            <th>KECAMATAN</th>
            <th>JABATAN</th>
            <th>Kuota</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($formationNeeds as $item)
        <tr>
            <td>{{ $item->formation_category ? $item->formation_category->name : '' }}</td>
            <td>{{$item->institute->npsn}}</td>
            <td>{{$item->institute->name}}</td>
            <td>{{$item->institute->sub_districts->name}}</td>
            <td>{{$item->position->name}}</td>
            <td>{{$item->quantity}}</td>
            <th><a href="{{ url('apps/informasi/'.$item->id) }}" class="btn btn-sm btn-primary" title="Salengkapnya"><i class="fa fa-eye"></i></a></th>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endif
@include('sweetalert::alert')
@stop
@section('plugins.Datatables', true)
@section('js')
<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true                        
                });
</script>    
@endsection