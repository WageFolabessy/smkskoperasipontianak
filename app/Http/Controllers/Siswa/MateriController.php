<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function index()
    {
        $kelasIdSiswa = Auth::user()->siswa->kelas_id;

        $semua_materi = Materi::where('kelas_id', $kelasIdSiswa)
            ->with(['mataPelajaran', 'guru.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.materi.index', compact('semua_materi'));
    }
}
