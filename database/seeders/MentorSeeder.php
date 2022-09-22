<?php

namespace Database\Seeders;

use App\Models\Mentor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mentor::create([
            'user_id' => 2,
            'major_id' => 6,
            'verifikasi' => false,
        ]);
        Mentor::create([
            'user_id' => 3,
            'major_id' => 7,
            'verifikasi' => false,
        ]);
    }
}
