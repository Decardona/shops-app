<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Support\Str;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();

        $productosPorCategoria = [
            'Alimentos' => [
                ['nombre' => 'Arroz Diana', 'descripcion' => 'Arroz blanco de excelente calidad', 'sku' => 'ARZ-DIA'],
                ['nombre' => 'Leche Alpina', 'descripcion' => 'Leche entera pasteurizada', 'sku' => 'LEC-ALP'],
                ['nombre' => 'Gaseosa Coca-Cola', 'descripcion' => 'Bebida refrescante sabor cola', 'sku' => 'GAS-COC'],
                ['nombre' => 'Pan Bimbo', 'descripcion' => 'Pan tajado suave y fresco', 'sku' => 'PAN-BIM'],
                ['nombre' => 'Aceite Premier', 'descripcion' => 'Aceite vegetal para cocina', 'sku' => 'ACE-PRE'],
            ],
            'Medicamentos' => [
                ['nombre' => 'Acetaminofén Genérico', 'descripcion' => 'Tabletas para el dolor y fiebre', 'sku' => 'ACE-GEN'],
                ['nombre' => 'Ibuprofeno Genérico', 'descripcion' => 'Antiinflamatorio y analgésico', 'sku' => 'IBU-GEN'],
                ['nombre' => 'Omeprazol Genérico', 'descripcion' => 'Protector gástrico', 'sku' => 'OME-GEN'],
                ['nombre' => 'Loratadina Genérico', 'descripcion' => 'Antialérgico de uso común', 'sku' => 'LOR-GEN'],
                ['nombre' => 'Amoxicilina Genérico', 'descripcion' => 'Antibiótico de amplio espectro', 'sku' => 'AMO-GEN'],
            ],
            'Articulos de Aseo' => [
                ['nombre' => 'Jabón Rey', 'descripcion' => 'Jabón tradicional multiusos', 'sku' => 'JAB-REY'],
                ['nombre' => 'Detergente Ariel', 'descripcion' => 'Detergente para ropa', 'sku' => 'DET-ARI'],
                ['nombre' => 'Desinfectante Lysol', 'descripcion' => 'Desinfectante para superficies', 'sku' => 'DES-LYS'],
                ['nombre' => 'Papel Higiénico Familia', 'descripcion' => 'Papel higiénico doble hoja', 'sku' => 'PAP-FAM'],
                ['nombre' => 'Shampoo Sedal', 'descripcion' => 'Shampoo para todo tipo de cabello', 'sku' => 'SHA-SED'],
            ],
            'Computo' => [
                ['nombre' => 'Mouse Logitech', 'descripcion' => 'Mouse óptico inalámbrico', 'sku' => 'MOU-LOG'],
                ['nombre' => 'Teclado Genius', 'descripcion' => 'Teclado USB estándar', 'sku' => 'TEC-GEN'],
                ['nombre' => 'Monitor LG', 'descripcion' => 'Monitor LED 24 pulgadas', 'sku' => 'MON-LG'],
                ['nombre' => 'Memoria USB Kingston', 'descripcion' => 'Memoria USB 32GB', 'sku' => 'USB-KIN'],
                ['nombre' => 'Audífonos Sony', 'descripcion' => 'Audífonos estéreo con micrófono', 'sku' => 'AUD-SON'],
            ],
            'Electrohogar' => [
                ['nombre' => 'Licuadora Oster', 'descripcion' => 'Licuadora de alta potencia', 'sku' => 'LIC-OST'],
                ['nombre' => 'Aspiradora LG', 'descripcion' => 'Aspiradora para el hogar', 'sku' => 'ASP-LG'],
                ['nombre' => 'Plancha Philips', 'descripcion' => 'Plancha de vapor', 'sku' => 'PLA-PHI'],
                ['nombre' => 'Microondas Samsung', 'descripcion' => 'Microondas digital 20L', 'sku' => 'MIC-SAM'],
                ['nombre' => 'Ventilador Imusa', 'descripcion' => 'Ventilador de mesa 3 velocidades', 'sku' => 'VEN-IMU'],
            ],
        ];

        foreach ($categorias as $categoria) {
            $productos = $productosPorCategoria[$categoria->nombre] ?? [];
            foreach ($productos as $producto) {
                Producto::create([
                    'nombre' => $producto['nombre'],
                    'descripcion' => $producto['descripcion'],
                    'imagen' => null,
                    'sku' => $producto['sku'],
                    'categoria_id' => $categoria->id,
                    'marca_id' => $marcas->random()->id,
                    'activo' => true,
                    'existencia' => 2,
                    'precio' => rand(5000, 50000),
                    'costopromedio' => 0,
                ]);
            }
        }
    }
}
