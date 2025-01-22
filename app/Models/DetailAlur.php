<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAlur extends Model
{
    use HasFactory;

    protected $fillable = [
        'aplikasi_id',
        'alur_id',
        'keterangan_alur',
    ];

    public function aplikasi()
    {
        return $this->belongsTo(Aplikasi::class);
    }

    public function alur()
    {
        return $this->belongsTo(Alur::class);
    }
}
