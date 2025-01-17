<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'idKategori',
        'idAlur',
        'jenisDokumen',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idKategori');
    }

    public function alur()
    {
        return $this->belongsTo(Alur::class, 'idAlur');
    }
}
