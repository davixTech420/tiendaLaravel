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
        Schema::create('cupones', function (Blueprint $table) {
            $table->id();
            $table->string('cupon')->unique();
            $table->decimal('descuento');
            $table->date('fec_ini');
            $table->date('fec_fin');
            $table->boolean('mul_usos')->default(false);
            $table->integer('cantidad');
            $table->json('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupones');
    }
};
