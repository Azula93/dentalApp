<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticoHcTable extends Migration
{
    public function up()
    {
        Schema::create('diagnostico_hc', function (Blueprint $table) {
            $table->id();

            // llave foránea al paciente
            $table->foreignId('paciente_id')
                ->constrained('pacientes')
                ->onDelete('cascade');

            // Procedimiento con todos los valores, incluyendo 'Tejidos Blandos'
            $table->enum('procedimiento', [
                'Oseo',
                'Dental',
                'Periodoncia',
                'DCM',
                'Miofuncional',
                'Implantológico',
                'Endodóntico',
                'Rehabilitación Oral',
                'Tejidos Blandos',
            ])->nullable();

            // Diagnóstico y solución
            $table->text('diagnostico')->nullable();
            $table->text('solucion')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diagnostico_hc');
    }
}
