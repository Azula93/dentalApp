<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_tratamientos', function (Blueprint $table) {
            $table->id();
            // Relación con paciente (o historia clínica)
            $table->foreignId('paciente_id')
                ->constrained('pacientes')
                ->onDelete('cascade');
            // Checkboxes de modalidad
            $table->boolean('ortodoncia_correctiva')->default(false);
            $table->boolean('compensacion_ortodoncia')->default(false);
            $table->boolean('ortopedia_dentofacial')->default(false);
            $table->boolean('cirugia_ortognatica')->default(false);
            // Objetivos de tratamiento
            $table->text('objetivos')->nullable();
            // Campos de exodoncias
            $table->string('exodoncias')->nullable();
            $table->string('posibles_exodoncias')->nullable();
            $table->string('sin_exodoncias')->nullable();
            // Complementarios
            $table->string('aparatologia_complementaria')->nullable();
            $table->string('contencion')->nullable();
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
        Schema::dropIfExists('plan_tratamientos');
    }
}
