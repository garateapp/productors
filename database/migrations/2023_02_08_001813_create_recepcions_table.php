<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcions', function (Blueprint $table) {
            $table->id();

            $table->integer('id_g_recepcion');
            $table->string('tipo_g_recepcion');
            $table->integer('numero_g_recepcion');
            $table->string('fecha_g_recepcion');
            $table->integer('id_emisor');
            $table->string('r_emisor');
            $table->string('n_emisor');
            $table->string('Codigo_Sag_emisor');
            $table->string('tipo_documento_recepcion');
            $table->string('numero_documento_recepcion');
            $table->string('n_especie');
            $table->string('n_variedad');
            $table->integer('cantidad');
            $table->integer('peso_neto');
            $table->integer('nota_calidad');
            $table->string('n_estado');
            $table->string('informe')->nullable();

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
        Schema::dropIfExists('recepcions');
    }
};
