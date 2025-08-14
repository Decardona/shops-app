<?php

namespace App\Livewire\Ventas;

use Livewire\Component;
use App\Models\Producto;

class BuscarProducto extends Component
{
    public $search = '';
    public $sugerencias = [];
    public $productosSeleccionados = [];
    public $sugerenciaSeleccionada = 0;
    public $total = 0;

    public function updatedSearch()
    {
        if (strlen($this->search) > 2) {
            $this->sugerencias = Producto::where('nombre', 'like', '%'.$this->search.'%')
                ->orWhere('sku', 'like', '%'.$this->search.'%')
                ->orWhere('id', $this->search)
                ->limit(8)
                ->get();
            $this->sugerenciaSeleccionada = 0;
        } else {
            $this->sugerencias = [];
            $this->sugerenciaSeleccionada = 0;
        }
    }

    public function calcularTotal() 
    {
        $this->total = array_reduce($this->productosSeleccionados, fn($carry, $item) =>
            $carry + ($item['precio'] * $item['cantidad']), 0);
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

    public function agregarProducto($id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            // Evitar duplicados
            if (!collect($this->productosSeleccionados)->contains('id', $producto->id)) {
                $this->productosSeleccionados[] = [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'sku' => $producto->sku,
                    'precio' => $producto->precio,
                    'cantidad' => 1,
                    'subtotal' => $producto->precio,
                ];
            }
        }
        $this->search = '';
        $this->sugerencias = [];
        $this->calcularTotal();
    }

    public function actualizarCantidad($index, $cantidad)
    {
        if (isset($this->productosSeleccionados[$index])) {
            $this->productosSeleccionados[$index]['cantidad'] = max(1, intval($cantidad));
            $this->productosSeleccionados[$index]['subtotal'] = $this->productosSeleccionados[$index]['precio'] * $this->productosSeleccionados[$index]['cantidad'];
        }
        $this->calcularTotal();
    }

    public function eliminarProducto($index)
    {
        unset($this->productosSeleccionados[$index]);
        $this->productosSeleccionados = array_values($this->productosSeleccionados);
        $this->calcularTotal();
    }

    public function render()
    {
        return view('livewire.ventas.buscar-producto');
    }
}
