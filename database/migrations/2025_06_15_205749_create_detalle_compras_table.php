<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
  * Run the migrations.
  */
  public function up(): void
  {
    Schema::create('detalle_compras', function (Blueprint $table) {
      $table->id();
      $table->foreignId('compra_id')->nullable()->constrained('compras');
      $table->foreignId('ingrediente_id')->nullable()->constrained('ingredientes');
      $table->double('cantidad_comprada');
      $table->double('precio_unitario');
      $table->double('subtotal');
      $table->timestamps();
    });
  }

  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('detalle_compras');
  }
};
