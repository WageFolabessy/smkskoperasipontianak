<div class="form-group">
    <label for="nama">Nama Lengkap</label>
    <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $admin->nama ?? '') }}" required>
    @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $admin->email ?? '') }}" required>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<hr>
<p class="text-muted">
    {{ isset($admin) ? 'Kosongkan password jika tidak ingin mengubahnya.' : 'Password default untuk admin baru.' }}</p>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror" {{ isset($admin) ? '' : 'required' }}>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                {{ isset($admin) ? '' : 'required' }}>
        </div>
    </div>
</div>
