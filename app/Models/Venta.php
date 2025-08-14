<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['tercero_id', 'user_id', 'fecha', 'total'];
    public function tercero()
    {
        return $this->belongsTo(Tercero::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class);
    }
}
