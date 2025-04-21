<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDokumen extends Model
{
    use HasFactory;

    protected $fillable = [
<<<<<<< HEAD
        'namaDokumen',
        'file',
        'aplikasi_id',
        'dokumen_id',
        'noSurat',
        'perihal',
        'tanggalSurat',
=======
        'nama_dokumen',
        'file',
        'aplikasi_id',
        'dokumen_id',
        'no_surat',
        'perihal',
        'tanggal_surat',
>>>>>>> 0a4e0e5d9a377078fbc7b7afc2985acccd9f77e2
    ];

    public function aplikasi()
    {
        return $this->belongsTo(Aplikasi::class);
    }
<<<<<<< HEAD
    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class);
    }
=======
>>>>>>> 0a4e0e5d9a377078fbc7b7afc2985acccd9f77e2
}
