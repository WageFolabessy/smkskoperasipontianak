<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="kelas_id">Kelas</label>
            <select id="kelas_id" name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($semua_kelas as $kelas)
                    <option value="{{ $kelas->id }}"
                        {{ old('kelas_id', $jadwal_pelajaran->kelas_id ?? '') == $kelas->id ? 'selected' : '' }}>
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
            <label for="hari">Hari</label>
            <select id="hari" name="hari" class="form-control @error('hari') is-invalid @enderror" required>
                <option value="">-- Pilih Hari --</option>
                @php
                    $semua_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                @endphp
                @foreach ($semua_hari as $hari)
                    <option value="{{ $hari }}"
                        {{ old('hari', $jadwal_pelajaran->hari ?? '') == $hari ? 'selected' : '' }}>{{ $hari }}
                    </option>
                @endforeach
            </select>
            @error('hari')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="mata_pelajaran_id">Mata Pelajaran</label>
            <select id="mata_pelajaran_id" name="mata_pelajaran_id"
                class="form-control @error('mata_pelajaran_id') is-invalid @enderror" required>
                <option value="">-- Pilih Mata Pelajaran --</option>
                @foreach ($semua_mapel as $mapel)
                    <option value="{{ $mapel->id }}"
                        {{ old('mata_pelajaran_id', $jadwal_pelajaran->mata_pelajaran_id ?? '') == $mapel->id ? 'selected' : '' }}>
                        {{ $mapel->nama_mapel }}
                    </option>
                @endforeach
            </select>
            @error('mata_pelajaran_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="guru_id">Guru Pengajar</label>
            <select id="guru_id" name="guru_id" class="form-control @error('guru_id') is-invalid @enderror" required>
                <option value="">-- Pilih Guru --</option>
                @foreach ($semua_guru as $guru)
                    <option value="{{ $guru->id }}"
                        {{ old('guru_id', $jadwal_pelajaran->guru_id ?? '') == $guru->id ? 'selected' : '' }}>
                        {{ $guru->user->nama }}
                    </option>
                @endforeach
            </select>
            @error('guru_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="time" id="jam_mulai" name="jam_mulai"
                class="form-control @error('jam_mulai') is-invalid @enderror"
                value="{{ old('jam_mulai', isset($jadwal_pelajaran->jam_mulai) ? $jadwal_pelajaran->jam_mulai->format('H:i') : '') }}"
                required>
            @error('jam_mulai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="time" id="jam_selesai" name="jam_selesai"
                class="form-control @error('jam_selesai') is-invalid @enderror"
                value="{{ old('jam_selesai', isset($jadwal_pelajaran->jam_selesai) ? $jadwal_pelajaran->jam_selesai->format('H:i') : '') }}"
                required>
            @error('jam_selesai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
