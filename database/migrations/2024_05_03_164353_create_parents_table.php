<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    public function up()
    {
        Schema::create('Parents', function (Blueprint $table) {
            $table->string('CIN')->primary();
            $table->string('nom');
            $table->string('prenom');
            $table->string('adress')->nullable();
            $table->string('telephone')->nullable();
            $table->string('Email')->nullable();
            $table->string('Region')->nullable();
            $table->string('Pays')->default('Morocco');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Parents');
    }
}