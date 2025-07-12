<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePembayaranRequest;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $semua_pembayaran = Pembayaran::with(['siswa.user', 'siswa.kelas'])
            ->orderByRaw("FIELD(status, 'pending', 'diterima', 'ditolak')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pembayaran.index', compact('semua_pembayaran'));
    }

    public function update(UpdatePembayaranRequest $request, Pembayaran $pembayaran)
    {
        $pembayaran->update($request->validated());

        return back()->with('sukses', 'Status pembayaran berhasil diperbarui.');
    }
}
