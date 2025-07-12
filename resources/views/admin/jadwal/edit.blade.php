@extends('layouts.app')

@section('title', 'Ubah Jadwal')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Ubah Jadwal</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.jadwal.perbarui', $jadwal_pelajaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.jadwal._form')
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('admin.jadwal.tampil') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
