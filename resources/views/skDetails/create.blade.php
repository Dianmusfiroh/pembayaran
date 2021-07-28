@extends('layouts.app')
@section('card-title-before','Tambah')
@section('card-title','SK')
@section('button-save')
    <button type="submit" class="btn btn-primary float-right ml-2" title="Save" ><i class="fas fa-fw fa-save"></i> Simpan</button>


@endsection
@section('back-button',url('apps/sk/'.$sk->id))
@section('form-create')
    <form action="{{ route('storePesertaSK',$sk->id)}}" method="POST">
        @csrf
@endsection
@section('card-body')

    <input type="hidden" name="sk" id="id" value="{{ $sk->id }}" class="form-control">
    <div class="form-group row">
        <div class="label col-md-3">No SK</div>
        <div class="col-md-9">
            <input type="text" name="no_sk" id="no_sk" disabled class="form-control" placeholder="Masukan No SK" value="{{ $sk->no_sk }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Nik Guru</div>
        <div class="col-md-9">
            <select name="peserta[]" id="peserta" multiple class="form-control">

            </select>
        </div>
    </div>
@include('sweetalert::alert')
@endsection
@section('plugins.Select2', true)
@section('js')
    <script>
        $( "#peserta" ).select2({
            ajax: {

                url: "{{url('gtt/search')}}",
                dataType: 'json',
                delay: 250,
                data: function (term, page) {
                    return {
                        search: term.term, // search term
                        searchFields:'nik:like',
                        sk:"{{$sk->id}} "
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
