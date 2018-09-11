<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaComprobantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('inscripcion_id')->unsigned();
            $table->integer('cuenta_id')->unsigned();
            $table->string('nombres',50);
            $table->string('apellidos',50);
            $table->char('num_doc',10);
            $table->string('telefono',30);
//            $table->decimal('valor',5,2);
            $table->string('email',60);
            $table->string('direccion',100);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('inscripcion_id')->references('id')->on('inscripciones') ->onDelete('cascade');
            $table->foreign('cuenta_id')->references('id')->on('cuentas') ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comprobantes');
    }
}
