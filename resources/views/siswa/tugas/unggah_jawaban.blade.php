@extends('layouts.app')

@section('title', 'Kumpulkan Jawaban')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kumpulkan Jawaban</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('siswa.tugas.index') }}">Daftar Tugas</a></div>
                <div class="breadcrumb-item">Unggah Jawaban</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Formulir Jawaban untuk: {{ $tugas->judul }}</h4>
                </div>
                <form action="{{ route('siswa.tugas.simpanJawaban', $tugas->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="file_jawaban">Unggah File Jawaban</label>
                            <input type="file" id="file_jawaban" name="file_jawaban"
                                class="form-control-file @error('file_jawaban') is-invalid @enderror" required>
                            @error('file_jawaban')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: PDF, DOC, DOCX, ZIP, RAR, JPG, PNG. Maks:
                                10MB.</small>
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan (Opsional)</label>
                            <textarea id="catatan" name="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Kumpulkan</button>
                        <a href="{{ route('siswa.tugas.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
