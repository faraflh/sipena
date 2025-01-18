<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(10)->create();

//         User::factory()->create([
//             'name' => 'admin',
//             'email' => 'admin@admin.com',
//             'password' => Hash::make('admin123')
//         ]);
//
//         User::factory()->create([
//             'name' => 'farah',
//             'email' => 'farah@admin.com',
//             'password' => Hash::make('farah123')
//         ]);

        $pegawai = Pegawai::create([
            'nip_nik' => '6404',
            'nama' => 'Sabrina',
            'email' => 'sabrina@example.com',
            'namaRek' => 'Sabrina Ina',
            'noRek' => 987654321,
            'bank' => 'ABC Bank',
            'golongan_id' => 2,
            'jabatan_pegawai_id' => 1,
        ]);

        User::create([
            'pegawai_id' => $pegawai->id,
            'password' => Hash::make('password123'),
            'level' => 'admin',
        ]);
    }
}
