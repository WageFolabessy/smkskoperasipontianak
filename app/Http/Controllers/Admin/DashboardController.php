<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_jurusan = Jurusan::count();
        $jumlah_kelas = Kelas::count();
        $jumlah_mapel = MataPelajaran::count();
        $jumlah_guru = Guru::count();
        $jumlah_siswa = Siswa::count();

        return view('admin.dashboard', compact(
            'jumlah_jurusan',
            'jumlah_kelas',
            'jumlah_mapel',
            'jumlah_guru',
            'jumlah_siswa'
        ));
    }
}
