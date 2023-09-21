<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
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
            'nombre' => fake()->name(),
            'telefono' => fake()->unique()->phoneNumber(),
            'ciudad' => fake()->city(),
            'dni' => fake()->unique()->regexify('\d{8}[trwagmyfpdxbnjzsqvhlcke]'),
            'email' => fake()->unique()->safeEmail()

        ];
     
    }
}
