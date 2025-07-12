<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\StorePembayaranRequest;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $siswaId = Auth::user()->siswa->id;
        $riwayat_pembayaran = Pembayaran::where('siswa_id', $siswaId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.pembayaran.index', compact('riwayat_pembayaran'));
    }

    public function store(StorePembayaranRequest $request)
    {
        $path_bukti = $request->file('bukti_pembayaran')->store('pembayaran', 'public');

        Pembayaran::create([
            'siswa_id' => Auth::user()->siswa->id,
            'bulan' => $request->bulan,
            'bukti_pembayaran' => $path_bukti,
        ]);

        return back()->with('sukses', 'Bukti pembayaran berhasil diunggah dan sedang menunggu verifikasi.');
    }
}
