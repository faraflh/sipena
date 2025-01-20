<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'alur_id',
        'jenisDokumen',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function alur()
    {
        return $this->belongsTo(Alur::class);
    }
}
