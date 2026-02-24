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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();

            //Relacionamos la tabla empresas con las tablas de países, estados, ciudades y monedas para obtener el nombre del país, estado y ciudad en lugar del id
            //llave foranea para relacionar con la tabla empresas
            $table->unsignedBigInteger('pais_id');
            //relación con la llave foránea
            $table->foreign('pais_id')->references('id')->on('countries')->onDelete('cascade');

            $table->unsignedBigInteger('departamento_id');
            $table->foreign('departamento_id')->references('id')->on('states')->onDelete('cascade');

            $table->unsignedBigInteger('ciudad_id');
            $table->foreign('ciudad_id')->references('id')->on('cities')->onDelete('cascade');

            $table->unsignedBigInteger('moneda_id');
            $table->foreign('moneda_id')->references('id')->on('currencies')->onDelete('cascade');

            $table->string('nombre');
            $table->string('tipo_empresa');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('cuit')->unique();
            $table->string('impuesto');
            $table->string('nombre_impuesto');
            $table->string('codigo_postal');
            $table->string('logo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
