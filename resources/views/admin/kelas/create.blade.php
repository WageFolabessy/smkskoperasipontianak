@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Kelas Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kelas.simpan') }}" method="POST">
                        @csrf
                        @include('admin.kelas._form')
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.kelas.tampil') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
