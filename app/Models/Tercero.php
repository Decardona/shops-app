<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
    protected $fillable = [
        'tipo_documento',
        'documento',
        'escliente',
        'esproveedor',
        'nombre',
        'apellido',
        'email',
        'direccion'
    ];

}
