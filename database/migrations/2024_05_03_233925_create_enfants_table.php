<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::create('enfants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('Adress')->nullable();
            $table->date('date_naissance');
            $table->string('CIN_Parent');
            $table->foreign('CIN_Parent')->references('CIN')->on('Parents');
        });
    }

    public function down()
    {
        Schema::dropIfExists('enfants');
    }
};