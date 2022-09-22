<?php

namespace Database\Seeders;

use App\Models\Chief;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChiefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chief::create([
            'user_id' => 11,
            'major_id' => 6
        ]);
    }
}
