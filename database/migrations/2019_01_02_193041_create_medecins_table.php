<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedecinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medecins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matricule')->nullable(false)->unique();
            $table->string('firstname')->nullable(false);
            $table->string('lastname');
            $table->date('date_naissance')->nullable(false);
            $table->string('ville_residence')->nullable(false);
            $table->integer('telephone')->nullable(true);
            $table->string('sexe')->nullable(false);
            $table->string('imagePath')->nullable(false);
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
        Schema::dropIfExists('medecins');
    }
}
