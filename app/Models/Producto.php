<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Muchos a Uno (inversa)
    public function categoria()
    {
        return $this->belongsTo("App\Models\Categoria");
    }

    // Muchos a Muchos
    public function proveedors()
    {
        return $this->belongsToMany("App\Models\Proveedor");
    }

    // Muchos a Muchos 
    public function pedidos()
    {
        return $this->belongsToMany("App\Models\Pedido");
    }
}
