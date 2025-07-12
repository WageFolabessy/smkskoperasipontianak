<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', $guru->user->nama ?? '') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" id="nip" name="nip" class="form-control @error('nip') is-invalid @enderror"
                value="{{ old('nip', $guru->nip ?? '') }}" required>
            @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $guru->user->email ?? '') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="no_telp">Nomor Telepon</label>
            <input type="text" id="no_telp" name="no_telp"
                class="form-control @error('no_telp') is-invalid @enderror"
                value="{{ old('no_telp', $guru->no_telp ?? '') }}" required>
            @error('no_telp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3"
        required>{{ old('alamat', $guru->alamat ?? '') }}</textarea>
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ isset($guru) ? 'Kosongkan jika tidak diubah' : '' }}"
                {{ isset($guru) ? '' : 'required' }}>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                {{ isset($guru) ? '' : 'required' }}>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="foto">Foto</label>
    <input type="file" id="foto" name="foto" class="form-control-file @error('foto') is-invalid @enderror">
    @error('foto')
        <div class="invalid-feedback mt-2">{{ $message }}</div>
    @enderror
    @if (isset($guru) && $guru->foto)
        <img src="{{ Storage::url($guru->foto) }}" alt="Foto Guru" class="img-thumbnail mt-3" width="150">
    @endif
</div>
