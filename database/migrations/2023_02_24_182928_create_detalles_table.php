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
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('calidad_id')
                ->constrained()
                ->onDelete('cascade');
            
            $table->integer('embalaje');

            $table->integer('cantidad');

            $table->foreignId('parametro_id')
                ->onDelete('set null');
            
            $table->foreignId('valor_id')
                ->onDelete('set null');
            
            $table->integer('cantidad_muestra');

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
        Schema::dropIfExists('detalles');
    }
};
