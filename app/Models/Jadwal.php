<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kursus', 'id_peserta', 'id_instruktur', 'id_mobil', 'tanggal', 'jam_mulai', 'jam_akhir', 'status'
    ];
}
