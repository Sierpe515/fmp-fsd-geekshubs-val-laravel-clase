<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function ingredientes()
    {
        return $this->belongsToMany(Ingredientes::class, 'ingredientes_pizza','pizza_id','ingrediente_id');
    }

    // public function ingredientes_pizza()
    // {
    //     return $this->hasMany(Ingredientes_Pizza::class);
    // }
}
