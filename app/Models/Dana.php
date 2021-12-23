<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    use HasFactory;
    protected $table = 'dana';
    protected $fillable = ['danaID', 'tipeTransaksi', 'biaya', 'tanggalTransaksi', 'sumber', 'keperluan'];
}
