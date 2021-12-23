<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $fillable = ['nrp', 'departemen', 'nama', 'angkatan', 'gender', 'alamat', 'asalSekolah', 'noHp'];
}
