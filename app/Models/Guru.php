<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $fillable = [
        'user_id',
        'nip',
        'no_telp',
        'alamat',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelasWali()
    {
        return $this->hasMany(Kelas::class, 'guru_id');
    }

    public function jadwalMengajar()
    {
        return $this->hasMany(JadwalPelajaran::class, 'guru_id');
    }
}
