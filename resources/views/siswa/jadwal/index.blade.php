@extends('layouts.app')

@section('title', 'Jadwal Pelajaran')

@section('content')
    <section class="section">

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Jadwal untuk Kelas: {{ Auth::user()->siswa->kelas->nama_kelas }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru Pengajar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jadwal_harian as $hari => $jadwal_per_hari)
                                    @foreach ($jadwal_per_hari as $index => $jadwal)
                                        <tr>
                                            @if ($index === 0)
                                                <td rowspan="{{ $jadwal_per_hari->count() }}"
                                                    class="align-middle font-weight-bold">{{ $hari }}</td>
                                            @endif
                                            <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                                            <td>{{ $jadwal->mataPelajaran->nama_mapel }}</td>
                                            <td>{{ $jadwal->guru->user->nama }}</td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Jadwal pelajaran belum tersedia untuk kelas
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
