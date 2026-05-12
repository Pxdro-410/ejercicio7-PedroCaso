<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pit_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->integer('lap');
            $table->integer('duration_ms');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pit_stops');
    }
};
