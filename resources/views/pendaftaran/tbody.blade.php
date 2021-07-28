 <tr>
    <td class="text-center">{{ ($no) }}</td>
    <td>{{ $item->nik }}</a></td>
    <td>{{ $item->full_name }}</td>
    <td>{{ $item->instansi }}</td>
    <td>{{ $item->jabatan }}</td>
    <td>
       
            <button type="button" class="btn btn-default " data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="{{ url('apps/biodata/'.$item->candidate->candidateProfile->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                    <a class="dropdown-item" href="{{ url('apps/biodata/'.$item->candidate->candidateProfile->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    <a class="dropdown-item" href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id}})"
                    data-target="#DeleteModal">Hapus</a>
                    </div>
    </td>