<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $siswaId = Auth::user()->siswa->id;

        $semua_nilai = JawabanTugas::where('siswa_id', $siswaId)
            ->whereNotNull('nilai')
            ->with(['tugas.mataPelajaran', 'tugas.guru.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.nilai.index', compact('semua_nilai'));
    }
}
