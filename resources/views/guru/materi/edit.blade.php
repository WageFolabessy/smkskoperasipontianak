@extends('layouts.app')

@section('title', 'Ubah Materi')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <form action="{{ route('guru.materi.perbarui', $materi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @include('guru.materi._form')
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('guru.materi.tampil') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
