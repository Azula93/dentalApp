<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenendodonticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenendodonticos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->cascadeOnDelete();
            $table->text('otros_superior')->nullable();
            $table->text('movilidad_superior')->nullable();
            $table->text('palpacion_superior')->nullable();
            $table->text('percusion_superior')->nullable();
            $table->text('fistula_superior')->nullable();
            $table->text('calor_superior')->nullable();
            $table->text('frio_superior')->nullable();
            $table->text('electricidad_superior')->nullable();
            $table->text('color_superior')->nullable();
            $table->text('cavitaria_superior')->nullable();
            $table->text('trauma_superior')->nullable();
            $table->text('pronostico_superior')->nullable();
            $table->text('otros_inferior')->nullable();
            // INFERIOR
            $table->text('movilidad_inferior')->nullable();
            $table->text('palpacion_inferior')->nullable();
            $table->text('percusion_inferior')->nullable();
            $table->text('fistula_inferior')->nullable();
            $table->text('calor_inferior')->nullable();
            $table->text('frio_inferior')->nullable();
            $table->text('electricidad_inferior')->nullable();
            $table->text('color_inferior')->nullable();
            $table->text('cavitaria_inferior')->nullable();
            $table->text('trauma_inferior')->nullable();
            $table->text('pronostico_inferior')->nullable();
            $table->date('fecha')->nullable();
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
        Schema::dropIfExists('examenendodonticos');
    }
}
