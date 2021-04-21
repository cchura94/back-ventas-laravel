<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Uno a Muchos
    public function pedidos()
    {
        return $this->hasMany("App\Models\Pedido");
    }
}
