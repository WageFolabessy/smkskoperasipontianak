@extends('layouts.app')

@section('title', 'Tambah Jurusan')

@section('content')
    <section class="section">

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Jurusan Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.jurusan.simpan') }}" method="POST">
                                @csrf
                                @include('admin.jurusan._form')
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('admin.jurusan.tampil') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
