<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstadoCircuitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('circuitos', function (Blueprint $table) {
            $table->char('estado')->after('circuito')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('circuitos', function (Blueprint $table) {
            $table->dropColumn(['estado']);
        });
    }
}
