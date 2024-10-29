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
        Schema::create('tipo_documentacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('estado')->default(1);
            $table->string('nombre_guardado')->nullable();
            $table->boolean('tiene_vigencia')->default(false);
            $table->date('fecha_vigencia')->nullable();
            $table->boolean('obligatorio')->default(false);
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->unsignedBigInteger('especie_id')->nullable();
            $table->timestamps();

            // Clave foránea para el usuario que crea el registro
            $table->foreign('creado_por')->references('id')->on('users')->onDelete('set null');
            $table->foreign('pais_id')->references('id')->on('Paises')->onDelete('set null');
            $table->foreign('especie_id')->references('id')->on('especies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_documentacions');
    }
};
