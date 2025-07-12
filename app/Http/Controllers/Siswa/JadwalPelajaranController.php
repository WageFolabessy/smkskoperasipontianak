<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;
use Illuminate\Support\Facades\Auth;

class JadwalPelajaranController extends Controller
{
    public function index()
    {
        $kelasId = Auth::user()->siswa->kelas_id;

        $semua_jadwal = JadwalPelajaran::where('kelas_id', $kelasId)
            ->with(['mataPelajaran', 'guru.user'])
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('jam_mulai')
            ->get();

        $jadwal_harian = $semua_jadwal->groupBy('hari');

        return view('siswa.jadwal.index', compact('jadwal_harian'));
    }
}
