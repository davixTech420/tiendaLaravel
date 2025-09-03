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
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('Cantidad');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('pedido_id');
            $table->timestamps();
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('pedido_id')->references('id')->on('pedidos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};
