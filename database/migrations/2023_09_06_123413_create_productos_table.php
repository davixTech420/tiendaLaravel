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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->float('Precio');
            $table->integer('Stock');
            $table->string('Estado');
            $table->string('imagen');
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
