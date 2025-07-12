@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-hero">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="far fa-user-circle"></i>
                        </div>
                        <h4>{{ Auth::user()->nama }}</h4>
                        <div class="card-description">NIS: {{ $siswa->nis }} | Kelas: {{ $siswa->kelas->nama_kelas }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Mata Pelajaran</h4>
                        </div>
                        <div class="card-body">
                            {{ $jumlah_mapel }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Tugas</h4>
                        </div>
                        <div class="card-body">
                            {{ $jumlah_tugas }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tugas Dikerjakan</h4>
                        </div>
                        <div class="card-body">
                            {{ $tugas_dikerjakan }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
