<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine_id');
            $table->integer('type');
            $table->integer('category');
            $table->integer('quantity');
            $table->integer('used');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_logs');
    }
}
