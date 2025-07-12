<?php

namespace App\Rules;

use App\Models\JadwalPelajaran;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CekKonflikJadwal implements ValidationRule
{
    protected $kelasId;
    protected $guruId;
    protected $hari;
    protected $jamSelesai;
    protected $ignoreId;

    public function __construct($kelasId, $guruId, $hari, $jamSelesai, $ignoreId = null)
    {
        $this->kelasId = $kelasId;
        $this->guruId = $guruId;
        $this->hari = $hari;
        $this->jamSelesai = $jamSelesai;
        $this->ignoreId = $ignoreId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $jamMulai = $value;

        $query = JadwalPelajaran::where('hari', $this->hari)
            ->where(function ($q) use ($jamMulai) {
                $q->where('jam_mulai', '<', $this->jamSelesai)
                    ->where('jam_selesai', '>', $jamMulai);
            })
            ->where(function ($q) {
                $q->where('kelas_id', $this->kelasId)
                    ->orWhere('guru_id', $this->guruId);
            });

        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        if ($query->exists()) {
            $fail('Jadwal bentrok dengan jadwal lain untuk kelas atau guru yang sama pada waktu tersebut.');
        }
    }
}
