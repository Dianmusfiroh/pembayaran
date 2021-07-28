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
                        <th>NIK</th>
                        <th>NUPTK</th>
                        <th>Nama Lengkap</th>
                        <th>Nama Sekolah</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      @if (!empty($invoice->invoiceDetail))
                          @foreach ($invoice->invoiceDetail as $item)
                              <tr>
                                  <td>{{ $item->gtt->nik }}</td>
                                  <td>{{ $item->gtt->nuptk }}</td>
                                  <td>{{ $item->gtt->full_name }}</td>
                                  <td>{{ $item->gtt->institute->name }}</td>
                                  <td>{{ $item->gtt->position->name }}</td>
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
    </script>
@endsection
