<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentesMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes_medicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')
                ->constrained('pacientes')
                ->onDelete('cascade');
            // ANTECEDENTES MÉDICOS PERSONALES (SI/NO)
            $table->boolean('alergias')->default(false);
            $table->boolean('trastornos_coagulacion')->default(false);
            $table->boolean('enf_respiratorias')->default(false);
            $table->boolean('alteraciones_cardiacas')->default(false);
            $table->boolean('fiebre_reumatica')->default(false);
            $table->boolean('cirugias')->default(false);
            $table->boolean('enf_renal')->default(false);
            $table->boolean('hepatitis')->default(false);
            $table->boolean('trastornos_gastricos')->default(false);
            $table->boolean('hipertension')->default(false);
            $table->boolean('diabetes')->default(false);
            $table->boolean('hospitalizaciones')->default(false);
            $table->boolean('tto_farmacologico_actual')->default(false);
            $table->boolean('tto_medico_actual')->default(false);
            $table->boolean('vih_sida')->default(false);
            $table->boolean('cancer')->default(false);
            $table->boolean('fuma')->default(false);
            $table->boolean('embarazo')->default(false);
            $table->boolean('otra_patologia')->default(false);
            $table->string('antecedentes_personales_otro', 255)->nullable();

            // ANTECEDENTES MÉDICOS FAMILIARES
            $table->boolean('fam_cardiovasculares')->default(false);
            $table->boolean('fam_oncologicos')->default(false);
            $table->boolean('fam_endocrinos')->default(false);
            $table->boolean('fam_psiquiatricos')->default(false);
            $table->boolean('fam_hematologicos')->default(false);
            $table->boolean('fam_neurologicos')->default(false);
            $table->boolean('fam_autoinmunes')->default(false);
            $table->boolean('fam_otros')->default(false);
            $table->string('antecedentes_familiares_otro', 255)->nullable();

            // Observaciones generales
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('antecedentes_medicos');
    }
}
