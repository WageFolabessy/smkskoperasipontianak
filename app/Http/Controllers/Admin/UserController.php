<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResetUserPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $semua_user = User::orderBy('role')->orderBy('nama')->get();
        return view('admin.user.index', compact('semua_user'));
    }

    public function showResetForm(User $user)
    {
        return view('admin.user.reset_password', compact('user'));
    }

    public function updatePassword(ResetUserPasswordRequest $request, User $user)
    {
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.user.index')->with('sukses', 'Password untuk pengguna ' . $user->nama . ' berhasil di-reset!');
    }
}
