<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIndexTallasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tallas', function (Blueprint $table) {
            $table->unique(['talla', 'color']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tallas', function (Blueprint $table) {
            $table->dropUnique(['talla', 'color']);
        });
    }
}
