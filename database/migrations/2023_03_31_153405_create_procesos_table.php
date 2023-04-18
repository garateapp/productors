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
        Schema::create('procesos', function (Blueprint $table) {
            $table->id();

            $table->string('agricola');
            $table->integer('n_proceso');
            $table->string('especie');
            $table->string('variedad');
            $table->string('fecha');
            $table->integer('kilos_netos');
            $table->integer('id_empresa');
            $table->string('informe')->nullable();
            $table->integer('exp');
            $table->integer('comercial');
            $table->integer('desecho');
            $table->integer('merma');

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
        Schema::dropIfExists('procesos');
    }
};
