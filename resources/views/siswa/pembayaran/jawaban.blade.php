@extends('layouts.app')

@section('title', 'Jawaban Tugas')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Jawaban Tugas: {{ $tugas->judul }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('guru.tugas.tampil') }}">Manajemen Tugas</a></div>
                <div class="breadcrumb-item">Daftar Jawaban</div>
            </div>
        </div>

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
                    <h4>Daftar Siswa yang Mengumpulkan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-jawaban">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Waktu Kumpul</th>
                                    <th>Jawaban</th>
                                    <th style="width: 25%;">Beri Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tugas->jawabanTugas as $jawaban)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jawaban->siswa->user->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($jawaban->waktu_pengumpulan)->translatedFormat('d M Y, H:i') }}
                                        </td>
                                        <td>
                                            <a href="{{ Storage::url($jawaban->file_jawaban) }}" target="_blank"
                                                class="btn btn-info btn-sm"><i class="fas fa-download"></i> Unduh</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('guru.tugas.simpanNilai', $jawaban->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="number" name="nilai" class="form-control"
                                                        placeholder="0-100" value="{{ old('nilai', $jawaban->nilai) }}"
                                                        required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                                    </div>
                                                </div>
                                                @error('nilai')
                                                    <div class="text-danger mt-1" style="font-size: 80%;">{{ $message }}
                                                    </div>
                                                @enderror
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada siswa yang mengumpulkan jawaban.
                                        </td>
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
