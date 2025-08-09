<?php

namespace App\View\Components\Propios;

use Illuminate\View\Component;
use App\Models\Marca;

class Marcas extends Component
{
    public $name;
    public $selected;
    public $label;
    public $marcas;

    public function __construct($name = 'id_marca', $selected = null, $label = 'Marca')
    {
        $this->name = $name;
        $this->selected = $selected;
        $this->label = $label;
        $this->marcas = Marca::orderBy('nombre')->get();
    }

    public function render()
    {
        return view('components.propios.marcas');
    }
}
