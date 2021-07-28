@extends('layouts.app')
@section('card-title-before','New')
@section('card-title','Form')
@section('button-save')
<button type="submit" class="btn btn-primary float-right ml-2" title="Save"><i class="fas fa-fw fa-save"></i>
    Simpan</button>
@endsection
@section('back-button',url('pengaturan/pengguna'))
@section('form-create')
<form action="{{ route($modul.'.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
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
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nice Name " required>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-3">Email</div>
                <div class="col-md-9">
                    <input type="email" name="email" id="email" class="form-control" placeholder="User Email " required>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-3">Password</div>
                <div class="col-md-9">
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="User password " required>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-3">Avatar</div>
                <div class="col-md-9">
                    <input type="file" name="avatar" id="avatar" placeholder="User avatar " required>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-3">Jenis Kelamin</div>
                <div class="col-md-9">
                    <select name="jk" id="jk" class="form-control">
                        <option selected>Jenis Kelamin</option>
                        <option value="0">Wanita</option>
                        <option value="1">Pria</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="label col-md-3">Role</div>
                <div class="col-md-9">
                    <select name="role" id="role" class="form-control">
                        <option value="">Pilih Role</option>
                        @if (!empty($roles))
                        @foreach ($roles as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
           <div class="form-group row">
                <div class="label col-md-3">institute</div>
                <div class="col-md-9">
                    <select name="institute" id="institute" class="form-control">
                      <option >Pilih institute</option>
                        @if (!empty($institute))
                        @foreach ($institute as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                        <option value="1">Aktif </option>
                        <option value="0">Tidak Aktif</option>
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
