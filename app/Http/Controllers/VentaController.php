<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function create()
    {
        return view('app.ventas.create');
    }
}
