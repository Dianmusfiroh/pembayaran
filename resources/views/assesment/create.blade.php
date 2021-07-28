@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
{{-- <button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
    <button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Lulus</button>
    <button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Tidak Lulus</button> --}}
    <button type="button" class="btn btn-primary float-right ml-2" data-toggle="dropdown">
                    Aksi &nbsp;&nbsp;<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu" style="">
                    <a class="dropdown-item" onclick="formSave('4');" href="javascript:;" class="btn btn-sm btn-primary">Simpan</a>
                    <a class="dropdown-item" onclick="formSave('5');" href="javascript:;" class="btn btn-sm btn-primary">Simpan dan Lulus</a>
                    <a class="dropdown-item" onclick="formSave('6');" href="javascript:;" class="btn btn-sm btn-primary">Simpan dan Tidak Lulus</a>
                    </div>
@endsection
@section('back-button',url('pendaftaran/penilaian/'.$kategori))
@section('form-create')
<form action="{{ route($modul.'.store')}}" method="POST" id="frm">
    @csrf
    @endsection
    @section('card-body')
    <div class="form-group row">
        <div class="label col-md-3">Kandidat</div>
        <div class="col-md-9">
            <input type="hidden" name="candidate_id" id="candidate_id">
            <select name="candidate" class="form-control mt-2" id="candidate" required>
            
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Instansi Yang Dilamar</div>
        <div class="col-md-9">
            <input type="text" name="instansi" value="" id="instansi" class="form-control" readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Jabatan</div>
        <div class="col-md-9">
            <input type="hidden" name="formation_id" id="formation_id">
            <input type="text" name="position" value="" id="jabatan" class="form-control" readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Pendidikan Terakhir</div>
        <div class="col-md-9">
            <input type="text" name="education" value="" id="education" class="form-control" readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Opsi Penilaian</div>
        <div class="col-md-9">
            <ul>
                @foreach ($arr_opsi as $op)
                <li class="item">
                    <input type="checkbox" name="option_name[]" onclick="calculateTotal()" data-option-name="{{ $op['option_name'] }}" class="option_name" value="{{ $op['option_id'] }}"> {{ $op['option_name'] }}
                    <ul>
                        @foreach ($op['option_detail'] as $key => $item)
                        <li class="item">
                            @if ($op['option_name'] == 'SK Bupati')
                                <div class="row">
                                    <div class="col">
                                    <input type="checkbox" onclick="calculateTotal()" name="option_detail_description{{$op['option_id']}}[]" class="option_detail" value="{{ $item->id }}"> {{ $item->description }}
                                    </div>
                                    <div class="col">
                                        
                                            @for ($i = 2008; $i < date('Y'); $i++)
                                            <input type="checkbox" onclick="calculateTotal()" name="option_detail_score{{$op['option_id']}}_{{$item->id}}[]" data-score="{{$item->score}}" class="score" value="{{ $i }}"> {{ $i }}
                                            @endfor
                                        
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <input type="radio" onclick="calculateTotal()" name="option_detail_description{{$op['option_id']}}" class="option_detail" value="{{ $item->id }}"> {{ $item->description }}
                                    </div>
                                    <div class="col">
                                    <input type="number" name="option_detail_score{{$op['option_id']}}_{{$item->id}}" class="score form-control" value="{{ $item->score }}">
                                    </div>
                                </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </li>    
                @endforeach
            </ul>
            {{-- <div id="renderList"></div> --}}
        </div>
    </div>
    <div class="form-group row" style="display: none;">
        <div class="label col-md-3">Nilai Tes</div>
        <div class="col-md-9">
            <input type="number" name="nilai_test" id="nilai_test" min="0" value="0" onkeyup="calculateTotal()" class="form-control mt-2" placeholder="0" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Total Score</div>
        <div class="col-md-9">
            <input type="number" name="score" id="total_score" class="form-control mt-2" placeholder="0" required>
        </div>
    </div>
    @endsection
@section('css')
    <style>
        ul#proList{list-style-position: inside}
        li.item{list-style:none; padding:5px;}
    </style>
@endsection
 @section('plugins.Select2', true)
@section('js')
<script>
    $("#candidate").select2({
        placeholder: 'Cari...',
        ajax: {
        url: `{{url('pendaftaran/peserta/search')}}`,
        dataType: 'json',
        delay: 250,
        data: function (term, page) {
          return {
              search: term.term, // search term
              searchFields:'candidate.name:like',
              page_limit: 10,
              item:'{{$kat_id}}',
              slug:'{{$formation_category}}'
          };
        },
        processResults: function (data) {
            return {
            results:  $.map(data, function (item) {
                return {
                text: item.text,
                id: item.id
                }
            })
            };
        },
        cache: true
        }
    });
    var ul = document.createElement('ul');
    
    $("#candidate").change(function(){
        $.ajax({
            url: `{{url('pendaftaran/peserta/search')}}`,
            dataType: 'json',
            delay: 250,
            data: {
                search:$(this).val(), // search term
                searchFields:'id:='
            },
            success: function (data) {
                $("#instansi").val(data[0].instansi);
                $("#jabatan").val(data[0].jabatan);
                $("#formation_id").val(data[0].id);
                $("#candidate_id").val(data[0].candidate_id);
                $("#education").val(data[0].education+', '+data[0].program_studi)
            },
            cache: true
        });
        var els = document.getElementsByClassName("kelengkapan");
        for (let i = 0; i < els.length; i++) {
            const element = els[i];
        }
    });

    const calculateTotal = () => {
        var total = 0;
        var elementOptions = document.getElementsByClassName('option_name');
        // console.log(elements);
        for (let i = 0; i < elementOptions.length; i++) {
            const option = elementOptions[i];
            if (option.checked) {
                if (option.dataset.optionName == 'SK Bupati') {
                    var subOptions = document.getElementsByName('option_detail_description'+option.value+'[]');
                    for (let j = 0; j < subOptions.length; j++) {
                        const subOption = subOptions[j];
                        subOption.disabled = false;
                        var option_detail_score = document.getElementsByName('option_detail_score'+option.value+'_'+subOption.value+'[]');
                        if (subOption.checked) {
                            for (let k = 0; k < option_detail_score.length; k++) {
                                const element = option_detail_score[k];
                                element.disabled = false;  
                                if (element.checked) {
                                    total += parseInt(element.dataset['score']);
                                }
                            }
                        }else{
                            for (let k = 0; k < option_detail_score.length; k++) {
                                const element = option_detail_score[k];
                                element.disabled = true;
                                element.checked = false;
                            }
                        }
                    }
                    // console.log(subOptions);
                }else{
                    var subOptions = document.getElementsByName('option_detail_description'+option.value);
                    for (let j = 0; j < subOptions.length; j++) {
                        const subOption = subOptions[j];
                        subOption.disabled = false;
                        var option_detail_score = document.getElementsByName('option_detail_score'+option.value+'_'+subOption.value);
                        if (subOption.checked) {
                            option_detail_score[0].disabled = false;
                            total += parseInt(option_detail_score[0].value);
                        }else{
                            option_detail_score[0].disabled = true;
                        }
                    }
                }
            }else{
                if (option.dataset.optionName == 'SK Bupati') {
                    var subOptions = document.getElementsByName('option_detail_description'+option.value+'[]');
                    for (let j = 0; j < subOptions.length; j++) {
                        const subOption = subOptions[j];
                        subOption.checked = false;
                        subOption.disabled = true;
                        var option_detail_score = document.getElementsByName('option_detail_score'+option.value+'_'+subOption.value+'[]');
                        for (let k = 0; k < option_detail_score.length; k++) {
                            const element = option_detail_score[k];
                            element.checked = false;
                            element.disabled = true;
                        }
                    }
                    // console.log(subOptions);
                }else{
                    var subOptions = document.getElementsByName('option_detail_description'+option.value);
                    for (let j = 0; j < subOptions.length; j++) {
                        const subOption = subOptions[j];
                        subOption.checked = false;
                        subOption.disabled = true;
                        var option_detail_score = document.getElementsByName('option_detail_score'+option.value+'_'+subOption.value);
                        option_detail_score[0].disabled = true;
                    }
                }
            }
        }
        var nilai_test = $("#nilai_test").val();
        total = total+parseInt(nilai_test);
        $("#total_score").val(total);
    }
    calculateTotal();

    const formSave = (aksi='') => {
        if(typeof $("#status").val() != 'undefined'){
                document.getElementById('status').remove();
            }
        $("<input type='hidden' value='"+aksi+"' />")
            .attr("id","status")
            .attr("name","status")
            .prependTo("#frm");
    
        $("#frm").submit();
    }
</script>
@endsection