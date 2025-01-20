<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaJabatanStatus',
    ];

    public function jabatanKegiatan()
    {
        return $this->hasMany(JabatanKegiatan::class);
    }
}
