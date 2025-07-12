<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSiswaRequest;
use App\Http\Requests\Admin\UpdateSiswaRequest;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function tampilData()
    {
        $semua_siswa = Siswa::with(['user', 'kelas'])->orderBy('created_at', 'desc')->get();
        return view('admin.siswa.index', compact('semua_siswa'));
    }

    public function tambahData()
    {
        $semua_kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        return view('admin.siswa.create', compact('semua_kelas'));
    }

    public function simpanData(StoreSiswaRequest $request)
    {
        DB::beginTransaction();
        try {
            $path_foto = null;
            if ($request->hasFile('foto')) {
                $path_foto = $request->file('foto')->store('siswa', 'public');
            }

            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'siswa',
            ]);

            $user->siswa()->create([
                'nis' => $request->nis,
                'kelas_id' => $request->kelas_id,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'foto' => $path_foto,
            ]);

            DB::commit();
            return redirect()->route('admin.siswa.tampil')->with('sukses', 'Data siswa berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function ubahData(Siswa $siswa)
    {
        $semua_kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        return view('admin.siswa.edit', compact('siswa', 'semua_kelas'));
    }

    public function perbaruiData(UpdateSiswaRequest $request, Siswa $siswa)
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

            $siswa->user->update($data_user);

            $path_foto = $siswa->foto;
            if ($request->hasFile('foto')) {
                if ($path_foto) {
                    Storage::disk('public')->delete($path_foto);
                }
                $path_foto = $request->file('foto')->store('siswa', 'public');
            }

            $siswa->update([
                'nis' => $request->nis,
                'kelas_id' => $request->kelas_id,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'foto' => $path_foto,
            ]);

            DB::commit();
            return redirect()->route('admin.siswa.tampil')->with('sukses', 'Data siswa berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function hapusData(Siswa $siswa)
    {
        try {
            if ($siswa->foto) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $siswa->user->delete();
            return back()->with('sukses', 'Data siswa berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
