<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function purchase(){
      return $this->belongsTo(Compra::class,'compra_id','id');
    }

    public function ingredient(){
      return $this->belongsTo(Ingrediente::class,'ingrediente_id','id');
    }
}
