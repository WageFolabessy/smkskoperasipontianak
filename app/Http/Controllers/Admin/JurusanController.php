<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJurusanRequest;
use App\Http\Requests\Admin\UpdateJurusanRequest;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function tampilData()
    {
        $semua_jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();
        return view('admin.jurusan.index', compact('semua_jurusan'));
    }

    public function tambahData()
    {
        return view('admin.jurusan.create');
    }

    public function simpanData(StoreJurusanRequest $request)
    {
        Jurusan::create($request->validated());
        return redirect()->route('admin.jurusan.tampil')->with('sukses', 'Data jurusan berhasil ditambahkan!');
    }

    public function ubahData(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function perbaruiData(UpdateJurusanRequest $request, Jurusan $jurusan)
    {
        $jurusan->update($request->validated());
        return redirect()->route('admin.jurusan.tampil')->with('sukses', 'Data jurusan berhasil diperbarui!');
    }

    public function hapusData(Jurusan $jurusan)
    {
        $jurusan->delete();
        return back()->with('sukses', 'Data jurusan berhasil dihapus!');
    }
}
