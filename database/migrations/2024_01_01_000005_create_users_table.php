<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('u_id');
            $table->string('username')->unique();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->text('address');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

