<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;
use App\Models\Materi;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guruId = Auth::user()->guru->id;

        $jumlah_kelas_ajar = JadwalPelajaran::where('guru_id', $guruId)->distinct()->count('kelas_id');
        $jumlah_materi = Materi::where('guru_id', $guruId)->count();
        $jumlah_tugas = Tugas::where('guru_id', $guruId)->count();

        return view('guru.dashboard', compact(
            'jumlah_kelas_ajar',
            'jumlah_materi',
            'jumlah_tugas'
        ));
    }
}
