<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanKegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'kategori_id',
        'jabStatus',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,);
    }
}
