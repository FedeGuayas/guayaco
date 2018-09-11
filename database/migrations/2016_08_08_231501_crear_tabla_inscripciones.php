<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaInscripciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('categoria_id')->unsigned();
            $table->integer('deporte_id')->nullable()->unsigned();
            $table->integer('circuito_id')->unsigned();
            $table->dateTime('fecha_insc');
            $table->string('edad',4);
            $table->char('kit',1)->default('1');
            $table->string('talla',20)->nullable();
            $table->string('escenario',45);
            $table->string('recomendado',100)->nulllable();
            $table->decimal('costo',5,2);
            $table->integer('num_corredor')->unique();
            $table->string('form_pago',20);
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('circuito_id')->references('id')->on('circuitos');
            $table->foreign('deporte_id')->references('id')->on('deportes');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inscripciones');
    }
}
