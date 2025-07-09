<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {

            $table->id();
            $table->string('numero_historia', 20)->unique(); // Código interno tipo "HC-0001"

            // DATOS PERSONALES
            $table->string('nombres', 100)->nullable();
            $table->string('apellidos', 100)->nullable();
            $table->string('di', 20)->nullable();               // Documento de Identidad
            $table->integer('edad')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('estado_civil', 50)->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->string('ocupacion', 100)->nullable();

            $table->string('direccion_residencia', 255)->nullable();

            $table->string('celular', 20)->nullable();
            $table->string('email', 100)->nullable();

            $table->string('acudiente', 100)->nullable();
            $table->string('parentesco', 50)->nullable();
            $table->string('ocupacion_acudiente', 100)->nullable();
            $table->string('correo_acudiente', 191)->nullable();
            $table->string('celular_acudiente', 20)->nullable();

            $table->string('eps', 100)->nullable();
            $table->string('tipo_vinculacion', 100)->nullable();
            $table->string('servicio_urgencias', 100)->nullable();

            $table->date('ultima_visita_odontologo')->nullable();
            $table->string('ultimo_tratamiento', 255)->nullable();
            $table->string('como_se_entero', 255)->nullable();
            $table->text('historia_enfermedad_actual')->nullable();
            $table->text('motivo_consulta')->nullable();

            $table->enum('tipo_sangre', ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-']);

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
        Schema::dropIfExists('pacientes');
    }
}
