<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => "Admin",
            'password' => bcrypt('12345'),
            'no_induk' => '00000',
            'alamat' => 'Jl Urip Sumoharjo',
            'no_telp' => '08139718471',
            'level_id' => 1,
        ]);
        User::create([
            'nama' => "M. Ro'if",
            'password' => bcrypt('12345'),
            'no_induk' => '111111',
            'alamat' => 'Jl Urip Sumoharjo',
            'no_telp' => '082138492650',
            'level_id' => 4,
        ]);
        User::create([
            'nama' => "Ahmad",
            'password' => bcrypt('12345'),
            'no_induk' => '22222',
            'alamat' => 'Jl Urip Sumoharjo',
            'no_telp' => '0876543211',
            'level_id' => 4,
        ]);
        User::create([
            'nama' => "Reza",
            'password' => bcrypt('12345'),
            'no_induk' => '33333',
            'alamat' => 'Jl Urip Sumoharjo',
            'no_telp' => '082138492842',
            'level_id' => 2,
        ]);
        User::create([
            'nama' => "Siswa01",
            'password' => bcrypt('12345'),
            'no_induk' => '55555',
            'alamat' => 'Jl Urip Sumoharjo',
            'no_telp' => '082138492121',
            'level_id' => 5,
        ]);
        \App\Models\User::factory(5)->create();
        User::create([
            'nama' => "Ramzi",
            'password' => bcrypt('12345'),
            'no_induk' => '101010',
            'alamat' => 'Jl Urip Sumoharjo',
            'no_telp' => '90718016419',
            'level_id' => 3,
        ]);
    }
}
