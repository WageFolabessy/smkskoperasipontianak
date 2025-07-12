<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;
use App\Models\Tugas;
use App\Models\JawabanTugas;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;
        $kelasId = $siswa->kelas_id;

        $jumlah_mapel = JadwalPelajaran::where('kelas_id', $kelasId)->distinct()->count('mata_pelajaran_id');
        $jumlah_tugas = Tugas::where('kelas_id', $kelasId)->count();
        $tugas_dikerjakan = JawabanTugas::where('siswa_id', $siswa->id)->count();

        return view('siswa.dashboard', compact(
            'siswa',
            'jumlah_mapel',
            'jumlah_tugas',
            'tugas_dikerjakan'
        ));
    }
}
