<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_soal',
        'guru_id',
        'kelas_id',
        'mata_pelajaran_id',
        'batas_waktu',
    ];

    protected function casts(): array
    {
        return [
            'batas_waktu' => 'datetime',
        ];
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function jawabanTugas()
    {
        return $this->hasMany(JawabanTugas::class, 'tugas_id');
    }
}
