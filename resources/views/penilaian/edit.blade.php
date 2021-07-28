@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button', url('pendaftaran/peserta'))
@section('form-create')
<form action="{{ route($modul.'.update',$cp->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-body')
    <div class="form-group row">
        <div class="label col-md-2">NIK</div>
        <div class="col-md-9">
            <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukan NIK" required
                value=" {{ $cp->nik }} ">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Nama Lengkap</div>
        {{-- <div class="col-md-9"> --}}
        <div class="col-md-2">
            <input type="text" name="title_ahead" id="title_ahead" class="form-control" placeholder="Gelar Depan"
                value=" {{ $cp->title_ahead }} ">
        </div>
        <div class="col-md-5">
            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Masukan Nama Lengkap"
                value=" {{ $cp->full_name }} " required>
        </div>
        <div class="col-md-2">
            <input type="text" name="back_title" id="back_title" class="form-control" placeholder="Gelar Belakang"
                value=" {{ $cp->back_title }} ">
        </div>
        {{-- </div> --}}
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Tanggal Lahir</div>
        <div class="col-md-9">
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder=""
                value="{{ $cp->date_of_birth }}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Tempat Lahir</div>
        <div class="col-md-9">
            <input type="text" name="place_of_birth" id="place_of_birth" class="form-control"
                placeholder="Masukan Tempat Lahir" required value=" {{ $cp->place_of_birth }} ">
        </div>
    </div>
    <div class="form-group row">
        <label for="alamat" class="label col-md-2">Alamat</label>
        <div class="col-md-9">
            <textarea class="form-control" name="alamat" id="alamat" rows="3"
                placeholder=" {{ $address->name }} ">{{ $address->name }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Desa/Kelurahan</div>
        <div class="col-md-9">
            <input type="text" name="desa" id="desa" class="form-control" placeholder="Masukan Desa/Kelurahan"
                value=" {{ $village->name }} " required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Kecamatan</div>
        <div class="col-md-9">
            <input type="text" name="kecamatan" id="kecamatan" class="form-control" placeholder="Masukan Kecamatan"
                value="{{ $sub_district->name }}" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Kabupaten/Kota</div>
        <div class="col-md-9">
            <input type="text" name="kabupaten" id="kabupaten" class="form-control" placeholder="Masukan Kabupaten/Kota"
                required value="{{ $district->name }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Provinsi</div>
        <div class="col-md-9">
            <input type="text" name="provinsi" id="provinsi" class="form-control" placeholder="Masukan Provinsi"
                required value=" {{ $province->name }} ">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-12 pl-5">Informasi Pendidik/Tenaga Kependidikan
            <hr>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">NUPTK</div>
        <div class="col-md-9">
            <input type="text" name="nuptk" id="nuptk" class="form-control" placeholder="Masukan NUPTK"
                value=" {{ $cp->nuptk }} ">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Nomor Sertifikasi</div>
        <div class="col-md-9">
            <input type="text" name="no_cert" id="no_cert" class="form-control" placeholder="Masukan Nomor Sertifikat"
                value=" {{ $certification->no_cert }} " required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Nomor Peserta</div>
        <div class="col-md-9">
            <input type="text" name="no_part" id="no_part" class="form-control" placeholder="Masukan Nomor Peserta"
                value=" {{ $certification->no_cert }} ">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">NRG</div>
        <div class="col-md-9">
            <input type="text" name="nrg" id="nrg" class="form-control" placeholder="Masukan NRG"
                value=" {{ $certification->nrg }} ">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Tahun Sertifikat</div>
        <select name="year_cert" id="year_cert" class="form-control col-md-9">
            <option value=" {{ $certification->year_cert }} " selected> {{ $certification->year_cert }} </option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
        </select>
    </div>
    <div class="form-group row">
        <div class="label col-md-12 pl-5">Informasi Kualifikasi Pendidikan
            <hr>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Jenjang Terkahir</div>
        <select name="qualification" id="qualification" class="form-control col-md-9">
            @foreach ($qualifikasi as $item)
            <option value=" {{ $item->id }} ">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Fakultas</div>
        <div class="col-md-9">
            <input type="text" name="institution" id="institution" class="form-control" placeholder="Masukan Fakultas"
                value=" {{ $institution->name }} ">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Prodi</div>
        <div class="col-md-9">
            <input type="text" name="study_program" id="study_program" class="form-control" placeholder="Masukan Prodi"
                value=" {{ $study_program->name }} ">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Institusi</div>
        <div class="col-md-9">
            <input type="text" name="department" id="department" class="form-control" placeholder="Masukan Institusi"
                value=" {{ $department->name }} " required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Tahun Lulus</div>
        <select name="year_edu" id="year_edu" class="form-control col-md-9">
            <option selected>Pilih Tahun 1990 s.d Tahun Sekarang</option>
            @foreach (range(1990,date('Y')) as $item)
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
            <input type="date" value="{{ $cp->tmt_start }}" name="tmt_start" id="tmt_start" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">TMT Kontrak Selesai</div>
        <div class="col-md-9">
            <input type="date" value="{{ $cp->tmt_end }}" name="tmt_end" id="tmt_end" class="form-control">
        </div>
    </div>

    @endsection