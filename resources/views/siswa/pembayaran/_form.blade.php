<div class="form-group">
    <label for="judul">Bulan</label>
    <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror"
        value="{{ old('judul', $tugas->judul ?? '') }}" required>
    @error('judul')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="file_soal">File Soal</label>
            <input type="file" id="file_soal" name="file_soal"
                class="form-control-file @error('file_soal') is-invalid @enderror"
                {{ isset($tugas) ? '' : 'required' }}>
            @error('file_soal')
                <div class="invalid-feedback mt-2">{{ $message }}</div>
            @enderror
            @if (isset($tugas) && $tugas->file_soal)
                <p class="mt-2">File saat ini: <a href="{{ Storage::url($tugas->file_soal) }}" target="_blank">Lihat
                        File</a></p>
            @endif
        </div>
    </div>
</div>
