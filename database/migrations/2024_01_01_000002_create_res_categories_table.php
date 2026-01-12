<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('res_categories', function (Blueprint $table) {
            $table->id('c_id');
            $table->string('c_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('res_categories');
    }
};

