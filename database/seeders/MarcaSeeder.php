<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            ['nombre' => 'P&Y'],
            ['nombre' => 'LG'],
            ['nombre' => 'Diana'],
            ['nombre' => 'Sony'],
            ['nombre' => 'Manuelita'],
            ['nombre' => 'Nestlé'],
            ['nombre' => 'Alpina'],
            ['nombre' => 'Postobón'],
            ['nombre' => 'Bavaria'],
            ['nombre' => 'Coca-Cola'],
            ['nombre' => 'Pepsi'],
            ['nombre' => 'Gatorade'],
            ['nombre' => 'Red Bull'],
            ['nombre' => 'Monster'],
            ['nombre' => 'Genérico']
        ];

        foreach ($marcas as $marca) {
            \App\Models\Marca::create($marca);
        }
    }
}
