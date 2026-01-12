<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id('d_id');
            $table->unsignedBigInteger('rs_id');
            $table->string('title');
            $table->string('slogan');
            $table->decimal('price', 10, 2);
            $table->string('img');
            $table->timestamps();
            
            $table->foreign('rs_id')->references('rs_id')->on('restaurants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};

