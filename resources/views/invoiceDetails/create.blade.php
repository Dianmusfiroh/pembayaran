@extends('layouts.app')
@section('card-title-before','Tambah Guru')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save" ><i class="fas fa-fw fa-save"></i> Simpan</button>
@endsection
@section('back-button',url('pembayaran/tagihan',['id'=>$invoice->id]))
@section('form-create')
    <form action="{{ route('storePesertaInvoice')}}" method="POST">
        @csrf
@endsection
@section('card-body')

    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
    <div class="form-group row">
        <div class="label col-md-3">No SPM</div>
        <div class="col-md-9">
            <input type="text" name="no_spm" id="no_spm" value="{{ $invoice->no_spm }}" disabled class="form-control" placeholder="Masukan No SPM" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Nik Guru</div>
        <div class="col-md-9">
            <select name="gtt_id" id="peserta" class="form-control">

            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Aktif</div>
        <div class="col-md-9">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="checkAll" id="checkAll"></th>
                            <th>Bulan</th>
                            <th>Kinerja (%)</th>
                            <th>Insentif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->invoicePeriod as $item)
                             <tr>
                             <td><input type="checkbox" name="volume[]" onclick="showHideKinerja()" class="volume" value="{{ $item->id }}" id="volume_{{$item->id}}"></td>
                                <td>{{ \Carbon\Carbon::create()->day(1)->month($item->period)->format('F') }}</td>
                                <td><input type="number" name="kinerja[]" onfocusout="calculateIncentive('{{$item->period}}')" value="100" disabled class="form-control kinerja" id="kinerja_{{$item->period}}" readonly></td>
                                <td><input type="number" name="incentive[]" class="form-control incentive" id="incentive_{{$item->id}}" readonly ></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-3">Jumlah Bayar</div>
        <div class="col-md-9">
            <input type="number" name="jumlah_bayar" readonly class="form-control" id="jumlah_bayar" value="0">
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
@section('plugins.Select2', true)
@section('js')
    <script>
        $( "#peserta" ).select2({
            ajax: {

                url: "{{route('searchGtt')}}",
                dataType: 'json',
                delay: 250,
                data: function (term, page) {
                    return {
                        search: term.term, // search term
                        searchFields:'nik:like',
                        invoice_id:"{{$invoice->id}}"
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
        $("#peserta").change(function(){
            $.ajax({
                url: "{{route('searchGtt')}}",
                dataType: 'json',
                delay: 250,
                data: {
                    search: $(this).val(), // search term
                    searchFields:'id:=',
                    period:'{{$item->periode}}',
                    tahun:'{{$item->invoice_date}}'
                },
                success: function (response) {
                    $("#jumlah_bayar").val(response.nilai_bayar);
                    response.gtt.kinerja.forEach(element => {
                        $("#kinerja_"+element.month).val(element.presentase);
                        $(".incentive").val(parseInt(response.nilai_bayar)*parseInt(element.presentase)/100);
                    });
                },
                cache: true
            });
        });
        $("#checkAll").click(function(){
            $('input:checkbox.volume').not(this).prop('checked', this.checked);
            showHideKinerja();
            calcuateNominal();
        });

        const calculateIncentive = (id) => {
            const kinerja = $("#kinerja_"+id).val();
            const incentive = $("#incentive_"+id).val();
            const total = parseInt(incentive)*parseInt(kinerja)/100;
            $("#incentive_"+id).val(total);
            calcuateNominal();
        }
        const showHideKinerja = () => {
            const volumes = document.getElementsByClassName("volume");
            const kinerja = document.getElementsByClassName("kinerja");
            for (let i = 0; i < volumes.length; i++) {
                const elvol = volumes[i];
                if (elvol.checked) {
                    kinerja[i].disabled = false;
                }else{
                    kinerja[i].disabled = true;
                }
            }
        }
        const calcuateNominal = () =>{
            const volumes = document.getElementsByClassName("volume");
            const incentives = document.getElementsByClassName("incentive");
            var total = 0;
            for (let i = 0; i < volumes.length; i++) {
                const elvol = volumes[i];
                if (elvol.checked) {
                    total += parseInt(incentives[i].value);
                }
            }
            document.getElementById("jumlah_bayar").value = total;
        }
    </script>
@endsection
