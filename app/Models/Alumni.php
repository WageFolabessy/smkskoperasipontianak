<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'nama_lengkap',
        'nis',
        'jurusan_id',
        'tahun_lulus',
        'no_telp',
        'alamat',
        'foto',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
