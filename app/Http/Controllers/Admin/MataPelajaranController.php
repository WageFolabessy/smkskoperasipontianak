<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMataPelajaranRequest;
use App\Http\Requests\Admin\UpdateMataPelajaranRequest;
use App\Models\Jurusan;
use App\Models\MataPelajaran;

class MataPelajaranController extends Controller
{
    public function tampilData()
    {
        $semua_mapel = MataPelajaran::with('jurusan')->orderBy('nama_mapel', 'asc')->get();
        return view('admin.matapelajaran.index', compact('semua_mapel'));
    }

    public function tambahData()
    {
        $semua_jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();
        return view('admin.matapelajaran.create', compact('semua_jurusan'));
    }

    public function simpanData(StoreMataPelajaranRequest $request)
    {
        MataPelajaran::create($request->validated());
        return redirect()->route('admin.matapelajaran.tampil')->with('sukses', 'Data mata pelajaran berhasil ditambahkan!');
    }

    public function ubahData(MataPelajaran $mata_pelajaran)
    {
        $semua_jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();
        return view('admin.matapelajaran.edit', compact('mata_pelajaran', 'semua_jurusan'));
    }

    public function perbaruiData(UpdateMataPelajaranRequest $request, MataPelajaran $mata_pelajaran)
    {
        $mata_pelajaran->update($request->validated());
        return redirect()->route('admin.matapelajaran.tampil')->with('sukses', 'Data mata pelajaran berhasil diperbarui!');
    }

    public function hapusData(MataPelajaran $mata_pelajaran)
    {
        $mata_pelajaran->delete();
        return back()->with('sukses', 'Data mata pelajaran berhasil dihapus!');
    }
}
