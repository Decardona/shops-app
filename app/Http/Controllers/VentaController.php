<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Support\Facades\DB;

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
        $idVenta = DB::transaction(function() use ($data, $productos) {
            $venta = new Venta();
            $venta->tercero_id = $data['tercero_id'];
            $venta->total = array_reduce($productos, function($carry, $prod) {
                $producto = Producto::find($prod['id']);
                return $carry + ($producto->precio * $prod['cantidad']);
            }, 0);
            $venta->user_id = auth()->id();
            $venta->save();

            foreach ($productos as $prod) {
                $producto = Producto::find($prod['id']);
                $producto->existencia -= $prod['cantidad'];
                $producto->save();

                $detalle = new VentaDetalle();
                $detalle->venta_id = $venta->id;
                $detalle->producto_id = $producto->id;
                $detalle->cantidad = $prod['cantidad'];
                $detalle->precio = $producto->precio;
                $detalle->save();
            }
            return $venta->id;
        });

        return redirect()->route('ventas.imprimir', $idVenta)->with('success', 'Venta registrada exitosamente.');
    }

    public function imprimir(Request $request, $id)
    {
        $venta = Venta::with(['detalles.producto', 'tercero'])->findOrFail($id);
        $from = $request->query('from');

        return view('app.ventas.imprimir', compact('venta', 'from'));
    }

    public function search() {
        return view('app.ventas.search');
    }

    public function startSearch(Request $request) {

        $tipo_busqueda = $request->query('tipo_busqueda');

        if ($tipo_busqueda === 'codigo_factura') {
            $data = $request->validate([
                'codigo_factura' => 'required|string|max:15',
            ]);

            // Implement search logic here
            $results = Venta::with('detalles.producto')
                ->where('id', $data['codigo_factura'])
                ->get();

            return view('app.ventas.search', compact('results'));
        } elseif ($tipo_busqueda === 'tercero_fecha') {
            $data = $request->validate([
                'tercero_id' => 'required|exists:terceros,id',
                'fecha_compra' => 'required|date',
            ]);
            $results = Venta::with('detalles.producto')
                ->where('tercero_id', $data['tercero_id'])
                ->whereDate('fecha', $data['fecha_compra'])
                ->get();

            return view('app.ventas.search', compact('results'));
        } else {
            return redirect()->back()->with(['error' => 'Tipo de búsqueda inválido.']);
        }

        
    }
}
