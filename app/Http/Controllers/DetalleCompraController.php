<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleCompra;
use App\Models\Compra;
use App\Models\Producto;

class DetalleCompraController extends Controller
{
    public function create($compraId)
    {
        $compra = Compra::findOrFail($compraId);
        $productos = Producto::all();
        return view('app.detalle_compra.create', compact('compra', 'productos'));
    }

    public function store(Request $request, $compraId)
    {
        $productos = $request->input('productos', []);
        foreach ($productos as $item) {
            $validated = \Validator::make($item, [
                'producto_id' => 'required|exists:productos,id',
                'cantidad' => 'required|integer|min:1',
                'precio' => 'required|numeric|min:0',
            ])->validate();

            $validated['compra_id'] = $compraId;
            $detalle = DetalleCompra::create($validated);

            $producto = \App\Models\Producto::find($detalle->producto_id);
            $producto->existencia += $detalle->cantidad;
            $producto->save();
        }

        return redirect()->route('compras.show', $compraId)
            ->with('success', 'Detalles de compra agregados y existencias actualizadas.');
    }
}
