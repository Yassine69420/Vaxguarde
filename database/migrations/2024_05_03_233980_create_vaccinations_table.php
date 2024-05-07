<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinationsTable extends Migration
{
    public function up()
    {
        Schema::create('Vaccinations', function (Blueprint $table) {
            $table->date('Date');
            $table->string('Lieu');
            $table->unsignedBigInteger('ID_enfant');
            $table->string('type_vaccination');
            $table->foreign('ID_enfant')->references('ID')->on('enfants');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Vaccinations');
    }
}