<?php

require_once 'vendor/autoload.php';

use App\Models\Tercero;
use App\Models\Producto; 
use App\Models\Categoria;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Crear una categoría si no existe
$categoria = Categoria::firstOrCreate(['nombre' => 'General']);

// Crear algunos proveedores de prueba
$proveedor1 = Tercero::firstOrCreate([
    'tipodocumento' => 'CC',
    'documento' => '12345678'
], [
    'nombre' => 'Proveedor',
    'apellido' => 'Test',
    'direccion' => 'Calle 123',
    'telefono' => '123456789',
    'esproveedor' => true,
    'escliente' => false
]);

$proveedor2 = Tercero::firstOrCreate([
    'tipodocumento' => 'NIT',
    'documento' => '87654321'
], [
    'nombre' => 'Distribuidora',
    'apellido' => 'ABC',
    'direccion' => 'Carrera 456',
    'telefono' => '987654321',
    'esproveedor' => true,
    'escliente' => false
]);

// Crear algunos productos de prueba
$producto1 = Producto::firstOrCreate([
    'nombre' => 'Arroz Diana'
], [
    'categoria_id' => $categoria->id,
    'descripcion' => 'Arroz blanco 500g',
    'precio' => 2500,
    'existencia' => 100
]);

$producto2 = Producto::firstOrCreate([
    'nombre' => 'Aceite Gourmet'
], [
    'categoria_id' => $categoria->id,
    'descripcion' => 'Aceite de cocina 1L',
    'precio' => 8500,
    'existencia' => 50
]);

$producto3 = Producto::firstOrCreate([
    'nombre' => 'Azúcar Manuelita'
], [
    'categoria_id' => $categoria->id,
    'descripcion' => 'Azúcar blanca 1kg',
    'precio' => 3200,
    'existencia' => 75
]);

echo "Datos de prueba creados exitosamente:\n";
echo "- Categorías: " . Categoria::count() . "\n";
echo "- Proveedores: " . Tercero::where('esproveedor', true)->count() . "\n";
echo "- Productos: " . Producto::count() . "\n";
