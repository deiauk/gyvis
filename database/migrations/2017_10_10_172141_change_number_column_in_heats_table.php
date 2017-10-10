<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNumberColumnInHeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('heats', function (Blueprint $table) {
            $table->integer('number')->change();
            $table->renameColumn('number', 'animal_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('heats', function (Blueprint $table) {
            $table->string('number')->change();
            $table->renameColumn('animal_id', 'number');
        });
    }
}
