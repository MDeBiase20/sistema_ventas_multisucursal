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
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();

            $table->dateTime('fecha_apertura');
            $table->dateTime('fecha_cierre')->nullable();
            $table->decimal('monto_inicial', 15, 2);

            $table->decimal('monto_cierre_teorico', 15, 2)->nullable();
            $table->decimal('monto_cierre_real', 15, 2)->nullable();
            $table->decimal('diferencia', 15, 2)->nullable();

            $table->enum('estado', ['abierta', 'cerrada'])->default('abierta');

            $table->decimal('monto_efectivo', 15, 2)->nullable();
            $table->decimal('monto_transferencia', 15, 2)->nullable();
            $table->decimal('monto_otros', 15, 2)->nullable();

            $table->unsignedBigInteger('sucursal_id');
            $table->foreign('sucursal_id')->references('id')->on('sucursals')->onDelete('cascade');

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cajas');
    }
};
