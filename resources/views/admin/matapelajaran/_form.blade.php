<div class="form-group">
    <label for="nama_mapel">Nama Mata Pelajaran</label>
    <input type="text" id="nama_mapel" name="nama_mapel" class="form-control @error('nama_mapel') is-invalid @enderror"
        value="{{ old('nama_mapel', $mata_pelajaran->nama_mapel ?? '') }}" required>
    @error('nama_mapel')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="jurusan_id">Jurusan</label>
    <select id="jurusan_id" name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror" required>
        <option value="">-- Pilih Jurusan --</option>
        @foreach ($semua_jurusan as $jurusan)
            <option value="{{ $jurusan->id }}"
                {{ old('jurusan_id', $mata_pelajaran->jurusan_id ?? '') == $jurusan->id ? 'selected' : '' }}>
                {{ $jurusan->nama_jurusan }}
            </option>
        @endforeach
    </select>
    @error('jurusan_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
