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
        Schema::create('fichas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('especie_id')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('variedad_id')
            ->nullable()
            ->constrained()
            ->onDelete('set null');

            $table->string('cuartel')->nullable();

            $table->string('ano_plantacion')->nullable();

            $table->string('cant_hectareas')->nullable();

            $table->string('prod_hectareas')->nullable();

            $table->string('total_produccion')->nullable();

            $table->string('porcentaje_de_entrega')->nullable();

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
        Schema::dropIfExists('fichas');
    }
};
