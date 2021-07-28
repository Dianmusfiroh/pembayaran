@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('pendaftaran/peserta'))
@section('form-create')
<form action="{{ route($modul.'.store')}}" method="POST">
    @csrf
    @endsection
    @section('card-body')

    {{-- Display validasi error --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <p><strong>Opps Something went wrong</strong></p>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{-- end Display validasi --}}

    <div class="form-group row">
        <div class="label col-md-2">NIK</div>
        <div class="col-md-9">
            <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukan NIK"
                value="{{ old('nik') }}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Nama Lengkap</div>
        {{-- <div class="col-md-9"> --}}
        <div class="col-md-2">
            <input type="text" name="title_ahead" id="title_ahead" class="form-control" value="{{ old('title_ahead') }}"
                placeholder="Gelar Depan">
        </div>
        <div class="col-md-5">
            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Masukan Nama Lengkap"
                value="{{ old('full_name') }}" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="back_title" id="back_title" class="form-control" placeholder="Gelar Belakang"
                value="{{ old('back_title') }}">
        </div>
        {{-- </div> --}}
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Tanggal Lahir</div>
        <div class="col-md-9">
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                placeholder="Masukan Tanggal Lahir" value="{{ old('date_of_birth') }}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Tempat Lahir</div>
        <div class="col-md-9">
            <input type="text" name="place_of_birth" id="place_of_birth" class="form-control"
                placeholder="Masukan Tempat Lahir" value="{{ old('place_of_birth') }}" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="alamat" class="label col-md-2">Alamat</label>
        <div class="col-md-9">
            <textarea class="form-control" name="alamat" id="alamat" rows="3"
                placeholder=""> {{ old('alamat') }} </textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Desa/Kelurahan</div>
        <div class="col-md-9">
            <input type="text" name="desa" id="desa" class="form-control" placeholder="Masukan Desa/Kelurahan" required
                value="{{ old('desa') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Kecamatan</div>
        <div class="col-md-9">
            <input type="text" name="kecamatan" id="kecamatan" class="form-control" placeholder="Masukan Kecamatan"
                required value="{{ old('kecamatan') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Kabupaten/Kota</div>
        <div class="col-md-9">
            <input type="text" name="kabupaten" id="kabupaten" class="form-control" placeholder="Masukan Kabupaten/Kota"
                required value="{{ old('kabupaten') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Provinsi</div>
        <div class="col-md-9">
            <input type="text" name="provinsi" id="provinsi" class="form-control" placeholder="Masukan Provinsi"
                required value="{{ old('provinsi') }}">
        </div>
    </div>
    @can('isAdmin')
    <div class="form-group row">
        <div class="label col-md-12 pl-5">Informasi Akun Pengguna
            <hr>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Masukan Kata Sandi</div>
        <div class="col-md-9">
            <input type="text" name="password" id="password" class="form-control" placeholder="Masukan Kata Sandi"
                value="{{ old('password') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Masukan Alamat Surel</div>
        <div class="col-md-9">
            <input type="text" name="email" id="email" class="form-control"
                placeholder="Alamat Surel (exp. example@gmail.com)" value="{{ old('email') }}">
        </div>
    </div>
    @endcan
    <div class="form-group row">
        <div class="label col-md-12 pl-5">Informasi Pendidik/Tenaga Kependidikan
            <hr>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">NUPTK</div>
        <div class="col-md-9">
            <input type="text" name="nuptk" id="nuptk" class="form-control" placeholder="Masukan NUPTK"
                value="{{ old('nuptk') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Nomor Sertifikasi</div>
        <div class="col-md-9">
            <input type="text" name="no_cert" id="no_cert" class="form-control" placeholder="Masukan Nomor Sertifikat"
                value="{{ old('no_cert') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Nomor Peserta</div>
        <div class="col-md-9">
            <input type="text" name="no_part" id="no_part" class="form-control" placeholder="Masukan Nomor Peserta"
                value="{{ old('no_part') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">NRG</div>
        <div class="col-md-9">
            <input type="text" name="nrg" id="nrg" class="form-control" placeholder="Masukan NRG"
                value="{{ old('nrg') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Tahun Sertifikat</div>
        <select name="year_cert" id="year_cert" class="form-control col-md-9">
            <option selected>Pilih Tahun 1990 s.d Tahun Sekarang</option>
            @foreach (range(1990,date('Y')) as $item)
            <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <div class="label col-md-12 pl-5">Informasi Kualifikasi Pendidikan
            <hr>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Pendidikan Terkahir</div>
        <select name="qualification" id="qualification" class="form-control col-md-9">
            <option selected>Pilih</option>
            @foreach ($qualifikasi as $item)
            <option value=" {{ $item->id }} "> {{ $item->name }} </option>
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Fakultas</div>
        <div class="col-md-9">
            <input type="text" name="institution" id="institution" class="form-control" placeholder="Masukan Fakultas"
                value="{{ old('institution') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Prodi</div>
        <div class="col-md-9">
            <input type="text" name="study_program" id="study_program" class="form-control" placeholder="Masukan Prodi"
                value="{{ old('study_program') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Institusi</div>
        <div class="col-md-9">
            <input type="text" name="department" id="department" class="form-control" placeholder="Masukan Institusi"
                value="{{ old('department') }}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Tahun Lulus</div>
        <select name="year_edu" id="year_edu" class="form-control col-md-9">
            <option selected>Pilih Tahun 1980 s.d Tahun Sekarang</option>
            @foreach (range(1980,date('Y')) as $item)
            <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <div class="label col-md-12 pl-5">Informasi Kontak Daerah
            <hr>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">TMT Kontrak Pertama</div>
        <div class="col-md-9">
            <input type="date" name="tmt_start" id="tmt_start" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">TMT Kontrak Selesai</div>
        <div class="col-md-9">
            <input type="date" name="tmt_end" id="tmt_end" class="form-control">
        </div>
    </div>

    @endsection