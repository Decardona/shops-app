<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tercero;

class DatosPruebaSeeder extends Seeder
{
    public function run()
    {
        // Crear algunos proveedores
        Tercero::firstOrCreate([
            'documento' => '12345678'
        ], [
            'tipo_documento' => 'CC',
            'nombre' => 'Proveedor',
            'apellido' => 'Test',
            'direccion' => 'Calle 123',
            'esproveedor' => true,
            'escliente' => false
        ]);

        Tercero::firstOrCreate([
            'documento' => '87654321'
        ], [
            'tipo_documento' => 'CC',
            'nombre' => 'Distribuidora',
            'apellido' => 'ABC',
            'direccion' => 'Carrera 456',
            'esproveedor' => true,
            'escliente' => false
        ]);
    }
}
