<div class="form-group">
    <label for="judul">Judul Tugas</label>
    <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror"
        value="{{ old('judul', $tugas->judul ?? '') }}" required>
    @error('judul')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="kelas_id">Untuk Kelas</label>
            <select id="kelas_id" name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror"
                required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($semua_kelas as $kelas)
                    <option value="{{ $kelas->id }}"
                        {{ old('kelas_id', $tugas->kelas_id ?? '') == $kelas->id ? 'selected' : '' }}>
                        {{ $kelas->nama_kelas }}
                    </option>
                @endforeach
            </select>
            @error('kelas_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="mata_pelajaran_id">Mata Pelajaran</label>
            <select id="mata_pelajaran_id" name="mata_pelajaran_id"
                class="form-control @error('mata_pelajaran_id') is-invalid @enderror" required>
                <option value="">-- Pilih Mata Pelajaran --</option>
                @foreach ($semua_mapel as $mapel)
                    <option value="{{ $mapel->id }}"
                        {{ old('mata_pelajaran_id', $tugas->mata_pelajaran_id ?? '') == $mapel->id ? 'selected' : '' }}>
                        {{ $mapel->nama_mapel }}
                    </option>
                @endforeach
            </select>
            @error('mata_pelajaran_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi (Opsional)</label>
    <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi', $tugas->deskripsi ?? '') }}</textarea>
    @error('deskripsi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="batas_waktu">Batas Waktu</label>
            <input type="datetime-local" id="batas_waktu" name="batas_waktu"
                class="form-control @error('batas_waktu') is-invalid @enderror"
                value="{{ old('batas_waktu', isset($tugas) ? \Carbon\Carbon::parse($tugas->batas_waktu)->format('Y-m-d\TH:i') : '') }}"
                required>
            @error('batas_waktu')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
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
