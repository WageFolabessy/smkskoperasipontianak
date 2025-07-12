<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap"
                class="form-control @error('nama_lengkap') is-invalid @enderror"
                value="{{ old('nama_lengkap', $alumni->nama_lengkap ?? '') }}" required>
            @error('nama_lengkap')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nis">NIS</label>
            <input type="text" id="nis" name="nis" class="form-control @error('nis') is-invalid @enderror"
                value="{{ old('nis', $alumni->nis ?? '') }}" required>
            @error('nis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="jurusan_id">Jurusan</label>
            <select id="jurusan_id" name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror"
                required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach ($semua_jurusan as $jurusan)
                    <option value="{{ $jurusan->id }}"
                        {{ old('jurusan_id', $alumni->jurusan_id ?? '') == $jurusan->id ? 'selected' : '' }}>
                        {{ $jurusan->nama_jurusan }}
                    </option>
                @endforeach
            </select>
            @error('jurusan_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tahun_lulus">Tahun Lulus</label>
            <input type="number" id="tahun_lulus" name="tahun_lulus"
                class="form-control @error('tahun_lulus') is-invalid @enderror"
                value="{{ old('tahun_lulus', $alumni->tahun_lulus ?? date('Y')) }}" required>
            @error('tahun_lulus')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="no_telp">Nomor Telepon</label>
    <input type="text" id="no_telp" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror"
        value="{{ old('no_telp', $alumni->no_telp ?? '') }}">
    @error('no_telp')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat', $alumni->alamat ?? '') }}</textarea>
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="foto">Foto</label>
    <input type="file" id="foto" name="foto" class="form-control-file @error('foto') is-invalid @enderror">
    @error('foto')
        <div class="invalid-feedback mt-2">{{ $message }}</div>
    @enderror
    @if (isset($alumni) && $alumni->foto)
        <img src="{{ Storage::url($alumni->foto) }}" alt="Foto Alumni" class="img-thumbnail mt-3" width="150">
    @endif
</div>
