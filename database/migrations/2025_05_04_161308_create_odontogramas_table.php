<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdontogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odontogramas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')
                ->constrained('pacientes')
                ->onDelete('cascade');


            // Información general y tejidos
            $table->enum('labios', ['normal', 'anormal'])->default('normal');
            $table->enum('carrillos', ['normal', 'anormal'])->default('normal');
            $table->enum('paladar_duro', ['normal', 'anormal'])->default('normal');
            $table->enum('lengua', ['normal', 'anormal'])->default('normal');
            $table->enum('piso_boca', ['normal', 'anormal'])->default('normal');
            $table->enum('glandulas_salivares', ['normal', 'anormal'])->default('normal');
            $table->enum('orofaringe', ['normal', 'anormal'])->default('normal');

            // Hallazgos articulares
            $table->enum('ruido_articular', ['normal', 'anormal'])->default('normal');
            $table->enum('dolor_articular', ['normal', 'anormal'])->default('normal');
            $table->enum('dolor_muscular', ['normal', 'anormal'])->default('normal');
            $table->enum('alteraciones_movimiento', ['normal', 'anormal'])->default('normal');

            // Observaciones
            $table->string('observaciones_estomatologico', 500)->nullable();


            // 2) Antecedentes Odontológicos

            $table->enum('higiene_oral', ['B', 'R', 'M'])  // Bueno, Regular, Malo
                ->nullable();
            $table->boolean('seda_dental')->default(false);
            $table->string('sangrado_gingival', 255)->nullable();
            $table->boolean('odontalgia')->default(false);
            $table->string('odontalgia_cual', 255)->nullable();
            $table->string('frecuencia_cepillado', 100)->nullable();
            $table->date('ultima_visita_odontologo')->nullable();

            //
            // 3) Odontogramas (inicial y final)
            //
            $table->json('initial')->nullable();   // odontograma inicial
            $table->json('final')->nullable();     // odontograma final

            // Observaciones de esta sección
            $table->text('observaciones_odontograma')
                ->nullable();



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
        Schema::dropIfExists('odontogramas');
    }
}
