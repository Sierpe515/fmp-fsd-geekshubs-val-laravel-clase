<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredientes extends Model
{
    use HasFactory;

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'ingredientes_pizza','ingrediente_id');
    }

    // public function ingredientes_pizza()
    // {
    //     return $this->hasMany(Ingredientes_Pizza::class);
    // }
}
