<?php

use App\Models\Detalle;
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
            
            $table->integer('embalaje')->nullable();

            $table->integer('cantidad')->nullable();

            $table->float('temperatura')->nullable();

            $table->float('valor_ss')->nullable();

            $table->integer('porcentaje_muestra')->nullable();

            $table->string('tipo_detalle');

            $table->string('tipo_item');
            
            $table->string('detalle_item');

            $table->enum('estado',[Detalle::PENDIENTE,Detalle::APROBADO])->default(Detalle::PENDIENTE);

            $table->date('fecha')->nullable();

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
