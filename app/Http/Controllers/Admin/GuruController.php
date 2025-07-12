<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGuruRequest;
use App\Http\Requests\Admin\UpdateGuruRequest;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function tampilData()
    {
        $semua_guru = Guru::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.guru.index', compact('semua_guru'));
    }

    public function tambahData()
    {
        return view('admin.guru.create');
    }

    public function simpanData(StoreGuruRequest $request)
    {
        DB::beginTransaction();
        try {
            $path_foto = null;
            if ($request->hasFile('foto')) {
                $path_foto = $request->file('foto')->store('guru', 'public');
            }

            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'guru',
            ]);

            $user->guru()->create([
                'nip' => $request->nip,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'foto' => $path_foto,
            ]);

            DB::commit();
            return redirect()->route('admin.guru.tampil')->with('sukses', 'Data guru berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function ubahData(Guru $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function perbaruiData(UpdateGuruRequest $request, Guru $guru)
    {
        DB::beginTransaction();
        try {
            $data_user = [
                'nama' => $request->nama,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $data_user['password'] = Hash::make($request->password);
            }

            $guru->user->update($data_user);

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
            return redirect()->route('admin.guru.tampil')->with('sukses', 'Data guru berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function hapusData(Guru $guru)
    {
        try {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $guru->user->delete();
            return back()->with('sukses', 'Data guru berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
