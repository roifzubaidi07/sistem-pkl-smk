<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::create([
            'nama' => 'XI RPL 1',
            'major_id' => 6
        ]);
        Grade::create([
            'nama' => 'XI RPL 2',
            'major_id' => 6
        ]);
        Grade::create([
            'nama' => 'XI TKJ 1',
            'major_id' => 7
        ]);
        Grade::create([
            'nama' => 'XI PH 1',
            'major_id' => 1
        ]);
    }
}
