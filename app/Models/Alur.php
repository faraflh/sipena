<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alur extends Model
{
    use HasFactory;

    protected $table = 'alurs';

    protected $fillable = [
        'namaAlur',
    ];

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }
    public function detailAlur()
    {
        return $this->hasMany(DetailAlur::class);
    }

}