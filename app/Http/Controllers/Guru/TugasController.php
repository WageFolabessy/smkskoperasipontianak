<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreTugasRequest;
use App\Http\Requests\Guru\UpdateTugasRequest;
use App\Models\JadwalPelajaran;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Guru\StoreNilaiRequest;
use App\Models\JawabanTugas;

class TugasController extends Controller
{
    private function getGuruData()
    {
        $guruId = Auth::user()->guru->id;
        $jadwal = JadwalPelajaran::where('guru_id', $guruId)->with(['kelas', 'mataPelajaran'])->get();

        $semua_kelas = $jadwal->pluck('kelas')->unique('id');
        $semua_mapel = $jadwal->pluck('mataPelajaran')->unique('id');

        return compact('semua_kelas', 'semua_mapel');
    }

    public function tampilData()
    {
        $semua_tugas = Tugas::where('guru_id', Auth::user()->guru->id)
            ->with(['kelas', 'mataPelajaran'])
            ->withCount('jawabanTugas')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guru.tugas.index', compact('semua_tugas'));
    }

    public function tambahData()
    {
        $data = $this->getGuruData();
        return view('guru.tugas.create', $data);
    }

    public function simpanData(StoreTugasRequest $request)
    {
        $path_file = $request->file('file_soal')->store('tugas', 'public');

        Tugas::create([
            'guru_id' => Auth::user()->guru->id,
            'file_soal' => $path_file,
        ] + $request->validated());

        return redirect()->route('guru.tugas.tampil')->with('sukses', 'Tugas berhasil dibuat!');
    }

    public function ubahData(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::user()->guru->id) {
            abort(403, 'AKSES DITOLAK');
        }

        $data = $this->getGuruData();
        $data['tugas'] = $tugas;

        return view('guru.tugas.edit', $data);
    }

    public function perbaruiData(UpdateTugasRequest $request, Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::user()->guru->id) {
            abort(403, 'AKSES DITOLAK');
        }

        $data_tugas = $request->validated();

        if ($request->hasFile('file_soal')) {
            if ($tugas->file_soal) {
                Storage::disk('public')->delete($tugas->file_soal);
            }
            $data_tugas['file_soal'] = $request->file('file_soal')->store('tugas', 'public');
        }

        $tugas->update($data_tugas);

        return redirect()->route('guru.tugas.tampil')->with('sukses', 'Tugas berhasil diperbarui!');
    }

    public function hapusData(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::user()->guru->id) {
            abort(403, 'AKSES DITOLAK');
        }

        if ($tugas->file_soal) {
            Storage::disk('public')->delete($tugas->file_soal);
        }
        $tugas->delete();

        return back()->with('sukses', 'Tugas berhasil dihapus!');
    }

    public function lihatJawaban(Tugas $tugas)
    {
        if ($tugas->guru_id !== Auth::user()->guru->id) {
            abort(403, 'AKSES DITOLAK');
        }

        $tugas->load(['jawabanTugas.siswa.user']);

        return view('guru.tugas.jawaban', compact('tugas'));
    }

    public function simpanNilai(StoreNilaiRequest $request, JawabanTugas $jawaban_tugas)
    {
        if ($jawaban_tugas->tugas->guru_id !== Auth::user()->guru->id) {
            abort(403, 'AKSES DITOLAK');
        }

        $jawaban_tugas->update($request->validated());

        return back()->with('sukses', 'Nilai berhasil disimpan!');
    }
}
