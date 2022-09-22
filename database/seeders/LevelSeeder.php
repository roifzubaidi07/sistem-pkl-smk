<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'nama' => 'Admin',
            'url' => 'admin'
        ]);
        Level::create([
            'nama' => 'Humas',
            'url' => 'humas'
        ]);
        Level::create([
            'nama' => 'Kakomli',
            'url' => 'kakomli'
        ]);
        Level::create([
            'nama' => 'Guru Pembimbing',
            'url' => 'pembimbing'

        ]);
        Level::create([
            'nama' => 'Siswa',
            'url' => 'siswa'
        ]);
    }
}
