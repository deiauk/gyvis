<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('animalNumber');
            $table->string('animalType');
            $table->string('age');
            $table->string('color');
            $table->date('sickDate');
            $table->string('animalResearchData');
            $table->string('pulse');
            $table->string('breath');
            $table->string('diagnosis');
            $table->text('treatmentAndDirections');
            $table->string('result');
            $table->text('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatments');
    }
}
