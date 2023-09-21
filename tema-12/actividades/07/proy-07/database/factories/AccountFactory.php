<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;
use App\Models\Client;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'iban' => fake()->unique()->regexify('[A-Z]{2}\d{22}'),
            'client_id' => Client::factory(),
            'fecha_alta' => fake()->date(),
            'saldo' =>fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max= 200000),
            'fecha_ultimo_mov' => fake()->date(),
            'num_mvtos' => fake()->numberBetween($min =1, $max = 200)
        ];
    }
}
