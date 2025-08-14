<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        $this->call([
            CategoriaSeeder::class,
            MarcaSeeder::class,
        ]);
    }
}
