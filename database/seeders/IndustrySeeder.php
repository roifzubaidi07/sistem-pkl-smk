<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Industry::create([
            'nama' => 'PT Gudang Garam',
            'alamat' => 'Kalianget',
            'kuota' => 6,
        ]);
        Industry::create([
            'nama' => 'Dinas Sumenep',
            'alamat' => 'Jl. Dr. cipto No. 33',
            'kuota' => 7,
        ]);
        Industry::create([
            'nama' => 'Kominfo Sumenep',
            'alamat' => 'Jl.KH.Mas Mansyur no 71',
            'kuota' => 1,
        ]);
    }
}
