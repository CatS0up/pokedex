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
        Schema::create('pokemon', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->unsignedBigInteger('pokeapi_id')->unique()->nullable();

            $table->string('name')->unique();
            $table->string('sprite_url');

            $table->unsignedSmallInteger('weight');
            $table->unsignedSmallInteger('height');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
