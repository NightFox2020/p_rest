<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ingredient_product(){
      return $this->hasMany(IngredienteProducto::class);
    }
}
