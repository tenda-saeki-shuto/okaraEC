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
        Schema::create('recipe_steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recie_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('content', 300);            
            $table->string('img');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_steps');
    }
};
