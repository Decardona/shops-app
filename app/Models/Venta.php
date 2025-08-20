<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use SoftDeletes;
    
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
