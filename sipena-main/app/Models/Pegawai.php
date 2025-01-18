<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip_nik',
        'nama',
        'namaRek',
        'noRek',
        'bank',
        'golongan_id',
        'jabatan_pegawai_id',
        'email',
    ];

    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }

    public function jabatanPegawai()
    {
        return $this->belongsTo(JabatanPegawai::class);
    }

    public function jabatanKegiatan()
    {
        return $this->hasMany(JabatanKegiatan::class, $this->getForeignKey());
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }
}
