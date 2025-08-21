<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compra extends Model
{
    protected $fillable = [
        'proveedor_id',
        'fecha',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Tercero::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class);
    }
}
