<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qualifyings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->integer('position');
            $table->string('q1_time')->nullable();
            $table->string('q2_time')->nullable();
            $table->string('q3_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qualifyings');
    }
};
