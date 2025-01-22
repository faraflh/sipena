<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pemohon',
        'nip',
        'nomor_telepon',
        'nama_opd',
        'nama_aplikasi',
        'email',
        'status',
        'generate_code',
    ];
}
