<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedecinSpecialitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medecin_specialites', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_medecin')->unsigned();
            $table->integer('id_specialite')->unsigned();

            $table->foreign('id_medecin')->references('id')->on('medecins');
            $table->foreign('id_specialite')->references('id')->on('specialites');

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
        Schema::dropIfExists('medecin_specialites');
    }
}
