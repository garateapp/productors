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
        Schema::create('calidads', function (Blueprint $table) {
            $table->id();

            $table->foreignId('recepcion_id')
                ->constrained()
                ->onDelete('cascade');

            $table->integer('nro_muestra');
            $table->integer('t_muestra');

            $table->string('t_camion');
            $table->string('encarpado');
            $table->string('seteo_termo');
            $table->string('condicion');

            $table->string('materia_vegetal');
            $table->string('piedras');
            $table->string('barro');
            $table->string('pedicelo_largo');
            $table->string('racimo');
            $table->string('esponjas');
            $table->string('h_esponjas');
            $table->string('llenado_tottes');

            $table->integer('h_abierta')->nullable();
            $table->integer('desgarro_peduncular')->nullable();
            $table->integer('p_agua')->nullable();
            $table->integer('p_longitudinal')->nullable();
            $table->integer('p_apical')->nullable();
            $table->integer('p_medialuna')->nullable();
            $table->integer('p_satura')->nullable();
            $table->integer('machucon')->nullable();
            $table->integer('pittig')->nullable();
            $table->integer('virosis')->nullable();
            $table->integer('q_sol')->nullable();
            $table->integer('f_deshidratado')->nullable();
            $table->integer('p_deshidratado')->nullable();
            $table->integer('pudricion_parda')->nullable();
            $table->integer('pudricion_negra')->nullable();
            $table->integer('pudricion_negra_verdosa')->nullable();
            $table->integer('d_granizo')->nullable();
            $table->integer('piel_lagardo')->nullable();
            $table->integer('daño_pajaro')->nullable();

            $table->integer('trips')->nullable();
            $table->integer('escama')->nullable();
            $table->integer('polilla')->nullable();
            $table->integer('d_suzukii')->nullable();
            $table->integer('tijereta')->nullable();

            $table->integer('guata_blanca')->nullable();
            $table->integer('falto_color')->nullable();
            $table->integer('hijuelo')->nullable();
            $table->integer('fruto_doble')->nullable();
            $table->integer('fruto_deforme')->nullable();
            $table->integer('russet')->nullable();
            $table->integer('herida_cicatrizada')->nullable();
            $table->integer('mancha_roce')->nullable();
            $table->integer('sutura')->nullable();
            $table->integer('sin_pedicelo')->nullable();
            $table->integer('ramaleo')->nullable();
            $table->integer('pre_calibre')->nullable();

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
        Schema::dropIfExists('calidads');
    }
};
