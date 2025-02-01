<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaAplikasi',
        'keterangan',
        'detail_tim_id',
        'detail_dokumen_id',
        'detail_alur_id',
        'url',
        'status',
    ];

    public function detailTim()
    {
        return $this->belongsTo(DetailTim::class);
    }

    public function detailDokumen()
    {
        return $this->belongsTo(DetailDokumen::class);
    }

    public function detailAlur()
    {
        return $this->belongsTo(DetailAlur::class);
    }

    public function tim()
    {
        return $this->hasMany(DetailTim::class);
    }

    public function dokumen()
    {
        return $this->hasMany(DetailDokumen::class);
    }

    public function alur()
    {
        return $this->hasMany(DetailAlur::class);
    }
}
