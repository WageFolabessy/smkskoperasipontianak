@extends('layouts.app')

@section('title', 'Pengelolaan Pembayaran')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-pembayaran').DataTable({
                "order": []
            });
        });
    </script>
@endpush

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
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Pembayaran Masuk</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-pembayaran">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Bulan</th>
                                    <th>Tgl Unggah</th>
                                    <th>Bukti</th>
                                    <th style="width: 25%;">Status & Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semua_pembayaran as $pembayaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pembayaran->siswa->user->nama }}</td>
                                        <td>{{ $pembayaran->siswa->kelas->nama_kelas }}</td>
                                        <td>{{ $pembayaran->bulan }}</td>
                                        <td>{{ $pembayaran->created_at->translatedFormat('d M Y, H:i') }}</td>
                                        <td>
                                            <a href="{{ Storage::url($pembayaran->bukti_pembayaran) }}" target="_blank"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Lihat</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group">
                                                    <select name="status" class="form-control form-control-sm">
                                                        <option value="pending"
                                                            {{ $pembayaran->status == 'pending' ? 'selected' : '' }}>Pending
                                                        </option>
                                                        <option value="diterima"
                                                            {{ $pembayaran->status == 'diterima' ? 'selected' : '' }}>
                                                            Diterima</option>
                                                        <option value="ditolak"
                                                            {{ $pembayaran->status == 'ditolak' ? 'selected' : '' }}>
                                                            Ditolak</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary btn-sm" type="submit"><i
                                                                class="fas fa-save"></i></button>
                                                    </div>
                                                </div>
                                                <textarea name="catatan_admin" class="form-control form-control-sm mt-2" placeholder="Catatan (opsional)">{{ old('catatan_admin', $pembayaran->catatan_admin) }}</textarea>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
