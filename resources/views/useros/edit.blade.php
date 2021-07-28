@extends('layouts.app')
@section('card-title-before','Update')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save" ><i class="fas fa-fw fa-save"></i> Simpan</button>
@endsection
@section('back-button',url('pengaturan/pengguna'))
@section('form-create')
    <form action="{{ route('pengguna.update',$edit->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
@endsection
@section('card-body')
@if($errors->any())
    <div class="alert alert-danger">
        <p><strong>Opps Something went wrong</strong></p>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col">
            <div class="form-group row">
                <div class="label col-md-3">Name</div>
                <div class="col-md-9">
                    <input type="text" name="name" id="name" value="{{ $edit->name }}" class="form-control" placeholder="Nice Name " required>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-3">Email</div>
                <div class="col-md-9">
                    <input type="email" name="email" id="email" value="{{ $edit->email }}" class="form-control" placeholder="User Email " required>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-3">Change Password</div>
                <div class="col-md-9">
                    <input type="password" name="change_password" id="change_password" class="form-control" placeholder="User password ">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-3">Avatar</div>
                <div class="col-md-9">
                    <img src="{{ asset($edit->avatar) }}" alt="user_profile" width="100px;">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-3">Avatar</div>
                <div class="col-md-9">
                    <input type="file" name="avatar" id="avatar" placeholder="User avatar ">
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-3">Role</div>
                <div class="col-md-9">
                    <select name="role" id="role" class="form-control">
                        <option value="">Pilih Role</option>
                        @if (!empty($roles))
                            @foreach ($roles as $item)
                                @if ($item->id == $edit->role_id)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-3">Status</div>
                <div class="col-md-9">
                    <select name="status" id="status" class="form-control">
                        <option value="">Pilih Status</option>
                        <option value="1" {{ $edit->status == 1 ? 'selected' : '' }}>Aktif </option>
                        <option value="0" {{ $edit->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const addRow = () =>{
            console.log('addRow');
            var markup = `
            <tr>
                <td>
                    <div class="row mb-2">
                        <div class="col">Name<input type="text" name="name[]" id="name" required class="form-control" placeholder="ex. Data signal"></div>
                        <div class="col">Time Video<input type="text" name="time_video[]" id="time_video" required class="form-control" placeholder="0:99"></div>
                    </div>     
                </td>
                <td><button type="button" class="btn btn-sm removeRow">X</button></td>
            </tr>
            `;
            $(".table-users tbody").append(markup);
        }
        $(".table-users").on("click", ".removeRow", function() {
            $(this).closest("tr").remove();
        });
    </script>
@endsection