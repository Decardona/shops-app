<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tercero;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DatosPruebaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'prueba',
            'email' => 'prueba@remington.edu.co',
            'password' => bcrypt('prueba123'),
            'rol' => 'admin',
        ]);

        Tercero::factory()->create([
            'tipo_documento' => 'CC',
            'documento' => '22222222',
            'nombre' => 'Consumidor',
            'apellido' => 'Final',
            'escliente' => true,
            'email' => 'consumidorfinal@remington.edu.co',
            'direccion' => 'Calle 123 #45-67'
        ]);

        $this->call([
            CategoriaSeeder::class,
            MarcaSeeder::class,
            ProductoSeeder::class,
            DatosPruebaSeeder::class,
        ]);
    }
}
