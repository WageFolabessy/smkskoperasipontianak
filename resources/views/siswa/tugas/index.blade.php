@extends('layouts.app')

@section('title', 'Daftar Tugas')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-tugas-siswa').DataTable({
                "ordering": false
            });
        });
    </script>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Tugas</h1>
        </div>

        @if (session('sukses'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body"><button class="close"
                        data-dismiss="alert"><span>&times;</span></button>{{ session('sukses') }}</div>
            </div>
        @elseif (session('gagal'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body"><button class="close"
                        data-dismiss="alert"><span>&times;</span></button>{{ session('gagal') }}</div>
            </div>
        @endif

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Tugas untuk Kelas Anda</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-tugas-siswa">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Tugas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Batas Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($semua_tugas as $tugas)
                                    @php
                                        $jawabanSiswa = $tugas->jawabanTugas->first();
                                        $deadlineTerlewat = now()->gt($tugas->batas_waktu);
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tugas->judul }}</td>
                                        <td>{{ $tugas->mataPelajaran->nama_mapel }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $deadlineTerlewat && !$jawabanSiswa ? 'badge-danger' : 'badge-light' }}">
                                                {{ \Carbon\Carbon::parse($tugas->batas_waktu)->translatedFormat('d F Y, H:i') }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($jawabanSiswa)
                                                <span class="badge badge-success">Sudah Dikerjakan</span>
                                            @elseif ($deadlineTerlewat)
                                                <span class="badge badge-danger">Terlewat</span>
                                            @else
                                                <span class="badge badge-warning">Belum Dikerjakan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ Storage::url($tugas->file_soal) }}" target="_blank"
                                                class="btn btn-info btn-sm" data-toggle="tooltip" title="Unduh Soal"><i
                                                    class="fas fa-download"></i></a>

                                            @if ($jawabanSiswa)
                                                <a href="{{ Storage::url($jawabanSiswa->file_jawaban) }}" target="_blank"
                                                    class="btn btn-light btn-sm" data-toggle="tooltip"
                                                    title="Lihat Jawaban Anda"><i class="fas fa-eye"></i></a>
                                            @elseif(!$deadlineTerlewat)
                                                <a href="{{ route('siswa.tugas.unggahJawaban', $tugas->id) }}"
                                                    class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                    title="Kumpulkan Jawaban">
                                                    <i class="fas fa-upload"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada tugas yang tersedia untuk kelas
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
