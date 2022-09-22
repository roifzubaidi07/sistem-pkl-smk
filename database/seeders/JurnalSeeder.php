<?php

namespace Database\Seeders;

use App\Models\Jurnal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JurnalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jurnal::create([
            'student_id' => 1,
            'waktu' => now(),
            'kegiatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero eum quos fuga nostrum reiciendis corporis mollitia, architecto beatae praesentium cum nam totam ut aperiam ratione! Hic vel sit fugit unde.',
            'image' => 'dokumentasi/default.jpg',
            'verifikasi' => false
        ]);
        Jurnal::create([
            'student_id' => 2,
            'waktu' => now(),
            'kegiatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero eum quos fuga nostrum reiciendis corporis mollitia, architecto beatae praesentium cum nam totam ut aperiam ratione! Hic vel sit fugit unde.',
            'image' => 'dokumentasi/default.jpg',
            'verifikasi' => false
        ]);
        Jurnal::create([
            'student_id' => 3,
            'waktu' => now(),
            'kegiatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero eum quos fuga nostrum reiciendis corporis mollitia, architecto beatae praesentium cum nam totam ut aperiam ratione! Hic vel sit fugit unde.',
            'image' => 'dokumentasi/default.jpg',
            'verifikasi' => false
        ]);
    }
}
