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
        Schema::create('ingrediente_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->nullable()->constrained('productos');
            $table->foreignId('ingrediente_id')->nullable()->constrained('ingredientes');
            $table->double('cantidad_requerida')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingrediente_productos');
    }
};
