<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tercero extends Model
{
    use HasFactory;
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

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
