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
        Schema::create('paises', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo')->unique();
            $table->string('codigo_sag')->nullable();
            $table->bigInteger('cap')->nullable();
            $table->string('codigo_facturacion')->nullable();
            $table->string('Tipo_identificador')->nullable();
            $table->boolean('Activo')->default(true);
            $table->string('Nacionalidad')->nullable();
            $table->boolean('predeterminado')->default(false);
            $table->unsignedBigInteger('id_PRO_P_Paises_grupo')->nullable();
            $table->string('codigo_multipuerto')->nullable();
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
        Schema::dropIfExists('paises');
    }
};
