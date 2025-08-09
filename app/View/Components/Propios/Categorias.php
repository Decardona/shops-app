<?php

namespace App\View\Components\Propios;

use Illuminate\View\Component;
use App\Models\Categoria;

class Categorias extends Component
{
    public $name;
    public $selected;
    public $label;
    public $categorias;

    public function __construct($name = 'id_categoria', $selected = null, $label = 'Categoría')
    {
        $this->name = $name;
        $this->selected = $selected;
        $this->label = $label;
        $this->categorias = Categoria::orderBy('nombre')->get();
    }

    public function render()
    {
        return view('components.propios.categorias');
    }
}
