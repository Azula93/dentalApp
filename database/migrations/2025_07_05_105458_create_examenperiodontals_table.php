<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenperiodontalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenperiodontals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->cascadeOnDelete();

            //‑‑ una columna por procedimiento (TEXT por si escriben párrafos)
            $table->text('otros')->nullable();
            $table->text('calculos_superior')->nullable();
            $table->text('sensibilidad_superior')->nullable();
            $table->text('trauma_superior')->nullable();
            $table->text('furca_superior')->nullable();
            $table->text('bolsa_superior')->nullable();
            $table->text('movilidad_superior')->nullable();
            $table->text('exudado_superior')->nullable();
            $table->text('hemorragia_superior')->nullable();
            $table->text('agrandamientoG_superior')->nullable();
            $table->text('retraccion_superior')->nullable();
            $table->text('biotipo_superior')->nullable();
            $table->text('pronostico_superior')->nullable();

            $table->text('otros_inferior')->nullable();
            $table->text('calculos_inferior')->nullable();
            $table->text('sensibilidad_inferior')->nullable();
            $table->text('trauma_inferior')->nullable();
            $table->text('furca_inferior')->nullable();
            $table->text('bolsa_inferior')->nullable();
            $table->text('movilidad_inferior')->nullable();
            $table->text('exudado_inferior')->nullable();
            $table->text('hemorragia_inferior')->nullable();
            $table->text('agrandamientoG_inferior')->nullable();
            $table->text('retraccion_inferior')->nullable();
            $table->text('biotipo_inferior')->nullable();
            $table->text('pronostico_inferior')->nullable();
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
        Schema::dropIfExists('examenperiodontals');
    }
}
