<?php

namespace App\Livewire\Ventas;

use Livewire\Component;
use App\Models\Tercero;

class BuscarTercero extends Component
{
    public $search = '';
    public $sugerencias = [];
    public $tercero_id = 1;
    public $selected_name = 'Consumidor Final';

    public function updatedSearch()
    {
        if (strlen($this->search) > 3) {
            $this->sugerencias = Tercero::where('nombre', 'like', '%'.$this->search.'%')
                ->orWhere('documento', 'like', '%'.$this->search.'%')
                ->orWhere('email', 'like', '%'.$this->search.'%')
                ->orWhere('apellido', 'like', '%'.$this->search.'%')
                ->limit(8)
                ->get();
        } else {
            $this->sugerencias = [];
        }
    }

    public function seleccionarTercero($id)
    {
        $tercero = Tercero::find($id);
        if ($tercero) {
            $this->tercero_id = $tercero->id;
            $this->selected_name = $tercero->nombre . " " . $tercero->apellido;
            $this->search = $tercero->nombre;
            $this->sugerencias = [];
        }
    }

    public function render()
    {
        return view('livewire.ventas.buscar-tercero');
    }
}
