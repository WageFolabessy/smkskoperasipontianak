<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreMateriRequest;
use App\Http\Requests\Guru\UpdateMateriRequest;
use App\Models\JadwalPelajaran;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
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
        $semua_materi = Materi::where('guru_id', Auth::user()->guru->id)
            ->with(['kelas', 'mataPelajaran'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guru.materi.index', compact('semua_materi'));
    }

    public function tambahData()
    {
        $data = $this->getGuruData();
        return view('guru.materi.create', $data);
    }

    public function simpanData(StoreMateriRequest $request)
    {
        $path_file = $request->file('file')->store('materi', 'public');

        Materi::create([
            'guru_id' => Auth::user()->guru->id,
            'file' => $path_file,
        ] + $request->validated());

        return redirect()->route('guru.materi.tampil')->with('sukses', 'Materi berhasil ditambahkan!');
    }

    public function ubahData(Materi $materi)
    {
        if ($materi->guru_id !== Auth::user()->guru->id) {
            abort(403, 'AKSES DITOLAK');
        }

        $data = $this->getGuruData();
        $data['materi'] = $materi;

        return view('guru.materi.edit', $data);
    }

    public function perbaruiData(UpdateMateriRequest $request, Materi $materi)
    {
        if ($materi->guru_id !== Auth::user()->guru->id) {
            abort(403, 'AKSES DITOLAK');
        }

        $data_materi = $request->validated();

        if ($request->hasFile('file')) {
            if ($materi->file) {
                Storage::disk('public')->delete($materi->file);
            }
            $data_materi['file'] = $request->file('file')->store('materi', 'public');
        }

        $materi->update($data_materi);

        return redirect()->route('guru.materi.tampil')->with('sukses', 'Materi berhasil diperbarui!');
    }

    public function hapusData(Materi $materi)
    {
        if ($materi->guru_id !== Auth::user()->guru->id) {
            abort(403, 'AKSES DITOLAK');
        }

        if ($materi->file) {
            Storage::disk('public')->delete($materi->file);
        }
        $materi->delete();

        return back()->with('sukses', 'Materi berhasil dihapus!');
    }
}
