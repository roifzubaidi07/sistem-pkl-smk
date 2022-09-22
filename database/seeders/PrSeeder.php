<?php

namespace Database\Seeders;

use App\Models\Pr;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pr::create([
            'user_id' => 4
        ]);
    }
}
