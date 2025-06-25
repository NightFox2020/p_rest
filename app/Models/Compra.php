<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function purchase_details(){
      return $this->hasMany(DetalleCompra::class);
    }

    public function supplier(){
      return $this->belongsTo(Proveedor::class,'proveedor_id','id');
    }
}
