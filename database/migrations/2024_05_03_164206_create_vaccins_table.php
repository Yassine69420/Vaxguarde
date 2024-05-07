<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinsTable extends Migration
{
    public function up()
    {
        Schema::create('Vaccins', function (Blueprint $table) {
            $table->string('nom')->primary();
            $table->boolean('status')->default(false);
            $table->text('semaine');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Vaccins');
    }
}