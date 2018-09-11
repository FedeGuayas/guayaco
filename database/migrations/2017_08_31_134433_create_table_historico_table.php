<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistoricoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historicos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('num_doc')->nullable();
            $table->string('nombres');
            $table->string('apellidos');
            $table->date('fecha_nac')->nullable();
            $table->string('sex');
            $table->string('email',100)->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono',30)->nullable();
            $table->string('category');
            $table->string('circuit');
            $table->integer('chip');
            $table->integer('place');
            $table->time('time');
            $table->char('year',4);
            $table->decimal('costo',5,2);

//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('historicos');
    }
}
