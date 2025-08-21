<?php

namespace App\Livewire\Compras;

use Livewire\Component;
use App\Models\Tercero;

class BuscarProveedor extends Component
{
    public $search = '';
    public $proveedor_id = null;
    public $selected_name = '';
    public $sugerencias = [];

    public function updatedSearch()
    {
        if (strlen($this->search) > 2) {
            $this->sugerencias = Tercero::where('esproveedor', true)
                ->where(function($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%')
                          ->orWhere('apellido', 'like', '%' . $this->search . '%')
                          ->orWhere('documento', 'like', '%' . $this->search . '%');
                })
                ->limit(5)
                ->get();
        } else {
            $this->sugerencias = [];
        }
    }

    public function seleccionarProveedor($id)
    {
        $proveedor = Tercero::find($id);
        $this->proveedor_id = $id;
        $this->selected_name = $proveedor->nombre . ' ' . $proveedor->apellido;
        $this->search = '';
        $this->sugerencias = [];
    }

    public function render()
    {
        return view('livewire.compras.buscar-proveedor');
    }
}
