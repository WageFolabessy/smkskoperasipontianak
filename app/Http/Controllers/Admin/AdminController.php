<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $semua_admin = User::where('role', 'admin')->orderBy('nama')->get();
        return view('admin.admin.index', compact('semua_admin'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(StoreAdminRequest $request)
    {
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.admin.index')->with('sukses', 'Admin baru berhasil ditambahkan!');
    }

    public function edit(User $admin)
    {
        return view('admin.admin.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, User $admin)
    {
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admin.index')->with('sukses', 'Data admin berhasil diperbarui!');
    }

    public function destroy(User $admin)
    {
        if ($admin->id === Auth::id()) {
            return back()->with('gagal', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $admin->delete();
        return back()->with('sukses', 'Data admin berhasil dihapus!');
    }
}
