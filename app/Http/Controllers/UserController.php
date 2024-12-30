<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ImageHelpers;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role_id')->whereNotIn('id', [1])->paginate(8);

        if (!in_array(Auth::user()->role_id, [1, 2])) {
            abort(403);
        }

        $title = 'Hapus Data Pengguna !';
        $text = "Anda yakin ingin menghapus data ini ?";
        confirmDelete($title, $text);

        return view('dashboard.setting.users.index', [
            'page'  => 'Manajemen Pengguna',
            'users' => $users,
        ]);
    }

    public function create()
    {
        $roles  = Role::whereNotIn('id', [1])->get();

        if (!in_array(Auth::user()->role_id, [1, 2])) {
            abort(403);
        }

        return view('dashboard.setting.users.add', [
            'page'  => 'Tambah Pengguna',
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role_id, [1, 2])) {
            abort(403);
        }

        $validatedData = $request->validate([
            'role_id'   =>  'required',
            'name'      =>  'required',
            'username'  =>  'required|min:6|unique:users,username',
            'email'     =>  'required|email|unique:users,email',
            'password'  =>  'required|min:8',
            'phone'     =>  'nullable|numeric|unique:users,phone',
            'foto'      =>  'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $validatedData['password']      = Hash::make($validatedData['password']);

        if ($request->file('foto')) {
            $validatedData['foto'] = ImageHelpers::cropAvatar($request->file('foto'), 'users');
        }

        User::create($validatedData);

        Alert::success('Success', 'Pengguna Baru Berhasil Ditambahkan');
        return redirect()->route('users.index');
    }

    public function show(string $id)
    {
        //
    }

    public function profile(string $id)
    {
        $user = Auth::user()->$id;
        return view('dashboard.setting.users.profile', [
            'page'  => 'Profil Pengguna',
            'user'  => $user
        ]);
    }

    public function edit(string $id)
    {
        $roles  = Role::whereNotIn('id', [1])->get();
        $user   = User::findOrFail($id);
        return view('dashboard.setting.users.edit', [
            'page'  => 'Profil Pengguna',
            'user'  => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'role_id'   => 'required',
            'name'      => 'required|string|max:255',
            'password'  => 'nullable|min:6',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'phone'     => 'nullable|unique:users,phone,' . $user->id,
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($request->oldFoto) {
                Storage::delete($request->oldFoto);
            }
            $validatedData['foto'] = ImageHelpers::cropAvatar($request->file('foto'), 'users');
        }

        if ($request->email !== $user->email) {
            $request->validate([
                'email' => 'required|email|unique:users,email,',
            ]);
            $validatedData['email'] = $request->email;
        }

        if ($request->filled('password')) {
            if (!Hash::check($request->password, $user->password)) {
                $validatedData['password'] = Hash::make($request->password);
            }
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        Alert::success('Success', 'Akun Pengguna Berhasil Diperbaharui');
        return redirect()->route('users.index');
    }

    public function updateAccount(Request $request, User $user)
    {
        $rules = [
            'name'      => 'required|string|max:255',
            // 'password'  => 'required|min:6|confirmed',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($request->oldFoto) {
                Storage::delete($request->oldFoto);
            }
            $validatedData['foto'] = ImageHelpers::cropAvatar($request->file('foto'), 'users');
        }

        $validatedData['phone'] = $request->phone;

        User::where('id', Auth::user()->id)
            ->update($validatedData);

        Alert::success('Success', 'Akun anda berhasil diperbaharui');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::excludeId(1)->findOrFail($id);

        if (!in_array(Auth::user()->role_id, [1, 2])) {
            abort(403);
        }

        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        Alert::success('Success', 'Data pengguna berhasil dihapus');
        return redirect()->route('users.index');
    }
}
