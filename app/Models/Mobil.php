<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_plat', 'merk_mobil', 'jenis_mobil', 'foto'
    ];
}
