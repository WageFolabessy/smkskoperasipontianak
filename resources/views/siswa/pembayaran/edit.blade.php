@extends('layouts.app')

@section('title', 'Ubah Tugas')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <form action="{{ route('guru.tugas.perbarui', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @include('guru.tugas._form')
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('guru.tugas.tampil') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
