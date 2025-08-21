<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.productos.index', [
            'productos' => Producto::orderBy('id', 'desc')
            ->orWhere('nombre', 'like', '%' . request('q') . '%')
            ->orWhere('descripcion', 'like', '%' . request('q') . '%')
            ->orWhere('sku', 'like', '%' . request('q') . '%')
            ->paginate(10),
        ]);
    }

    public function list()
    {
        $vitrina = Producto::where('activo', true)
            ->where(function($query) {
                $q = request('q');
                if ($q) {
                    $query->where('nombre', 'like', "%$q%")
                          ->orWhere('descripcion', 'like', "%$q%");
                }
            })
            ->orderBy('nombre', 'asc')
            ->paginate(8);
        return view('app.productos.list', [
            'productos' => $vitrina,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categorias = Categoria::all()->orderBy('nombre')->get();
        // $marcas = Marca::all()->orderBy('nombre')->get();

        return view('app.productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:0|max:99999999.99',
            'existencia' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'activo' => 'required|boolean',
            'imagen_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'imagen' => 'nullable|string|max:255'
        ]);

        if ($request->hasFile('imagen_file')) {
            $path = $request->file('imagen_file')->store('products', 'public');
            $request->merge(['imagen' => basename($path)]);
        }

        $producto = Producto::create($request->all());

        return redirect()->route('productos.edit', $producto)->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('app.productos.view', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('app.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'existencia' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'activo' => 'required|boolean',
            'imagen_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagen' => 'nullable|string|max:255'
        ]);

        if ($request->hasFile('imagen_file')) {
            $path = $request->file('imagen_file')->store('products', 'public');
            $request->merge(['imagen' => basename($path)]);
            if ($producto->imagen) {
                Storage::disk('public')->delete('products/' . $producto->imagen);
            }
        }

        $producto->update($request->all());

        return redirect()->route('productos.edit', $producto)->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        if ($producto->imagen) {
            Storage::disk('public')->delete('products/' . $producto->imagen);
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
