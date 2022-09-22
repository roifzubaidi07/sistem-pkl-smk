<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'no_induk' => $this->faker->randomNumber(5, true),
            'password' => bcrypt('12345'),
            'alamat' => 'sumenep',
            'no_telp' => $this->faker->phoneNumber(),
            'level_id' => 5,
        ];
    }
}
