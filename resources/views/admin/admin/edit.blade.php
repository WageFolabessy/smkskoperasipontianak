@extends('layouts.app')

@section('title', 'Ubah Admin')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Ubah Data Admin: {{ $admin->nama }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.admin.update', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.admin._form')
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('admin.admin.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
