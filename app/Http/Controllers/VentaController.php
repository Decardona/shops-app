<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class VentaController extends Controller
{
    public function create()
    {
        return view('app.ventas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tercero_id' => 'required|exists:terceros,id',
        ]);
        $productos = json_decode($request->input('venta_detalle'), true);

        if (!is_array($productos) || count($productos) === 0) {
            return redirect()->back()->with(['error' => 'Los productos son requeridos.']);
        }

        $errores = [];
        foreach ($productos as $prod) {
            // Validar estructura
            if (
                !isset($prod['id']) ||
                !isset($prod['cantidad']) ||
                !is_numeric($prod['cantidad']) ||
                $prod['cantidad'] < 1
            ) {
                $errores[] = "Producto inválido.";
                continue;
            }

            // Validar existencia en la base de datos
            $producto = Producto::find($prod['id']);
            if (!$producto) {
                $errores[] = "Producto no encontrado (ID: {$prod['id']}).";
                continue;
            }

            // Validar existencias
            if ($prod['cantidad'] > $producto->existencia) {
                $errores[] = "No hay suficiente existencia para {$producto->nombre}.";
            }
        }

        if (count($errores) > 0) {
            return redirect()->back()->with(['error' => implode(', ', $errores)]);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
    }
}
