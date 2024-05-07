<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHopitalsTable extends Migration
{
    public function up()
    {
        Schema::create('hopitals', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('Region');
            $table->string('Ville');
            $table->string('Type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hopitals');
    }
}