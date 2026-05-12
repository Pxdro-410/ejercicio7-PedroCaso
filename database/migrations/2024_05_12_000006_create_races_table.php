<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->foreignId('circuit_id')->constrained()->onDelete('cascade');
            $table->integer('season');
            $table->string('name');
            $table->date('date');
            $table->integer('laps');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
