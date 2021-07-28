@extends('layouts.app')
@section('card-header-extra')
<div class="float-right">
    <a href="{{ url('pendaftaran/penilaian/'.$kategori.'/'.$formation_category.'/create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-plus"></i>
        Tambah Data</a>
        <a href="{{ url('apps/export?q=hasil_penilaian_tahap_1&slug='.$formation_category.'&kat='.$kat_id) }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-download"></i>
        Download Lulus Tahap I</a>
</div>
@endsection
@section('card-body')

    <table class="table table-bordered table-striped table-sm text-center" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Jabatan</th>
                <th>Instansi</th>
                <th>Scroe Berkas</th>
                <th>Nilai Test</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($assesments as $key => $item)
        <tr>
            <td>{{ ($key+1) }}</td>
            <td>{{ $item->full_name }}</td>
            <td>{{ $item->jabatan }}</td>
            <td>{{ $item->instansi}}</td>
            <td>{{ $item->score }}</td>
            <td>{{ $item->nilai_test }}</td>
            <td>{{ $item->assessment_date }}</td>
            <td>{{ $item->status }}</td>
            <td>
                <button type="button" class="btn btn-default " data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="javascript:;" data-toggle="modal" onclick="updateStatus('{{$item->formation_id}}',{{$item->status_id}})"
                        data-target="#ubahStatusPeserta" class="btn btn-sm btn-primary">Ubah Status</a>
                    <a class="dropdown-item" href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id}})"
                    data-target="#DeleteModal">Hapus</a>
                    </div>
            </td>
        </tr>
        @endforeach
        </tbody>

    </table>
    <div id="ubahStatusPeserta" class="modal fade" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <form action="" id="updateStatusForm" method="post" id="frm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Ubah Status Peserta</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <input type="hidden" name="formation_id" value="" id="formation">
                            <div class="label col-md-3">Status</div>
                            <div class="col-md-9">
                                <select name="status_id" class="form-control mt-2" id="foramtion_status" required>
                                    @if ($statuses->count() > 0)
                                        <option value="">Pilih Status</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>  
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="label col-md-3">Nilai Test</div>
                            <div class="col-md-9">
                                <input type="number" name="nilai_test" id="nilai_test" class="form-control" min="0" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="" class="btn btn-primary" data-dismiss="modal"
                            onclick="formSubmitStatus()">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('plugins.Datatables', true)
 @section('plugins.Select2', true)
@section('js')
<script>
    $("#myTable").DataTable({
        autoWidth: false,
        responsive: true,
    });
    var url = '';
    const updateStatus = (id,status) =>{
        url = '{{route("peserta.update",":id")}}';
        url = url.replace(':id',id);
        $("#formation").val(id);
        $("#updateStatusForm").attr('action',url);
        $("#foramtion_status").val(status);
    }
    const formSubmitStatus = () => {
        $("#updateStatusForm").submit();
    }
    $('.filter-modal select').css('width', '100%');
    $('select').select2();
</script>
@include('layouts.script.delete')
@endsection
