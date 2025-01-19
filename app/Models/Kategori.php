<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaKategori',
    ];

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }

    public function jabatanKegiatan()
    {
        return $this->hasMany(JabatanKegiatan::class);
    }
}
