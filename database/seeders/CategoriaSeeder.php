<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Alimentos', 'imagen' => 'alimentos.png'],
            ['nombre' => 'Medicamentos', 'imagen' => 'medicamentos.png'],
            ['nombre' => 'Articulos de Aseo', 'imagen' => 'aseo.png'],
            ['nombre' => 'Computo', 'imagen' => 'computo.png'],
            ['nombre' => 'Electrohogar', 'imagen' => 'electrohogar.png'],
        ];

        foreach ($categorias as $categoria) {
            \App\Models\Categoria::create($categoria);
        }
    }
}
