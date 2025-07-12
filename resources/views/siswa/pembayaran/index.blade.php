@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
    <section class="section">

        @if (session('sukses'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ session('sukses') }}
                </div>
            </div>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Unggah Bukti Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('siswa.pembayaran.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="bulan">Pembayaran Bulan</label>
                                    <select id="bulan" name="bulan"
                                        class="form-control @error('bulan') is-invalid @enderror" required>
                                        <option value="">-- Pilih Bulan --</option>
                                        @php
                                            $semua_bulan = [
                                                'Januari',
                                                'Februari',
                                                'Maret',
                                                'April',
                                                'Mei',
                                                'Juni',
                                                'Juli',
                                                'Agustus',
                                                'September',
                                                'Oktober',
                                                'November',
                                                'Desember',
                                            ];
                                        @endphp
                                        @foreach ($semua_bulan as $bulan)
                                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                                        @endforeach
                                    </select>
                                    @error('bulan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bukti_pembayaran">File Bukti Bayar</label>
                                    <input type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                                        class="form-control-file @error('bukti_pembayaran') is-invalid @enderror" required>
                                    @error('bukti_pembayaran')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maks: 2MB.</small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-upload"></i> Unggah
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Riwayat Pembayaran Anda</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Tgl Unggah</th>
                                            <th>Status</th>
                                            <th>Bukti</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($riwayat_pembayaran as $pembayaran)
                                            <tr>
                                                <td>{{ $pembayaran->bulan }}</td>
                                                <td>{{ $pembayaran->created_at->translatedFormat('d M Y') }}</td>
                                                <td>
                                                    @if ($pembayaran->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif ($pembayaran->status == 'diterima')
                                                        <span class="badge badge-success">Diterima</span>
                                                    @else
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ Storage::url($pembayaran->bukti_pembayaran) }}"
                                                        target="_blank">Lihat</a>
                                                </td>
                                                <td>{{ $pembayaran->catatan_admin ?? '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Belum ada riwayat pembayaran.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
