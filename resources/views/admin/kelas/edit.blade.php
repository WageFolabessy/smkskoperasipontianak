@extends('layouts.app')

@section('title', 'Ubah Kelas')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Ubah Data Kelas: {{ $kelas->nama_kelas }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kelas.perbarui', $kelas->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.kelas._form')
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('admin.kelas.tampil') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
