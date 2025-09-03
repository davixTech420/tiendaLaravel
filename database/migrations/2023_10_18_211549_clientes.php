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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->integer('documento');
            $table->string('Nombre');
            $table->string('Apellido');
            $table->integer('Edad');
            $table->integer('Direccion');
            $table->integer('Telefono');
            $table->string('Email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contraseña');
            $table->string('Estado');
            $table->remenberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
