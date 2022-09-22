<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'user_id' => 5,
            'grade_id' => 2,
            'mentor_id' => 1,
            'industry_id' => 1,
            'verifikasi' => 0,
            'sertifikat' => 'sertifikat/Sertifikat_siswa1.pdf'
        ]);
        Student::create([
            'user_id' => 6,
            'grade_id' => 1,
            'mentor_id' => 1,
            'industry_id' => 2,
            'verifikasi' => 0
        ]);
        Student::create([
            'user_id' => 7,
            'grade_id' => 3,
            'mentor_id' => 2,
            'verifikasi' => 0
        ]);
        Student::create([
            'user_id' => 8,
            'grade_id' => 3,
            'mentor_id' => 2,
            'industry_id' => 2,
            'verifikasi' => 0
        ]);
        Student::create([
            'user_id' => 9,
            'grade_id' => 3,
            'verifikasi' => 0
        ]);
        Student::create([
            'user_id' => 10,
            'grade_id' => 1,
            'verifikasi' => 0
        ]);
    }
}
