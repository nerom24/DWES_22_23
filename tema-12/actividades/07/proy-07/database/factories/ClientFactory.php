<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Client::class; 

    public function definition(): array
    {
        return [
            'apellidos' => fake()->lastName(),
            'nombre' => fake()->firstName(),
            'telefono' => fake()->unique()->phoneNumber(),
            'ciudad' => fake()->city(),
            'dni' => fake()->unique()->regexify('\d{8}[trwagmyfpdxbnjzsqvhlcke]'),
            'email' => fake()->unique()->safeEmail()

        ];
    }
}
