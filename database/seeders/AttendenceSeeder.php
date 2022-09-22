<?php

namespace Database\Seeders;

use App\Models\Attendence;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attendence::create([
            'student_id' => 1,
            'tanggal' => '2022-06-05',
            'jam_datang' => '07:14',
            'jam_pulang' => '16:18',
            'status' => 1,
            'verifikasi' => false
        ]);
        Attendence::create([
            'student_id' => 2,
            'tanggal' => '2022-06-05',
            'jam_datang' => '07:22',
            'jam_pulang' => '16:00',
            'status' => 1,
            'verifikasi' => false
        ]);
        Attendence::create([
            'student_id' => 3,
            'tanggal' => '2022-06-05',
            'jam_datang' => '08:00',
            'jam_pulang' => '14:00',
            'status' => 1,
            'verifikasi' => false
        ]);
        
    }
}
