@extends('layouts.app')
@section('card-title-before','Update')
@section('card-title','')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan Perubahan</button>
@endsection
@section('back-button', url('apps/biodata'))
@section('form-create')
<form action="{{ route($modul.'.update',$cp->id)}}" method="POST">
    @csrf
    @method('PUT')
    @endsection
    @section('card-header-extra')
    <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
                <a class="nav-link active" href="#biodata" data-toggle="tab">Biodata</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#rekening" data-toggle="tab">Rekening</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#informasi" data-toggle="tab">Informasi Tenaga Kependidikan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#informasi_pendidikan" data-toggle="tab">Pendidikan</a>
            </li>
        </ul>
    </div>
    @endsection
    @section('card-body')
    <div class="tab-content">
        <div class="tab-pane active" id="biodata">
            <div class="form-group row">
                <div class="label col-md-2">NIK</div>
                <div class="col-md-9">
                    <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukan NIK" required
                        value="{{ $cp->nik }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Nama Lengkap</div>
                {{-- <div class="col-md-9"> --}}
                <div class="col-md-2">
                    <input type="text" name="title_ahead" id="title_ahead" class="form-control"
                        placeholder="Gelar Depan" value="{{ $cp->title_ahead }}">
                </div>
                <div class="col-md-5">
                    <input type="text" name="full_name" id="full_name" class="form-control"
                        placeholder="Masukan Nama Lengkap" value="{{ $cp->full_name }}" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="back_title" id="back_title" class="form-control"
                        placeholder="Gelar Belakang" value="{{ $cp->back_title }}">
                </div>
                {{-- </div> --}}
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Jenis Kelamin</div>
                <div class="col-md-9">
                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin_pria" value="1" {{ $cp->jenis_kelamin ? 'checked' : '' }} > Laki-laki
                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin_wanita" value="0" {{ $cp->jenis_kelamin ? '' : 'checked' }}> Perempuan
                </div>
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
                        placeholder="Masukan Tempat Lahir" required value="{{ $cp->place_of_birth }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="label col-md-2">Alamat</label>
                <div class="col-md-9">
                    <textarea class="form-control" name="alamat" id="alamat" rows="3"
                        placeholder="Alamat ">{{ $cp->user->address ? $cp->user->address->name : '' }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Desa/Kelurahan</div>
                <div class="col-md-9">
                    <input type="text" name="desa" id="desa" class="form-control" placeholder="Masukan Desa/Kelurahan"
                        value="{{ $cp->user->address ? $cp->user->address->villages->name : '' }}" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Kecamatan</div>
                <div class="col-md-9">
                    <input type="text" name="kecamatan" id="kecamatan" class="form-control"
                        placeholder="Masukan Kecamatan"
                        value="{{ $cp->user->address ? $cp->user->address->sub_districts->name : '' }}" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Kabupaten/Kota</div>
                <div class="col-md-9">
                    <input type="text" name="kabupaten" id="kabupaten" class="form-control"
                        placeholder="Masukan Kabupaten/Kota" required
                        value="{{ $cp->user->address ? $cp->user->address->districts->name : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Provinsi</div>
                <div class="col-md-9">
                    <input type="text" name="provinsi" id="provinsi" class="form-control" placeholder="Masukan Provinsi"
                        required value="{{ $cp->user->address ? $cp->user->address->province->name : '' }}">
                </div>
            </div>
        </div>
        <div class="tab-pane" id="rekening">
            @if ($gttFind != null)
            <div class="form-group row">
                <div class="label col-md-2">Nama Bank</div>
                <div class="col-md-9">
                    <input type="text" name="bank_name" id="bank_name" class="form-control"
                        placeholder="Masukan Nama Bank" value="{{ $cp->rekening ? $cp->rekening->bank_name : ''}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Nama Akun Bank</div>
                <div class="col-md-9">
                    <input type="text" name="account_name" id="account_name" class="form-control"
                        placeholder="Masukan Nama Akun Bank"
                        value="{{ $cp->rekening ? $cp->rekening->account_name : ''}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Nomor Rekening</div>
                <div class="col-md-9">
                    <input type="text" name="account_number" id="account_number" class="form-control"
                        placeholder="Masukan Nomor Rekening"
                        value="{{ $cp->rekening ? $cp->rekening->account_number : ''}}">
                </div>
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                <span class="text-danger">
                    Anda Belum Terdaftar Menjadi Pegawai
                </span>
            </div>
            @endif
        </div>
        <div class="tab-pane" id="informasi">
            <div class="form-group row">
                <div class="label col-md-2">NUPTK</div>
                <div class="col-md-9">
                    <input type="text" name="nuptk" id="nuptk" class="form-control" placeholder="Masukan NUPTK"
                        value="{{ $cp->nuptk }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Nomor Sertifikasi</div>
                <div class="col-md-9">
                    <input type="text" name="no_cert" id="no_cert" class="form-control"
                        placeholder="Masukan Nomor Sertifikat"
                        value="{{ $cp->user->certification ?  $cp->user->certification->no_cert : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Nomor Peserta</div>
                <div class="col-md-9">
                    <input type="text" name="no_part" id="no_part" class="form-control"
                        placeholder="Masukan Nomor Peserta"
                        value="{{ $cp->user->certification ?  $cp->user->certification->no_part : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">NRG</div>
                <div class="col-md-9">
                    <input type="text" name="nrg" id="nrg" class="form-control" placeholder="Masukan NRG"
                        value="{{ $cp->user->certification ?  $cp->user->certification->nrg : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Tahun Sertifikat</div>
                <div class="col-md-9">
                    <input type="text" name="year_cert" class="form-control" placeholder="Tahun Sertifikat"
                        value="{{ $cp->user->certification ?  $cp->user->certification->year_cert : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">TMT Kontrak Pertama</div>
                <div class="col-md-9">
                    <input type="date" value="{{ $cp->tmt_start }}" name="tmt_start" id="tmt_start"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">TMT Kontrak Selesai</div>
                <div class="col-md-9">
                    <input type="date" value="{{ $cp->tmt_end }}" name="tmt_end" id="tmt_end" class="form-control">
                </div>
            </div>
        </div>
        <div class="tab-pane" id="informasi_pendidikan">
            <div class="form-group row">
                <div class="label col-md-2">Pendidikan Terkahir</div>
                <select name="qualification" id="qualification" class="form-control col-md-9">
                    @foreach ($qualifikasi as $item)
                    @if ( $cp->user->education && $item->id == $cp->user->education->qualification_id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Fakultas</div>
                <div class="col-md-9">
                    <input type="text" name="department" id="department" class="form-control"
                        placeholder="Masukan Fakultas"
                        value="{{ $cp->user->education ? $cp->user->education->department->name : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Prodi</div>
                <div class="col-md-9">
                    <input type="text" name="study_program" id="study_program" class="form-control"
                        placeholder="Masukan Prodi"
                        value="{{ $cp->user->education ? $cp->user->education->study_program->name : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Institusi</div>
                <div class="col-md-9">
                    <input type="text" name="department" id="department" class="form-control"
                        placeholder="Masukan Institusi"
                        value="{{ $cp->user->education ? $cp->user->education->department->name : '' }}" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-2">Tahun Lulus</div>
                <select name="year_edu" id="year_edu" class="form-control col-md-9">
                    <option selected>Pilih Tahun 1990 s.d Tahun Sekarang</option>
                    @foreach (range(1990,date('Y')) as $item)
                    @if ($cp->user->education && $cp->user->education->year_edu == $item)
                    <option value="{{ $item }}" selected>{{ $item }}</option>
                    @else
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    @endsection