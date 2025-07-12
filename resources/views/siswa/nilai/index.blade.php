@extends('layouts.app')

@section('title', 'Daftar Nilai')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-nilai-siswa').DataTable({
                "ordering": false
            });
        });
    </script>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Nilai</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Rekapitulasi Nilai Tugas Anda</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-nilai-siswa">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Tugas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($semua_nilai as $nilai)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nilai->tugas->judul }}</td>
                                        <td>{{ $nilai->tugas->mataPelajaran->nama_mapel }}</td>
                                        <td>{{ $nilai->tugas->guru->user->nama }}</td>
                                        <td>
                                            <span class="badge badge-primary"
                                                style="font-size: 1.1rem;">{{ $nilai->nilai }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada nilai yang tersedia.</td>
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
