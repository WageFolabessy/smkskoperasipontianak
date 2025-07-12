<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function tampilData()
    {
        $semua_alumni = Alumni::with('jurusan')->orderBy('tahun_lulus', 'desc')->orderBy('nama_lengkap', 'asc')->get();
        return view('admin.alumni.index', compact('semua_alumni'));
    }

    public function tambahData()
    {
        $semua_jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();
        return view('admin.alumni.create', compact('semua_jurusan'));
    }

    public function simpanData(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:alumni,nis',
            'jurusan_id' => 'required|exists:jurusan,id',
            'tahun_lulus' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $path_foto = null;
            if ($request->hasFile('foto')) {
                $path_foto = $request->file('foto')->store('alumni', 'public');
            }

            Alumni::create([
                'nama_lengkap' => $request->nama_lengkap,
                'nis' => $request->nis,
                'jurusan_id' => $request->jurusan_id,
                'tahun_lulus' => $request->tahun_lulus,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'foto' => $path_foto,
            ]);

            DB::commit();
            return redirect()->route('admin.alumni.tampil')->with('sukses', 'Data alumni berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function ubahData(Alumni $alumni)
    {
        $semua_jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();
        return view('admin.alumni.edit', compact('alumni', 'semua_jurusan'));
    }

    public function perbaruiData(Request $request, Alumni $alumni)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:alumni,nis,' . $alumni->id,
            'jurusan_id' => 'required|exists:jurusan,id',
            'tahun_lulus' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $path_foto = $alumni->foto;
            if ($request->hasFile('foto')) {
                if ($path_foto) {
                    Storage::disk('public')->delete($path_foto);
                }
                $path_foto = $request->file('foto')->store('alumni', 'public');
            }

            $alumni->update([
                'nama_lengkap' => $request->nama_lengkap,
                'nis' => $request->nis,
                'jurusan_id' => $request->jurusan_id,
                'tahun_lulus' => $request->tahun_lulus,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'foto' => $path_foto,
            ]);

            DB::commit();
            return redirect()->route('admin.alumni.tampil')->with('sukses', 'Data alumni berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function hapusData(Alumni $alumni)
    {
        try {
            if ($alumni->foto) {
                Storage::disk('public')->delete($alumni->foto);
            }
            $alumni->delete();
            return back()->with('sukses', 'Data alumni berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
