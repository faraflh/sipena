<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaDokumen',
        'file',
        'aplikasi_id',
        'dokumen_id',
        'noSurat',
        'perihal',
        'tanggalSurat',
    ];

    public function aplikasi()
    {
        return $this->belongsTo(Aplikasi::class);
    }
    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class);
    }
}
