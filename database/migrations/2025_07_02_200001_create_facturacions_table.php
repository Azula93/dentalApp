<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturacions', function (Blueprint $table) {


            $table->bigIncrements('id');
            $table->string('numero_recibo')->nullable()->unique();
            $table->date('fecha_emision');
            $table->date('fecha_pago');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('impuesto', 10, 2)->default(0);
            $table->decimal('monto', 10, 2);
            $table->string('metodo_pago');
            $table->string('referencia_pago')->nullable();
            $table->string('descripcion')->nullable();
            $table->enum('estado', ['pendiente', 'pagado', 'anulado'])->default('pagado');


            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('control_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();;
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('control_id')->references('id')->on('controles')->onDelete('set null');

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
        Schema::dropIfExists('facturacions');
    }
}
