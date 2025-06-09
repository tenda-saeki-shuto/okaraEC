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
        Schema::create('nutrition_facts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recie_id');
            $table->foreign('recie_id')->references('id')->on('recies');
            $table->integer('energy');
            $table->integer('protain');
            $table->integer('fat');
            $table->integer('carb');
            $table->integer('fiber');
            $table->integer('salt_eqv');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_facts');
    }
};
