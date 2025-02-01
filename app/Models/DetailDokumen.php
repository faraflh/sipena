<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dokumen',
        'file',
        'aplikasi_id',
        'dokumen_id',
        'no_surat',
        'perihal',
        'tanggal_surat',
    ];

    public function aplikasi()
    {
        return $this->belongsTo(Aplikasi::class);
    }
}
