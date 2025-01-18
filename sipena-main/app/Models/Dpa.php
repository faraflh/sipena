<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpa extends Model
{
    use HasFactory;

    protected $fillable = [
        'noSPT',
        'noSPPD',
        'tujuan',
        'noRek',
        'noDPA',
        'subKeg',
        'tahun',
    ];
}
