<?php

use App\Models\Ticket;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

                $table->enum('status',[Ticket::ENVIADO,Ticket::LEIDO])->default(Ticket::ENVIADO);
                $table->text('observacion')->nullable();
                $table->text('respuesta')->nullable();
                $table->string('tipo');
                
                $table->string('emisor_id');
                $table->string('receptor_id')->nullable();

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
        Schema::dropIfExists('tickets');
    }
};
