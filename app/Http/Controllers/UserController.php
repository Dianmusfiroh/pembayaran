<?php

namespace App\Http\Controllers;

use App\Entities\Institute;
use App\Entities\Role;
use App\Repositories\CandidateProfileRepository;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $modul;
    protected $profileRepository;
    public function __construct(
        CandidateProfileRepository $candidateProfileRepository
    ) {
        $this->middleware('auth');
        $this->modul = 'pengguna';
        $this->profileRepository = $candidateProfileRepository;
    }
    public function index()
    {

        $list = User::all();
        $institute = Institute::all();

        $modul = $this->modul;
        return view('user.index', compact('modul', 'list','institute'));
    }

    public function create()
    {

        $roles = Role::all();
        $institute = Institute::all();
        $modul = $this->modul;

        return view('user.create', compact('modul', 'roles','institute'));
    }

    public function store(Request $request)
    {
        $name = '';
        if ($request->has('avatar')) {
            $upload = $request->file('avatar');
            $name = $upload->getClientOriginalName() . '_' . rand(100, 9999);
            $upload->move(public_path() . '/uploads/', $name);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->avatar = '/uploads/' . $name;
        $user->role_id = $request->role;
        $user->institute_id = $request->institute;
        $user->status = $request->status;
        $user->save();
        $this->profileRepository->create([
            'full_name' => $user->name,
            'user_id' => $user->id,
            'jenis_kelamin' => $request->jk
        ]);
        return redirect()->back();
    }

    public function edit($id)
    {
        $edit = User::findOrFail($id);
        $roles = Role::all();
        $modul = 'users';
        return view('user.edit', compact('modul', 'edit', 'roles'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            if ($request->has('avatar')) {
                $upload = $request->file('avatar');
                $name = $upload->getClientOriginalName() . '_' . rand(100, 9999);
                $upload->move(public_path() . '/uploads/', $name);
                $user->avatar = '/uploads/' . $name;
            }
            $user->status = $request->status;
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->change_password != '') {
                $user->password = bcrypt($request->change_password);
            }
            $user->role_id = $request->role;
            $user->update();
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Terjadi Kesalahan']);
        }
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }
}
