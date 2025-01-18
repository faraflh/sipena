<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaJabatan',
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'idJabatanPegawai');
    }
}
