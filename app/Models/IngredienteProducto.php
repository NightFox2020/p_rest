<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredienteProducto extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function ingredient(){
    return $this->belongsTo(Ingrediente::class,'ingrediente_id','id');
  }

  public function product(){
    return $this->belongsTo(Producto::class,'producto_id','id');
  }
}
