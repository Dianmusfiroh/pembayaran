@extends('layouts.app')
@section('card-header-extra')
<div class="card-tools">
    <ul class="nav nav-pills ml-auto">
        <li class="nav-item">
            <a class="nav-link active" href="#proses" data-toggle="tab">Baru</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#lulus" data-toggle="tab">Lulus</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tidak_lulus" data-toggle="tab">Tidak Lulus</a>
        </li>
    </ul>
</div>
@endsection
@section('card-body')
<div class="tab-content">
    <div class="tab-pane active" id="proses">
        <table class="table table-bordered table-striped table-sm " id="myTable">
            @include('pendaftaran.thead')
            <tbody>
                <?php $no=1; ?>
                @foreach ($list as $key => $item)
                @if ($item->status_id == 4)
                    @include('pendaftaran.tbody')
                    <?php $no++ ?>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="lulus">
        <table class="table table-bordered table-striped table-sm" id="myTable">
            @include('pendaftaran.thead')
            <tbody>
                <?php $no=1; ?>
                @foreach ($list as $key => $item)
                @if ($item->status_id == 5)
                @include('pendaftaran.tbody')
                <?php $no++ ?>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="tidak_lulus">
        <table class="table table-bordered table-striped table-sm" id="myTable">
            @include('pendaftaran.thead')
            <tbody>
                <?php $no=1; ?>
                @foreach ($list as $key => $item)
                @if ($item->status_id == 6)
                @include('pendaftaran.tbody')
                <?php $no++ ?>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('plugins.Datatables', true)
@section('js')
<script>
    $("table.table").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>
@include('layouts.script.delete')
@endsection