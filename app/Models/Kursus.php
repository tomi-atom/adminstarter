<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'id_instruktur', 'jemput', 'biaya_jemput', 'sim', 'biaya_sim', 'diskon', 'status'
    ];
}
