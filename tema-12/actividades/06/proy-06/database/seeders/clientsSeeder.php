<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Client;

class clientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('clients')->insert([
		// 	'apellidos' => 'García Pérez',
		// 	'nombre' => 'Antonio',
		// 	'telefono' => '956789456',
		// 	'ciudad' => 'Prado del Rey',
		// 	'dni' => '12456789B',
		// 	'email' => 'tamavex@gamil.com'
		// ]);

		// DB::table('clients')->insert([
		// 	'apellidos' => 'Tamayo Velázquez',
		// 	'nombre' => 'Pedro',
		// 	'telefono' => '666555989',
		// 	'ciudad' => 'Prado del Rey',
		// 	'dni' => '74932387C',
		// 	'email' => 'pedro@gamil.com'
		// ]);

		Client::factory()->count(10)->create();
		
    }
}
