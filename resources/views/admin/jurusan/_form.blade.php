<div class="form-group">
    <label for="nama_jurusan">Nama Jurusan</label>
    <input type="text" id="nama_jurusan" name="nama_jurusan"
        class="form-control @error('nama_jurusan') is-invalid @enderror"
        value="{{ old('nama_jurusan', $jurusan->nama_jurusan ?? '') }}" required>
    @error('nama_jurusan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
