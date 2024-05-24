<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('enfants', function (Blueprint $table) {
            $table->String('id')->primary();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('CIN_Parent');
            $table->boolean('HepB_status')->default(false);
            $table->boolean('Rotavirus_1_status')->default(false);
            $table->boolean('Rotavirus_2_status')->default(false);
            $table->boolean('Rotavirus_3_status')->default(false);
            $table->boolean('DTaP_1_status')->default(false);
            $table->boolean('DTaP_2_status')->default(false);
            $table->boolean('DTaP_3_status')->default(false);
            $table->boolean('Hib_1_status')->default(false);
            $table->boolean('Hib_2_status')->default(false);
            $table->boolean('Hib_3_status')->default(false);
            $table->boolean('IPV_1_status')->default(false);
            $table->boolean('IPV_2_status')->default(false);
            $table->boolean('IPV_3_status')->default(false);
            $table->boolean('PCV1_1_status')->default(false);
            $table->boolean('PCV1_2_status')->default(false);
            $table->boolean('PCV1_3_status')->default(false);
            $table->boolean('MMR_status')->default(false);
            $table->boolean('Varicella_status')->default(false);
            $table->foreign('CIN_Parent')->references('CIN')->on('Parents');
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }        

    public function down()
    {
        Schema::dropIfExists('enfants');
    }
};