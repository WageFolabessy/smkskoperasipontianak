@extends('layouts.app')

@section('title', 'Unggah Materi')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <form action="{{ route('guru.materi.simpan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @include('guru.materi._form')
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Unggah</button>
                        <a href="{{ route('guru.materi.tampil') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
