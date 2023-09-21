<?php

namespace Database\Seeders;

use App\Models\Movement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class movementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('movements')->insert([
		// 	'cuenta_id' => '1',
		// 	'fecha_hora' => now(),
		// 	'tipo' => 'I',
		// 	'cantidad' => '2000',
		// 	'num_mov' => '1',
		// 	'concepto' => 'compra Vehiculo',
		// 	'saldo' => '2000',
		// ]);

		// DB::table('movements')->insert([
		// 	'cuenta_id' => '1',
		// 	'fecha_hora' => now(),
		// 	'tipo' => 'R',
		// 	'cantidad' => '100',
		// 	'num_mov' => '2',
		// 	'concepto' => 'venta Vehiculo',
		// 	'saldo' => '1900',
		// ]);

		// DB::table('movements')->insert([
		// 	'cuenta_id' => '2',
		// 	'fecha_hora' => now(),
		// 	'tipo' => 'I',
		// 	'cantidad' => '50',
		// 	'num_mov' => '3',
		// 	'concepto' => 'cobro Factura',
		// 	'saldo' => '1950',
		// ]);

		// DB::table('movements')->insert([
		// 	'cuenta_id' => '2',
		// 	'fecha_hora' => now(),
		// 	'tipo' => 'R',
		// 	'cantidad' => '55',
		// 	'num_mov' => '4',
		// 	'concepto' => 'pago Mercadona',
		// 	'saldo' => '1895',
		// ]);

		Movement::factory()->count(10)->create();
    }
}
