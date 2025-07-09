<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultorios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('horario_atencion');
            $table->enum('tipo_consultorio', ['privado', 'publico'])->nullable();
            $table->string('especialidad');
            $table->string('ciudad');
            $table->string('capacidad');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('ubicacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultorios');
    }
}
