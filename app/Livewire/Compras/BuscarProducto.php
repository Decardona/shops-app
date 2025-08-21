<?php

namespace App\Livewire\Compras;

use Livewire\Component;
use App\Models\Producto;

class BuscarProducto extends Component
{
    public $search = '';
    public $sugerencias = [];
    public $productosSeleccionados = [];
    public $total = 0;
    public $sugerenciaSeleccionada = 0;

    public function updatedSearch()
    {
        if (strlen($this->search) > 2) {
            $this->sugerencias = Producto::where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('sku', 'like', '%' . $this->search . '%')
                ->limit(5)
                ->get();
        } else {
            $this->sugerencias = [];
        }
        $this->sugerenciaSeleccionada = 0;
    }

    public function seleccionarSiguiente()
    {
        if ($this->sugerenciaSeleccionada < count($this->sugerencias) - 1) {
            $this->sugerenciaSeleccionada++;
        }
    }

    public function seleccionarAnterior()
    {
        if ($this->sugerenciaSeleccionada > 0) {
            $this->sugerenciaSeleccionada--;
        }
    }

    public function seleccionarActual()
    {
        if (isset($this->sugerencias[$this->sugerenciaSeleccionada])) {
            $this->agregarProducto($this->sugerencias[$this->sugerenciaSeleccionada]->id);
        }
    }

    public function agregarProducto($productoId)
    {
        $producto = Producto::find($productoId);
        
        // Verificar si el producto ya está en la lista
        $index = array_search($productoId, array_column($this->productosSeleccionados, 'id'));
        
        if ($index !== false) {
            // Si ya existe, incrementar cantidad
            $this->productosSeleccionados[$index]['cantidad']++;
        } else {
            // Si no existe, agregarlo
            $this->productosSeleccionados[] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'sku' => $producto->sku ?? '',
                'precio' => $producto->precio,
                'cantidad' => 1,
                'subtotal' => $producto->precio
            ];
        }
        
        $this->actualizarSubtotales();
        $this->search = '';
        $this->sugerencias = [];
    }

    public function eliminarProducto($index)
    {
        unset($this->productosSeleccionados[$index]);
        $this->productosSeleccionados = array_values($this->productosSeleccionados);
        $this->actualizarSubtotales();
    }

    public function actualizarCantidad($index, $cantidad)
    {
        if ($cantidad > 0) {
            $this->productosSeleccionados[$index]['cantidad'] = $cantidad;
            $this->actualizarSubtotales();
        }
    }

    private function actualizarSubtotales()
    {
        $this->total = 0;
        foreach ($this->productosSeleccionados as &$producto) {
            $producto['subtotal'] = $producto['precio'] * $producto['cantidad'];
            $this->total += $producto['subtotal'];
        }
    }

    public function render()
    {
        return view('livewire.compras.buscar-producto');
    }
}
