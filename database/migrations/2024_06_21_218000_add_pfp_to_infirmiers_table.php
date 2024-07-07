<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('infirmiers', function (Blueprint $table) {
            $table->string('pfp')->nullable(); // Nullable if profile picture is optional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('infirmiers', function (Blueprint $table) {
            //
        });
    }
};