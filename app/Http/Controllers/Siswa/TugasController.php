<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\StoreJawabanRequest;
use App\Models\JawabanTugas;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;
        $kelasId = $siswa->kelas_id;

        $semua_tugas = Tugas::where('kelas_id', $kelasId)
            ->with(['mataPelajaran', 'jawabanTugas' => function ($query) use ($siswa) {
                $query->where('siswa_id', $siswa->id);
            }])
            ->orderBy('batas_waktu', 'asc')
            ->get();

        return view('siswa.tugas.index', compact('semua_tugas'));
    }

    public function unggahJawaban(Tugas $tugas)
    {
        $siswa = Auth::user()->siswa;

        if (now()->gt($tugas->batas_waktu)) {
            return redirect()->route('siswa.tugas.index')->with('gagal', 'Batas waktu untuk tugas ini telah berakhir.');
        }

        // Cek apakah sudah pernah mengumpulkan sebelum menampilkan form
        $jawabanTersimpan = JawabanTugas::where('tugas_id', $tugas->id)
            ->where('siswa_id', $siswa->id)
            ->first();

        if ($jawabanTersimpan) {
            return redirect()->route('siswa.tugas.index')->with('gagal', 'Anda sudah pernah mengumpulkan jawaban untuk tugas ini.');
        }

        return view('siswa.tugas.unggah_jawaban', compact('tugas'));
    }

    public function simpanJawaban(StoreJawabanRequest $request, Tugas $tugas)
    {
        $siswa = Auth::user()->siswa;

        if (now()->gt($tugas->batas_waktu)) {
            return back()->with('gagal', 'Batas waktu untuk tugas ini telah berakhir.');
        }

        $jawabanTersimpan = JawabanTugas::where('tugas_id', $tugas->id)
            ->where('siswa_id', $siswa->id)
            ->first();

        if ($jawabanTersimpan) {
            return back()->with('gagal', 'Anda sudah pernah mengumpulkan jawaban untuk tugas ini.');
        }

        $path_file = $request->file('file_jawaban')->store('jawaban', 'public');

        JawabanTugas::create([
            'tugas_id' => $tugas->id,
            'siswa_id' => $siswa->id,
            'file_jawaban' => $path_file,
            'catatan' => $request->catatan,
            'waktu_pengumpulan' => now(),
        ]);

        return redirect()->route('siswa.tugas.index')->with('sukses', 'Jawaban Anda berhasil dikumpulkan!');
    }
}
