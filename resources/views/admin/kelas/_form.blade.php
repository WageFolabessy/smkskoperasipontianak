<div class="form-group">
    <label for="nama_kelas">Nama Kelas</label>
    <input type="text" id="nama_kelas" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror"
        value="{{ old('nama_kelas', $kelas->nama_kelas ?? '') }}" required>
    @error('nama_kelas')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="jurusan_id">Jurusan</label>
    <select id="jurusan_id" name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror" required>
        <option value="">-- Pilih Jurusan --</option>
        @foreach ($semua_jurusan as $jurusan)
            <option value="{{ $jurusan->id }}"
                {{ old('jurusan_id', $kelas->jurusan_id ?? '') == $jurusan->id ? 'selected' : '' }}>
                {{ $jurusan->nama_jurusan }}
            </option>
        @endforeach
    </select>
    @error('jurusan_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="guru_id">Wali Kelas</label>
    <select id="guru_id" name="guru_id" class="form-control @error('guru_id') is-invalid @enderror" required>
        <option value="">-- Pilih Wali Kelas --</option>
        @foreach ($semua_guru as $guru)
            <option value="{{ $guru->id }}"
                {{ old('guru_id', $kelas->guru_id ?? '') == $guru->id ? 'selected' : '' }}>
                {{ $guru->user->nama }}
            </option>
        @endforeach
    </select>
    @error('guru_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
