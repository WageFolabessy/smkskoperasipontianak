@extends('layouts.app')

@section('title', 'Tambah Mata Pelajaran')

@section('content')
    <section class="section">

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Mata Pelajaran Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.matapelajaran.simpan') }}" method="POST">
                                @csrf
                                @include('admin.matapelajaran._form')
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('admin.matapelajaran.tampil') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
