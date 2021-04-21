<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Muchos a Muchos
    public function productos()
    {
        return $this->belongsToMany("App\Models\Producto");
    }

    // Muchos a Uno (inversa)

    public function cliente()
    {
        return $this->belongsTo("App\Models\Cliente");
    }
}
