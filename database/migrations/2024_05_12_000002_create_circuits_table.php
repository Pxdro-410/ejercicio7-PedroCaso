<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('circuits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('country');
            $table->decimal('length_km', 5, 3);
            $table->integer('turns');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('circuits');
    }
};
