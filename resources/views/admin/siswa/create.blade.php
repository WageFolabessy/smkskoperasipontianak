@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Siswa</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Siswa Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.siswa.simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.siswa._form')
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.siswa.tampil') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
