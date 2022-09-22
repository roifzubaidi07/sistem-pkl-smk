<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Major::create([
            'nama' => 'Perhotelan',
            'abbr' => 'ph',
        ]);
        Major::create([
            'nama' => 'Akuntansi dan Keuangan Lembaga',
            'abbr' => 'akl',
        ]);
        Major::create([
            'nama' => 'Bisnis Daring dan Pemasaran',
            'abbr' => 'bdp',
        ]);
        Major::create([
            'nama' => 'Multimedia',
            'abbr' => 'mm',
        ]);
        Major::create([
            'nama' => 'Otomatisasi dan Tata Kelola Perkantoran',
            'abbr' => 'otkp',
        ]);
        Major::create([
            'nama' => 'Rakayasa Perangkat Lunak',
            'abbr' => 'rpl',
        ]);
        Major::create([
            'nama' => 'Teknik komputer & Jaringan',
            'abbr' => 'tkj',
        ]);
        Major::create([
            'nama' => 'Tata Busana',
            'abbr' => 'tb',
        ]);
    }
}
