<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        Kategori::create(['namaKategori' => 'Aplikasi']);
        Kategori::create(['namaKategori' => 'Administrasi']);
    }
}
