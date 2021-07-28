<tr>
        <td>{{ ($key+1) }}</td>
        <td>{{ $item->formation->candidate ? $item->formation->candidate->name : '' }}</td>
        <td>{{ $item->formation->formation_needs->position->name }}</td>
        <td>{{ $item->formation->formation_needs->institute->name}}</td>
        <td>{{ $item->score }}</td>
        <td>{{ $item->assessment_date }}</td>
        {{-- <td>{{ $item->formation->status->name }}</td> --}}
        <td>
                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id}})"
                data-target="#DeleteModal" class="dropdown-item"><i class="fas fa-fw fa-trash"></i>
                Hapus</a>
        </td>