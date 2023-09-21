<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Movement;
use App\Models\Account;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Movement::class;

    public function definition(): array
    {
        return [
            'num_mov' => fake()->randomNumber(),
            'cuenta_id' => Account::factory(),
            'fecha_hora' => fake()->date(),
            'tipo' => fake()->randomElement($array = ['I', 'R']),
            'cantidad' => fake()->randomFloat($nbMaxDecimals= 2),
            'concepto' => fake()->text($maxNbChars = 50),
            'saldo' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100000)

        ];
    }
}
