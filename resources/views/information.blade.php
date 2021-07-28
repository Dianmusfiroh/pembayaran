@extends('adminlte::page')

@section('title', 'Info Loker | SIPENAS')

@section('content_header')
    <h1 class="m-0 text-dark">Informasi Lowongan Pekerjaan</h1>
@stop

@section('content')
        <div class="card">
            <div class="card-header">
                <div class="card-title">{{ $item->institute->name }} Membutuhkan <strong>{{ $item->position->name }}</strong></div>
                <div class="card-tools">
                    <strong>{{ $item->formation->count() }}</strong> Orang Sudah Mendaftar
                </div>
            </div>
            <div class="card-body">
                <p><strong>Kualifikasi Peserta</strong>
                    <ul>
                        <li>{{ $item->qualification->name }}</li>
                    </ul>
                </p>
                <p>
                    <strong>Persyaratan</strong>
                    <ul>
                    @foreach ($item->position->positionCategory->assesmentForm as $p)
                        <li>{{ $p->assessment_option->name }}</li>                
                    @endforeach
                </ul>
                </p>
                <p>
                    <strong>Kuota</strong> : {{ $item->quantity }} Orang
                </p>
                <blockquote class="quote-secondary">
                <p>Segera daftarkan diri anda, dan antar berkas anda ke <strong>Dinas Pendidikan dan Kebudayaan Kabupaten Gorontalo Utara</strong></p>
                </blockquote>
                <p>
                    <strong>Status</strong>
                    <small> <cite title="Source Title"><strong>Open</strong></cite></small>
                </p>
            </div>
            <div class="card-footer">
                @if (empty($status_pendaftar))
                     <form action="{{ url('apps/bid/'.$item->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="formation_needs_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
                        </form>
                @endif
            </div>
        </div>
    @include('sweetalert::alert')
@stop
