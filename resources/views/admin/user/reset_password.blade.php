@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <section class="section">

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Reset Password untuk: {{ $user->nama }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.user.updatePassword', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" required>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Password Baru</button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
