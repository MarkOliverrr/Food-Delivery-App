<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id('rs_id');
            $table->unsignedBigInteger('c_id');
            $table->string('title');
            $table->string('email');
            $table->string('phone');
            $table->string('url')->nullable();
            $table->string('o_hr');
            $table->string('c_hr');
            $table->string('o_days');
            $table->text('address');
            $table->string('image');
            $table->timestamps();
            
            $table->foreign('c_id')->references('c_id')->on('res_categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};

