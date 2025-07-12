<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $guru = Auth::user()->guru;

        return view('guru.profil.edit', compact('guru'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $guru = $user->guru;

        DB::beginTransaction();
        try {
            $data_user = [
                'nama' => $request->nama,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $data_user['password'] = Hash::make($request->password);
            }
            $user->update($data_user);

            $path_foto = $guru->foto;
            if ($request->hasFile('foto')) {
                if ($path_foto) {
                    Storage::disk('public')->delete($path_foto);
                }
                $path_foto = $request->file('foto')->store('guru', 'public');
            }

            $guru->update([
                'nip' => $request->nip,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'foto' => $path_foto,
            ]);

            DB::commit();
            return back()->with('sukses', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
