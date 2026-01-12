<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('remarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('frm_id');
            $table->string('status');
            $table->text('remark');
            $table->timestamp('remarkDate')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('remarks');
    }
};

