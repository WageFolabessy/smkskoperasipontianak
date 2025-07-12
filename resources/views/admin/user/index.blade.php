@extends('layouts.app')

@section('title', 'Manajemen User')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-user').DataTable();
        });
    </script>
@endpush

@section('content')
    <section class="section">

        @if (session('sukses'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ session('sukses') }}
                </div>
            </div>
        @endif

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Semua Pengguna</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-user">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semua_user as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span
                                                class="badge 
                                        @if ($user->role == 'admin') badge-primary 
                                        @elseif($user->role == 'guru') badge-success 
                                        @else badge-info @endif">
                                                {{ Str::title($user->role) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.user.showResetForm', $user->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-key"></i> Reset Password
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
