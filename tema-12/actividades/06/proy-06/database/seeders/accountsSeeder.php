<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Account;

class accountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('accounts')->insert([
		// 	'iban' => '12345623121324',
		// 	'cliente_id' => '1',
		// 	'fecha_alta' => '1981/02/06',
		// 	'saldo' => '15000',
		// 	'fecha_ultimo_mov' => '2000-02-20',
		// 	'num_mvtos' => '12',
		// ]);

		// DB::table('accounts')->insert([
		// 	'iban' => '323456',
		// 	'cliente_id' => '2',
		// 	'fecha_alta' => '1989-12-15',
		// 	'saldo' => '3000',
		// 	'fecha_ultimo_mov' => '1999-02-10',
		// 	'num_mvtos' => '10',
		// ]);

		Account::factory()->count(10)->create();
    }
}
