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
        Schema::create('item_nutrition_facts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');

            $table->integer('energy')->unsigned()->nullable();
            $table->float('protein')->unsigned()->nullable();
            $table->float('fat')->unsigned()->nullable();
            $table->float('carb')->unsigned()->nullable();
            $table->float('fiber')->unsigned()->nullable();
            $table->float('salt_eqv')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_nutrition_facts');
    }
};
