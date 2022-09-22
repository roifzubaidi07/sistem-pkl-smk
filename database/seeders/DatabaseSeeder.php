<?php

namespace Database\Seeders;

use Database\Seeders\PrSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\FileSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ChiefSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\LevelSeeder;
use Database\Seeders\JurnalSeeder;
use Database\Seeders\MentorSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\IndustrySeeder;
use Database\Seeders\AttendenceSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            MentorSeeder::class,
            IndustrySeeder::class,
            StudentSeeder::class,
            GradeSeeder::class,
            MajorSeeder::class,
            ChiefSeeder::class,
            LevelSeeder::class,
            AttendenceSeeder::class,
            JurnalSeeder::class,
            FileSeeder::class,
        ]);
    }
}
