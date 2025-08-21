<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Tercero;

class ComprasController extends Controller
{
    public function index(Request $request)
    {
        $query = Compra::with(['proveedor', 'detalles.producto']);
        
        // Filtro por búsqueda de proveedor
        if ($request->filled('q')) {
            $search = $request->q;
            $query->whereHas('proveedor', function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellido', 'like', "%{$search}%");
            });
        }
        
        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        
        // Ordenar por fecha más reciente
        $query->orderBy('created_at', 'desc');
        
        $compras = $query->paginate(10);
        
        return view('app.compras.index', compact('compras'));
    }

    public function create()
    {
        return view('app.compras.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:terceros,id',
            'fecha' => 'required|date',
            'estado' => 'required|string|max:50',
        ]);

        $productos = json_decode($request->input('compra_detalle'), true);

        if (!is_array($productos) || count($productos) === 0) {
            return redirect()->back()->with(['error' => 'Los productos son requeridos.']);
        }

        // Solo los campos de la compra
        $compra = Compra::create([
            'proveedor_id' => $validated['proveedor_id'],
            'fecha' => $validated['fecha'],
            'estado' => $validated['estado'],
        ]);

        foreach ($productos as $item) {
            $detalle = [
                'compra_id' => $compra->id,
                'producto_id' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio' => $item['precio'],
            ];

            $detalleCompra = \App\Models\DetalleCompra::create($detalle);

            // Actualizar existencia del producto
            $producto = \App\Models\Producto::find($detalleCompra->producto_id);
            $producto->existencia += $detalleCompra->cantidad;
            $producto->save();
        }

        return redirect()->route('compras.show', $compra->id)
            ->with('success', 'Compra y productos registrados exitosamente.');
    }

    public function show($id)
    {
        $compra = Compra::with(['proveedor', 'detalles.producto'])->findOrFail($id);
        return view('app.compras.show', compact('compra'));
    }

    public function edit($id)
    {
        $compra = Compra::with(['proveedor', 'detalles.producto'])->findOrFail($id);
        $proveedores = Tercero::where('esproveedor', true)->get();
        $productos = Producto::all();
        return view('app.compras.edit', compact('compra', 'proveedores', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $compra = Compra::findOrFail($id);
        
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:terceros,id',
            'fecha' => 'required|date',
            'estado' => 'required|string|max:50',
        ]);

        $compra->update($validated);

        return redirect()->route('compras.show', $compra->id)
            ->with('success', 'Compra actualizada exitosamente.');
    }
}