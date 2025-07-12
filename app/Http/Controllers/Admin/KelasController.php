<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKelasRequest;
use App\Http\Requests\Admin\UpdateKelasRequest;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function tampilData()
    {
        $semua_kelas = Kelas::with(['jurusan', 'waliKelas.user'])->orderBy('nama_kelas', 'asc')->get();
        return view('admin.kelas.index', compact('semua_kelas'));
    }

    public function tambahData()
    {
        $semua_jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();
        $semua_guru = Guru::with('user')->get()->sortBy('user.nama');
        return view('admin.kelas.create', compact('semua_jurusan', 'semua_guru'));
    }

    public function simpanData(StoreKelasRequest $request)
    {
        Kelas::create($request->validated());
        return redirect()->route('admin.kelas.tampil')->with('sukses', 'Data kelas berhasil ditambahkan!');
    }

    public function ubahData(Kelas $kelas)
    {
        $semua_jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();
        $semua_guru = Guru::with('user')->get()->sortBy('user.nama');
        return view('admin.kelas.edit', compact('kelas', 'semua_jurusan', 'semua_guru'));
    }

    public function perbaruiData(UpdateKelasRequest $request, Kelas $kelas)
    {
        $kelas->update($request->validated());
        return redirect()->route('admin.kelas.tampil')->with('sukses', 'Data kelas berhasil diperbarui!');
    }

    public function hapusData(Kelas $kelas)
    {
        $kelas->delete();
        return back()->with('sukses', 'Data kelas berhasil dihapus!');
    }
}
