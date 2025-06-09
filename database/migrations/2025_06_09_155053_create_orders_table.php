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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('order_code', 8);
            $table->dateTime('dateTime');
            $table->string('status',20);
            $table->boolean('is_regular')->default(false);
            $table->string('paymant',10);
            $table->string('postal_code',7);
            $table->string('prefecture',10);
            $table->string('address',30);
            $table->string('email',30);
            $table->string('tel',11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
