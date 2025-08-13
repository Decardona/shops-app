<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tercero;

class TerceroController extends Controller

{
   public function index()
    {
        return view('app.terceros.index', [
            'terceros' => Tercero::orderBy('id', 'desc')
            ->orWhere('tipo_documento', 'like', '%' . request('q') . '%')
            ->orWhere('documento', 'like', '%' . request('q') . '%')
            ->orWhere('escliente', 'like', '%' . request('q') . '%')
            ->orWhere('esproveedor', 'like', '%' . request('q') . '%')
            ->orWhere('nombre', 'like', '%' . request('q') . '%')
            ->orWhere('apellido', 'like', '%' . request('q') . '%')
            ->orWhere('telefono', 'like', '%' . request('q') . '%')
            ->orWhere('email', 'like', '%' . request('q') . '%')
            ->orWhere('direccion', 'like', '%' . request('q') . '%')
            
            ->paginate(10),
        ]);
    }
    public function create()
    {
        return view('app.terceros.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_documento' => 'required|string|max:50',
            'documento' => 'required|string|max:50',
            'escliente' => 'nullable|boolean',
            'esproveedor' => 'nullable|boolean',
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        Tercero::create($validated);

        return redirect()->route('terceros.index')->with('success', 'Tercero creado exitosamente.');
    }

    public function edit(Tercero $tercero)
    {
        return view('app.terceros.edit', compact('tercero'));
    }

    public function update(Request $request, Tercero $tercero)
    {
        $validated = $request->validate([
            'tipo_documento' => 'required|string|max:50',
            'documento' => 'required|string|max:50',
            'escliente' => 'nullable|boolean',
            'esproveedor' => 'nullable|boolean',
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        $tercero->update($validated);

        return redirect()->route('terceros.index')->with('success', 'Tercero actualizado exitosamente.');
    }
}

