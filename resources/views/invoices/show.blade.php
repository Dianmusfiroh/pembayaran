@extends('layouts.app')
@section('card-title-before','Detail')
@section('card-header-extra')
<div class="float-right">
    <a href="{{ route('addPesertaInvoice',$invoice->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i> Tambah Guru</a>
</div>
@endsection
@section('card-body')
    <div class="form-group row">
        <div class="label col-md-2">No SPM</div>
        <div class="col-md-9">
            {{ $invoice->no_spm }}
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Periode Realisasi</div>
        <div class="col-md-9">
             @foreach ($invoice->invoicePeriod as $ip)
                    <small class="badge badge-primary">{{ \Carbon\Carbon::create()->day(1)->month($ip->period)->format('F') }}</small>
                @endforeach
        </div>
    </div>
    <div class="form-group row">
        <div class="label col-md-2">Tanggal Terbit</div>
        <div class="col-md-9">
            {{ $invoice->invoice_date }}
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover" id="tblGtt">
                    <thead>
                        <tr>
                            <th>NIK</th>
                        <th>NUPTK</th>
                        <th>Nama Lengkap</th>
                        <th>Jenjang</th>
                        <th>Unit Kerja</th>
                        <th>No. Rekening</th>
                        <th>Nama Rekening</th>
                        <th>Pendidikan Terakhir</th>
                        <th>Jabatan</th>
                        <th>Satuan Insentif</th>
                        <th>Kinerja</th>
                        {{-- <th>Volume</th> --}}
                        <th>Jumlah Diterima</th>
                        @if ($invoice->status->name != 'SP2D')
                            <th>Aksi</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                      @if (!empty($invoice->invoiceDetail))
                          @foreach ($invoice->invoiceDetail as $item)
                              <tr>
                                  <td>{{ $item->gtt->nik }}</td>
                                  <td>{{ $item->gtt->nuptk }}</td>
                                  <td>{{ $item->gtt->full_name }}</td>
                                  <td>{{ $item->gtt->institute->educational_stage->name }}</td>
                                  <td>{{ $item->gtt->institute->name }}</td>
                                  <td>{{ $item->gtt->account_number }}</td>
                                  {{-- <td>{{ $item->gtt->bankAccount ? $item->gtt->bankAccount->account_name : '' }}</td> --}}
                                  <td>{{ $item->gtt->account_name }}</td>
                                  {{-- <td>{{ $item->gtt->bankAccount ? $item->gtt->bankAccount->account_number : '' }}</td> --}}
                                  <td>{{ $item->gtt->qualification->name }}</td>
                                  <td>{{ $item->gtt->position->name }}</td>
                                  <td>{{ number_format($item->gtt->qualification->incentive) }}</td>
                                  <th>{{ number_format($item->incentive->sum('kinerja')) }}</th>
                                  {{-- <td>{{ $item->incentive->count('volume') }}</td> --}}
                                  <td>{{ number_format($item->jumlah_bayar) }}</td>
                                  @if ($invoice->status->name != 'SP2D')
                                      <td>
                                            <a href="javascript:;" data-toggle="modal" onclick="deleteData('{{$item->id}}')" data-target="#DeleteModal" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></a>
                                        </td>
                                  @endif
                              </tr>
                          @endforeach
                      @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('plugins.Datatables', true)
@section('js')
    <script>
        $("#tblGtt").DataTable({});
        var url = '';
        const deleteData = (id) =>{
            url = '{{route("destroyPesertaInvoice",":id")}}';
            url = url.replace(':id',id);
            $("#deleteForm").attr('action',url);
        }
        const formSubmit = () => {
            $("#deleteForm").submit();
        }
    </script>
@endsection
