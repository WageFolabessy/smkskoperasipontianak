<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJadwalPelajaranRequest;
use App\Http\Requests\Admin\UpdateJadwalPelajaranRequest;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class JadwalPelajaranController extends Controller
{
    public function tampilData()
    {
        $semua_jadwal = JadwalPelajaran::with(['kelas', 'mataPelajaran', 'guru.user'])
            ->orderBy('kelas_id')
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('jam_mulai')
            ->get();

        $jadwal_per_kelas = $semua_jadwal->groupBy('kelas.nama_kelas');

        return view('admin.jadwal.index', compact('jadwal_per_kelas'));
    }

    public function tambahData()
    {
        $semua_kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $semua_mapel = MataPelajaran::orderBy('nama_mapel', 'asc')->get();
        $semua_guru = Guru::with('user')->get()->sortBy('user.nama');

        return view('admin.jadwal.create', compact('semua_kelas', 'semua_mapel', 'semua_guru'));
    }

    public function simpanData(StoreJadwalPelajaranRequest $request)
    {
        JadwalPelajaran::create($request->validated());
        return redirect()->route('admin.jadwal.tampil')->with('sukses', 'Jadwal pelajaran berhasil ditambahkan!');
    }

    public function ubahData(JadwalPelajaran $jadwal_pelajaran)
    {
        $semua_kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $semua_mapel = MataPelajaran::orderBy('nama_mapel', 'asc')->get();
        $semua_guru = Guru::with('user')->get()->sortBy('user.nama');

        return view('admin.jadwal.edit', compact('jadwal_pelajaran', 'semua_kelas', 'semua_mapel', 'semua_guru'));
    }

    public function perbaruiData(UpdateJadwalPelajaranRequest $request, JadwalPelajaran $jadwal_pelajaran)
    {
        $jadwal_pelajaran->update($request->validated());
        return redirect()->route('admin.jadwal.tampil')->with('sukses', 'Jadwal pelajaran berhasil diperbarui!');
    }

    public function hapusData(JadwalPelajaran $jadwal_pelajaran)
    {
        $jadwal_pelajaran->delete();
        return back()->with('sukses', 'Jadwal pelajaran berhasil dihapus!');
    }
}
