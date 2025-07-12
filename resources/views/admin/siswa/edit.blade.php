@extends('layouts.app')

@section('title', 'Ubah Siswa')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Siswa</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Ubah Data Siswa: {{ $siswa->user->nama }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.siswa.perbarui', $siswa->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.siswa._form')
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('admin.siswa.tampil') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
