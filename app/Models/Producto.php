<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function category(){
    return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
  }

  public function ingredient_products(){
    return $this->hasMany(IngredienteProducto::class, 'producto_id', 'id');
  }
}
