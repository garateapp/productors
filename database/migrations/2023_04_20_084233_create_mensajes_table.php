<?php

use App\Models\Mensaje;
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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();

            $table->enum('status',[Mensaje::ENVIADO,Mensaje::LEIDO])->default(Mensaje::ENVIADO);
            $table->text('observacion')->nullable();
            $table->string('especie');
            $table->string('tipo');
            $table->string('archivo');
            $table->string('emisor_id');
            $table->string('receptor_id');

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
        Schema::dropIfExists('mensajes');
    }
};
