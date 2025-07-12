@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Admin Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.admin.store') }}" method="POST">
                        @csrf
                        @include('admin.admin._form')
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.admin.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
