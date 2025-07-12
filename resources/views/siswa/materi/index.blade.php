@extends('layouts.app')

@section('title', 'Daftar Materi')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-materi-siswa').DataTable();
        });
    </script>
@endpush

@section('content')
    <section class="section">

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Materi untuk Kelas Anda</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-materi-siswa">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Materi</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru</th>
                                    <th>Tgl Unggah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($semua_materi as $materi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $materi->judul }}</td>
                                        <td>{{ $materi->mataPelajaran->nama_mapel }}</td>
                                        <td>{{ $materi->guru->user->nama }}</td>
                                        <td>{{ $materi->created_at->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <a href="{{ Storage::url($materi->file) }}" target="_blank"
                                                class="btn btn-primary btn-sm" data-toggle="tooltip" title="Unduh Materi">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada materi yang tersedia untuk kelas
                                            Anda.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
