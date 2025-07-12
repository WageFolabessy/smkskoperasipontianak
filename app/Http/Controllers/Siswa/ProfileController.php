<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $siswa = Auth::user()->siswa()->with(['user', 'kelas'])->first();
        return view('siswa.profil.edit', compact('siswa'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $siswa = $user->siswa;

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

            $path_foto = $siswa->foto;
            if ($request->hasFile('foto')) {
                if ($path_foto) {
                    Storage::disk('public')->delete($path_foto);
                }
                $path_foto = $request->file('foto')->store('siswa', 'public');
            }

            $siswa->update([
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
