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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->string('versao')->nullable();
            $table->integer('ano_fab');
            $table->integer('ano_modelo');
            $table->integer('km');
            $table->string('cor');
            $table->string('chassi')->unique();
            $table->string('placa')->unique();
            $table->decimal('preco_compra', 10, 2);
            $table->decimal('preco_venda', 10, 2);
            $table->foreignId('status_id')->constrained('status_veiculos');
            $table->text('observacoes')->nullable();
            $table->string('foto_principal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
