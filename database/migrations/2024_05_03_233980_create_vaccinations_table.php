<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateVaccinationsTable extends Migration
{
    public function up()
    {
        Schema::create('Vaccinations', function (Blueprint $table) {
            $table->timestamp('Date')->nullable()->useCurrent();
            $table->string('Lieu');
            $table->string('ID_enfant');
            $table->string('type_vaccination');
            $table->foreign('ID_enfant')->references('id')->on('enfants')->onDelete('cascade'); // Ensure onDelete is set appropriately
            $table->foreign('type_vaccination')->references('nom')->on('vaccins');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Vaccinations');
    }
}