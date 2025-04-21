<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTim extends Model
{
    use HasFactory;

    protected $fillable = [
        'aplikasi_id',
        'jabatan_kegiatan_id',
        'pegawai_id',
    ];

    public function aplikasi()
    {
        return $this->belongsTo(Aplikasi::class);
    }

    public function jabatanKegiatan()
    {
        return $this->belongsTo(JabatanKegiatan::class);
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
