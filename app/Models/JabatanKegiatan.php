<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanKegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'idPegawai',
        'idKategori',
        'jabStatus',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'idPegawai');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idKategori');
    }
}
