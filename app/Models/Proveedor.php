<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    // Muchos a Muchos
    public function productos()
    {
        return $this->belongsToMany("App\Models\Producto");
    }
}
