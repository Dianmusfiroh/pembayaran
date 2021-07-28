@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('/kinerja'))

@section('form-create')
<form action="{{ route($modul.'.store')}}" method="POST">
    @csrf
    @endsection
    @section('card-body')
    {{-- <input type="hidden" name="sk" id="id" value="{{ $sk->id }}" class="form-control"> --}}

    <div class="form-group row">
        <div class="label col-md-3">Nik Guru</div>
        <div class="col-md-9">
            <select name="gtt_id" id="peserta" class="form-control" >

            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Bulan</div>
        <div class="col-md-9">

            <input type="text" name="month_name" id="month_month" value="{{{date("F ")}}}" class="form-control" readonly>
            <input type="hidden" name="month" value="{{ date('m') }}">


        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Tahun</div>
        <div class="col-md-9">
            <input type="text" name="year" id="year" class="form-control year" readonly value="{{date('Y')}}">


        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Kinerja %</div>
        <div class="col-md-9">
            <input type="text" name="presentase" id="presentase" class="form-control" placeholder="Masukan kinerja" required>
        </div>
    </div>

    @include('sweetalert::alert')
    @endsection
    @section('plugins.Select2', true)
    @section('js')
        <script>
            $( "#peserta" ).select2({
                ajax: {

                    // url: "{{url('gtt/search')}}",
                    url: "{{url('Kinerja/search')}}",

                // url: "{{route('searchGtt')}}",

                    dataType: 'json',
                    delay: 250,
                    data: function (term, page) {
                        return {
                            search: term.term, // search term
                            searchFields:'nik:like'
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }

            });
        </script>
    @endsection
