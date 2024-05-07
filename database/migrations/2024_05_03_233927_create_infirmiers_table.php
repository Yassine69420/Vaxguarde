<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfirmiersTable extends Migration
{
    public function up()
    {
        Schema::create('infirmiers', function (Blueprint $table) {
            $table->string('INP')->primary();
            $table->string('CIN');
            $table->string('nom');
            $table->string('prenom');
            $table->string('Ville');
            $table->date('date_de_naissance');
            $table->string('nom_Hopital'); // Foreign key column
            
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('infirmiers');
    }
}