<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('valoraciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')
                ->constrained('pacientes')
                ->onDelete('cascade');

            // Ortodoncia previa
            $table->boolean('ortodoncia_previa')->default(false);
            $table->boolean('tiene_aparatologia')->default(false);
            $table->string('tiempo_aparatologia')->nullable();

            // Examen facial
            $table->enum('perfil_facial', ['convexo', 'recto', 'concavo'])->nullable();
            $table->decimal('sna', 5, 1)->nullable();
            $table->decimal('snb', 5, 1)->nullable();
            $table->decimal('anb', 5, 1)->nullable();
            $table->decimal('clase1_mm', 5, 1)->nullable();
            $table->decimal('clase2_mm', 5, 1)->nullable();
            $table->decimal('clase3_mm', 5, 1)->nullable();

            // asimetria facial
            $table->boolean('desvio_mandibular')->default(false);
            $table->boolean('desvio_lado_der')->nullable();
            $table->decimal('desvio_mm_der', 5, 1)->nullable();
            $table->boolean('desvio_lado_izq')->nullable();
            $table->decimal('desvio_mm_izq', 5, 1)->nullable();

            // Tipo de cara
            $table->enum('tipo_cara', ['mesoprosopo', 'euriprosopo', 'leptoprosopo'])->nullable();

            // Labios
            $table->enum('labio_superior', ['normal', 'proquelia', 'retroquelia', 'fisura'])->nullable();
            $table->enum('labio_inferior', ['normal', 'proquelia', 'retroquelia', 'fisura'])->nullable();


            // Examen intraoral 
            $table->enum('denticion', ['temporal', 'mixta', 'permanente'])->nullable();
            $table->enum('api_sup',  ['leve', 'moderado', 'severo'])->nullable();
            $table->enum('api_inf',  ['leve', 'moderado', 'severo'])->nullable();
            $table->enum('dias_sup', ['leve', 'moderado', 'severo'])->nullable();
            $table->enum('dias_inf', ['leve', 'moderado', 'severo'])->nullable();

            $table->boolean('agenesia')->nullable();
            $table->string('agenesia_cual', 100)->nullable();

            $table->boolean('hipoplasia')->nullable();
            $table->string('hipoplasia_cual', 100)->nullable();

            $table->boolean('pigmentaciones')->nullable();

            $table->string('dientes_erupcion', 100)->nullable();
            $table->string('dientes_ausentes', 100)->nullable();

            $table->boolean('mordida_cruzada')->nullable();
            $table->enum('mordida_cruzada_tipo', ['anterior', 'posterior'])->nullable();
            $table->enum('mordida_cruzada_lado', ['unilateral', 'bilateral'])->nullable();

            $table->boolean('mordida_abierta')->nullable();
            $table->enum('mordida_abierta_tipo', ['anterior', 'posterior'])->nullable();
            $table->enum('mordida_abierta_lado', ['unilateral', 'bilateral'])->nullable();

            $table->string('rotacion', 100)->nullable();
            $table->string('intrusion', 100)->nullable();
            $table->string('extrusion', 100)->nullable();

            $table->string('gresion', 100)->nullable();
            $table->string('version', 100)->nullable();
            $table->string('migracion', 100)->nullable();

            $table->boolean('retencion')->nullable();
            $table->string('retencion_cual', 100)->nullable();

            // CLASIFICACION DE ANGLE Y CANINA
            // Canina
            $table->unsignedTinyInteger('canina_der_clase1')->nullable();
            $table->unsignedTinyInteger('canina_der_clase2')->nullable();
            $table->unsignedTinyInteger('canina_der_clase3')->nullable();
            $table->unsignedTinyInteger('canina_izq_clase1')->nullable();
            $table->unsignedTinyInteger('canina_izq_clase2')->nullable();
            $table->unsignedTinyInteger('canina_izq_clase3')->nullable();

            // Molar
            $table->unsignedTinyInteger('molar_der_clase1')->nullable();
            $table->unsignedTinyInteger('molar_der_clase2')->nullable();
            $table->unsignedTinyInteger('molar_der_clase3')->nullable();
            $table->unsignedTinyInteger('molar_izq_clase1')->nullable();
            $table->unsignedTinyInteger('molar_izq_clase2')->nullable();
            $table->unsignedTinyInteger('molar_izq_clase3')->nullable();

            // Overjet (sobremordida horizontal)
            $table->decimal('overjet_normal', 4, 1)->nullable();
            $table->decimal('overjet_aumentado', 4, 1)->nullable();
            $table->decimal('overjet_borde', 4, 1)->nullable();
            $table->decimal('overjet_invertido', 4, 1)->nullable();

            // Overbite (sobremordida vertical)
            $table->decimal('overbite_mordida_abierta', 4, 1)->nullable();
            $table->decimal('overbite_corona_clinica', 4, 1)->nullable();
            $table->decimal('overbite_sobremordida', 4, 1)->nullable();


            //    INCLINACION MOLAR

            // Primera fila
            $table->enum('fila1_derecha_8', ['+', 'N', '-'])->nullable();
            $table->enum('fila1_derecha_7', ['+', 'N', '-'])->nullable();
            $table->enum('fila1_derecha_6', ['+', 'N', '-'])->nullable();
            $table->enum('fila1_izquierda_6', ['+', 'N', '-'])->nullable();
            $table->enum('fila1_izquierda_7', ['+', 'N', '-'])->nullable();
            $table->enum('fila1_izquierda_8', ['+', 'N', '-'])->nullable();

            // Segunda fila 
            $table->enum('fila2_derecha_8', ['+', 'N', '-'])->nullable();
            $table->enum('fila2_derecha_7', ['+', 'N', '-'])->nullable();
            $table->enum('fila2_derecha_6', ['+', 'N', '-'])->nullable();
            $table->enum('fila2_izquierda_6', ['+', 'N', '-'])->nullable();
            $table->enum('fila2_izquierda_7', ['+', 'N', '-'])->nullable();
            $table->enum('fila2_izquierda_8', ['+', 'N', '-'])->nullable();

            // Desviación Línea Media Dentaria
            $table->decimal('midline_sup_derecha', 4, 1)->nullable();
            $table->decimal('midline_sup_izquierda', 4, 1)->nullable();
            $table->decimal('midline_inf_derecha', 4, 1)->nullable();
            $table->decimal('midline_inf_izquierda', 4, 1)->nullable();

            // Plano Terminal (dentición temporal)
            $table->decimal('plano_mesial_mm', 4, 1)->nullable();
            $table->decimal('plano_distal_mm', 4, 1)->nullable();
            $table->decimal('plano_neutro_mm', 4, 1)->nullable();

            // Pérdida ósea (vertical/horizontal)
            $table->boolean('perdida_osea')->nullable();
            $table->decimal('perdida_osea_vertical_mm', 4, 1)->nullable();
            $table->decimal('perdida_osea_horizontal_mm', 4, 1)->nullable();

            // Campos tipo radio y texto asociados
            $table->boolean('dilaceracion_radicular')->nullable();
            $table->string('dilaceracion_cual', 100)->nullable();

            $table->boolean('reabsorcion_radicular')->nullable();
            $table->string('reabsorcion_cual', 100)->nullable();

            $table->boolean('rarefaccion')->nullable();
            $table->string('rarefaccion_zona', 100)->nullable();

            $table->boolean('conductos_radicular')->nullable();
            $table->string('conductos_cual', 100)->nullable();

            $table->boolean('longitud_radicular_disminuida')->nullable();
            $table->string('longitud_cual', 100)->nullable();

            $table->boolean('retenedor_intrarradicular')->nullable();
            $table->string('retenedor_cual', 100)->nullable();

            $table->boolean('implante')->nullable();
            $table->string('implante_zona', 100)->nullable();
            $table->string('observ_radiografico', 255)->nullable();

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
        Schema::dropIfExists('valoracions');
    }
}
