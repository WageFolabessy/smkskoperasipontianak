<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Import semua controller dengan jelas
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\JadwalPelajaranController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Guru\MateriController;
use App\Http\Controllers\Guru\TugasController;
use App\Http\Controllers\Guru\ProfileController as GuruProfileController;

use App\Http\Controllers\Siswa\MateriController as SiswaMateriController;
use App\Http\Controllers\Siswa\TugasController as SiswaTugasController;
use App\Http\Controllers\Siswa\ProfileController as SiswaProfileController;
use App\Http\Controllers\Siswa\JadwalPelajaranController as SiswaJadwalPelajaranController;
use App\Http\Controllers\Siswa\PembayaranController as SiswaPembayaranController;
use App\Http\Controllers\Siswa\NilaiController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // --- Rute untuk Data Jurusan ---
        Route::get('/data-jurusan', [JurusanController::class, 'tampilData'])->name('jurusan.tampil');
        Route::get('/data-jurusan/tambah', [JurusanController::class, 'tambahData'])->name('jurusan.tambah');
        Route::post('/data-jurusan', [JurusanController::class, 'simpanData'])->name('jurusan.simpan');
        Route::get('/data-jurusan/{jurusan}/ubah', [JurusanController::class, 'ubahData'])->name('jurusan.ubah');
        Route::put('/data-jurusan/{jurusan}', [JurusanController::class, 'perbaruiData'])->name('jurusan.perbarui');
        Route::delete('/data-jurusan/{jurusan}', [JurusanController::class, 'hapusData'])->name('jurusan.hapus');

        // --- Rute untuk Data Mata Pelajaran ---
        Route::get('/data-mata-pelajaran', [MataPelajaranController::class, 'tampilData'])->name('matapelajaran.tampil');
        Route::get('/data-mata-pelajaran/tambah', [MataPelajaranController::class, 'tambahData'])->name('matapelajaran.tambah');
        Route::post('/data-mata-pelajaran', [MataPelajaranController::class, 'simpanData'])->name('matapelajaran.simpan');
        Route::get('/data-mata-pelajaran/{mata_pelajaran}/ubah', [MataPelajaranController::class, 'ubahData'])->name('matapelajaran.ubah');
        Route::put('/data-mata-pelajaran/{mata_pelajaran}', [MataPelajaranController::class, 'perbaruiData'])->name('matapelajaran.perbarui');
        Route::delete('/data-mata-pelajaran/{mata_pelajaran}', [MataPelajaranController::class, 'hapusData'])->name('matapelajaran.hapus');

        // --- Rute untuk Data Guru ---
        Route::get('/data-guru', [AdminGuruController::class, 'tampilData'])->name('guru.tampil');
        Route::get('/data-guru/tambah', [AdminGuruController::class, 'tambahData'])->name('guru.tambah');
        Route::post('/data-guru', [AdminGuruController::class, 'simpanData'])->name('guru.simpan');
        Route::get('/data-guru/{guru}/ubah', [AdminGuruController::class, 'ubahData'])->name('guru.ubah');
        Route::put('/data-guru/{guru}', [AdminGuruController::class, 'perbaruiData'])->name('guru.perbarui');
        Route::delete('/data-guru/{guru}', [AdminGuruController::class, 'hapusData'])->name('guru.hapus');

        // --- Rute untuk Data Kelas ---
        Route::get('/data-kelas', [KelasController::class, 'tampilData'])->name('kelas.tampil');
        Route::get('/data-kelas/tambah', [KelasController::class, 'tambahData'])->name('kelas.tambah');
        Route::post('/data-kelas', [KelasController::class, 'simpanData'])->name('kelas.simpan');
        Route::get('/data-kelas/{kelas}/ubah', [KelasController::class, 'ubahData'])->name('kelas.ubah');
        Route::put('/data-kelas/{kelas}', [KelasController::class, 'perbaruiData'])->name('kelas.perbarui');
        Route::delete('/data-kelas/{kelas}', [KelasController::class, 'hapusData'])->name('kelas.hapus');

        // --- Rute untuk Data Siswa ---
        Route::get('/data-siswa', [AdminSiswaController::class, 'tampilData'])->name('siswa.tampil');
        Route::get('/data-siswa/tambah', [AdminSiswaController::class, 'tambahData'])->name('siswa.tambah');
        Route::post('/data-siswa', [AdminSiswaController::class, 'simpanData'])->name('siswa.simpan');
        Route::get('/data-siswa/{siswa}/ubah', [AdminSiswaController::class, 'ubahData'])->name('siswa.ubah');
        Route::put('/data-siswa/{siswa}', [AdminSiswaController::class, 'perbaruiData'])->name('siswa.perbarui');
        Route::delete('/data-siswa/{siswa}', [AdminSiswaController::class, 'hapusData'])->name('siswa.hapus');

        // --- Rute untuk Jadwal Pelajaran ---
        Route::get('/jadwal-pelajaran', [JadwalPelajaranController::class, 'tampilData'])->name('jadwal.tampil');
        Route::get('/jadwal-pelajaran/tambah', [JadwalPelajaranController::class, 'tambahData'])->name('jadwal.tambah');
        Route::post('/jadwal-pelajaran', [JadwalPelajaranController::class, 'simpanData'])->name('jadwal.simpan');
        Route::get('/jadwal-pelajaran/{jadwal_pelajaran}/ubah', [JadwalPelajaranController::class, 'ubahData'])->name('jadwal.ubah');
        Route::put('/jadwal-pelajaran/{jadwal_pelajaran}', [JadwalPelajaranController::class, 'perbaruiData'])->name('jadwal.perbarui');
        Route::delete('/jadwal-pelajaran/{jadwal_pelajaran}', [JadwalPelajaranController::class, 'hapusData'])->name('jadwal.hapus');

        // --- Rute untuk Pengelolaan Pembayaran ---
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::put('/pembayaran/{pembayaran}', [PembayaranController::class, 'update'])->name('pembayaran.update');
        // --- Akhir Rute Pengelolaan Pembayaran ---

        // --- Rute untuk Profil Admin ---
        Route::get('/profil', [AdminProfileController::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [AdminProfileController::class, 'update'])->name('profil.update');

        // --- Rute untuk Manajemen User ---
        Route::get('/manajemen-user', [UserController::class, 'index'])->name('user.index');
        Route::get('/manajemen-user/{user}/reset-password', [UserController::class, 'showResetForm'])->name('user.showResetForm');
        Route::put('/manajemen-user/{user}/reset-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');

        // --- Rute untuk Manajemen Admin ---
        Route::get('/manajemen-admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/manajemen-admin/tambah', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/manajemen-admin', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/manajemen-admin/{admin}/ubah', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/manajemen-admin/{admin}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/manajemen-admin/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });

    Route::middleware('role:guru')->prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');

        // --- Rute untuk Materi ---
        Route::get('/materi', [MateriController::class, 'tampilData'])->name('materi.tampil');
        Route::get('/materi/tambah', [MateriController::class, 'tambahData'])->name('materi.tambah');
        Route::post('/materi', [MateriController::class, 'simpanData'])->name('materi.simpan');
        Route::get('/materi/{materi}/ubah', [MateriController::class, 'ubahData'])->name('materi.ubah');
        Route::put('/materi/{materi}', [MateriController::class, 'perbaruiData'])->name('materi.perbarui');
        Route::delete('/materi/{materi}', [MateriController::class, 'hapusData'])->name('materi.hapus');

        // --- Rute untuk Tugas ---
        Route::get('/tugas', [TugasController::class, 'tampilData'])->name('tugas.tampil');
        Route::get('/tugas/tambah', [TugasController::class, 'tambahData'])->name('tugas.tambah');
        Route::post('/tugas', [TugasController::class, 'simpanData'])->name('tugas.simpan');
        Route::get('/tugas/{tugas}/ubah', [TugasController::class, 'ubahData'])->name('tugas.ubah');
        Route::put('/tugas/{tugas}', [TugasController::class, 'perbaruiData'])->name('tugas.perbarui');
        Route::delete('/tugas/{tugas}', [TugasController::class, 'hapusData'])->name('tugas.hapus');
        Route::get('/tugas/{tugas}/jawaban', [TugasController::class, 'lihatJawaban'])->name('tugas.jawaban');
        Route::post('/jawaban-tugas/{jawaban_tugas}/nilai', [TugasController::class, 'simpanNilai'])->name('tugas.simpanNilai');

        // --- Rute untuk Profil Guru ---
        Route::get('/profil', [GuruProfileController::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [GuruProfileController::class, 'update'])->name('profil.update');
    });

    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

        // --- Rute untuk Materi Siswa ---
        Route::get('/materi', [SiswaMateriController::class, 'index'])->name('materi.index');
        // --- Akhir Rute Materi Siswa ---

        // --- Rute untuk Tugas Siswa ---
        Route::get('/tugas', [SiswaTugasController::class, 'index'])->name('tugas.index');
        Route::get('/tugas/{tugas}/jawaban/unggah', [SiswaTugasController::class, 'unggahJawaban'])->name('tugas.unggahJawaban'); // Rute baru
        Route::post('/tugas/{tugas}/jawaban', [SiswaTugasController::class, 'simpanJawaban'])->name('tugas.simpanJawaban');
        // --- Akhir Rute Tugas Siswa ---

        // --- Rute untuk Profil Siswa ---
        Route::get('/profil', [SiswaProfileController::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [SiswaProfileController::class, 'update'])->name('profil.update');
        // --- Akhir Rute Profil Siswa ---

        // --- Rute untuk Jadwal Pelajaran Siswa ---
        Route::get('/jadwal-pelajaran', [SiswaJadwalPelajaranController::class, 'index'])->name('jadwal.index');
        // --- Akhir Rute Jadwal Pelajaran Siswa ---

        // --- Rute untuk Nilai Siswa ---
        Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
        // --- Akhir Rute Nilai Siswa ---

        // --- Rute untuk Pembayaran Siswa ---
        Route::get('/pembayaran', [SiswaPembayaranController::class, 'index'])->name('pembayaran.index');
        Route::post('/pembayaran', [SiswaPembayaranController::class, 'store'])->name('pembayaran.store');
        // --- Akhir Rute Pembayaran Siswa ---
    });
});
