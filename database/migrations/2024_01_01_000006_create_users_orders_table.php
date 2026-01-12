<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_orders', function (Blueprint $table) {
            $table->id('o_id');
            $table->unsignedBigInteger('u_id');
            $table->string('title');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->string('status')->nullable();
            $table->timestamps();
            
            $table->foreign('u_id')->references('u_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_orders');
    }
};

