@extends('adminlte::page')

@section('title', 'Dashboard | SIPENAS')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">Selamat datang di Aplikasi Pembayaran Gaji Guru Tidak Tetap</p>
            </div>
        </div>
    </div>
</div>
@canany(['isPimpinan','isPembayaran','isAdmin'])
<div class="row">
    <div class="col">
        <div class="card" style="background-color: #feb953;">
            <div class="card-body border-0 text-center  text-white">
                <h2>Pagu Anggaran</h2>
                <h2><strong>Rp. {{ $pagu ? number_format($pagu->jumlah) : 0 }}</strong></h2>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="background-color: #4bf2d2;">
            <div class="card-body border-0 text-center  text-white">
                <h2>Prediksi Realisasi</h2>
                <h2><strong>Rp. {{ number_format(($prediksi*12)) }}</strong></h2>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="background-color: #0aa2fa;">
            <div class="card-body border-0 text-center  text-white">
                <h2>Prediksi Sisa Anggaran</h2>
                <h2><strong>Rp. {{ $pagu ? number_format($pagu->jumlah - ($prediksi*12)) : 0 }}</strong></h2>
            </div>
        </div>
    </div>
</div>
@endcanany
{{--
@canany(['isAdmin','isPembayaran'])
<div class="row">
    <div class="col">
        <h3 class="mb-2 text-dark">Realisasi</h3>
    </div>
    <div class="col-md-3 text-right">
        Periode 28 Sep 2020
    </div>
</div>
<div class="row">
    <?php
        $arr_color = ['#fa5252','#feeb53','#54eca4','#0bd0fa','#fc7b52','#feb953','#4bf2d2','#0aa2fa'];
    ?>
    @if (!empty($realisasi_per_jenjang))
    @foreach ($realisasi_per_jenjang as $key => $val)
    <div class="col-3">
        <div class="card" style="background-color:{{ $arr_color[$key] }}">
            <div class="card-body border-0 text-center text-white">
                <h2>{{ $val->jenjang }}</h2>
                <h2><strong>Rp. {{ number_format($val->total) }}</strong></h2>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endcanany --}}
{{-- <div class="row">
    <div class="col d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">
                <h3 class="card-title text-bold">Total Pendaftar</h3>
            </div>
            <div class="card-body align-items-center d-flex justify-content-center">
                <h5 class="text-center text-bold" id="total_pendaftar">0</h5>
            </div>
        </div>
    </div>
    <div class="col d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">
                <h3 class="card-title text-bold">Melamar</h3>
            </div>
            <div class="card-body align-items-center d-flex justify-content-center">
                <h5 class="text-center text-bold" id="total_melamar">0</h5>
            </div>
        </div>
    </div>
    <div class="col d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">
                <h3 class="card-title text-bold">Lulus</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">Tahap I</div>
                    <div class="col">
                        <h5 class="text-right text-bold" id="lulus_tahap_I">0</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Tahap II</div>
                    <div class="col">
                        <h5 class="text-right text-bold" id="lulus_tahap_II">0</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">
                <h3 class="card-title text-bold">Tidak Lulus</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">Tahap I</div>
                    <div class="col">
                        <h5 class="text-right text-bold" id="tidak_lulus_tahap_I">0</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Tahap II</div>
                    <div class="col">
                        <h5 class="text-right text-bold" id="tidak_lulus_tahap_II">0</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row"> --}}

</div>
@section('js')
<script>
    $(document).ready(function(){
        dash_peserta();
    });
    const dash_peserta = () => {
        $.ajax({
        type: "GET",
        url: "{{url('dashboard_pendaftaran')}}",
        dataType: 'json',
        async: true,
        beforeSend: function () {
            $("#total_pendaftar").html("Loading...");
            $("#total_melamar").html("Loading...");
            $("#lulus_tahap_I").html("Loading...");
            $("#lulus_tahap_II").html("Loading...");
            $("#tidak_lulus_tahap_I").html("Loading...");
            $("#tidak_lulus_tahap_II").html("Loading...");
        },
        success: function (response) {
            console.log(response);
            console.log(response.data[0].total_mendaftar);
            $("#total_pendaftar").html(response.data[0].total_mendaftar);
            $("#total_melamar").html(response.data[0].total_melamar);
            $("#lulus_tahap_I").html(response.data[0].total_lulus_1);
            $("#lulus_tahap_II").html(response.data[0].total_lulus_2);
            $("#tidak_lulus_tahap_I").html(response.data[0].total_tidak_lulus_1);
            $("#tidak_lulus_tahap_II").html(response.data[0].total_tidak_lulus_2);
        }
    }).done(function () {

    });
    }
</script>
@endsection
{{-- @endcan --}}
@can('isUser')
@if (!empty($status_pendaftar))
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if ($status_pendaftar->status_id == 4)
                <p class="mb-0">Lamaran anda untuk posisi
                    <strong>{{ $status_pendaftar->formation_needs->position->name }}</strong> di
                    <strong>{{ $status_pendaftar->formation_needs->institute->name }} sedang diproses</strong></p>
                <div class="float-right">
                    <a href="{{ route("cetakKartuRegistrasi",[$status_pendaftar->formation_needs->id,$status_pendaftar->candidate_id]) }}"
                        title="Cetak Kartu"><i class="fa fa-print"></i></a>
                </div>
                @elseif($status_pendaftar->status_id == 5)
                <p class="mb-0">Selamat <strong>lulus</strong> jadi
                    <strong>{{ $status_pendaftar->formation_needs->position->name }}</strong> di
                    <strong>{{ $status_pendaftar->formation_needs->institute->name }}</strong></p>
                @else
                <p class="mb-0">Maaf anda <strong>belum lulus</strong> jadi
                    <strong>{{ $status_pendaftar->formation_needs->position->name }}</strong> di
                    <strong>{{ $status_pendaftar->formation_needs->institute->name }}</strong></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endcan
@stop
