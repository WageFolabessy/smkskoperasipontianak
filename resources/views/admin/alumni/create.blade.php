@extends('layouts.app')

@section('title', 'Tambah Alumni')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Data Alumni</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.alumni.simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.alumni._form')
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.alumni.tampil') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
