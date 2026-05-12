<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sponsor_team', function (Blueprint $table) {
            $table->foreignId('sponsor_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->primary(['sponsor_id', 'team_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsor_team');
    }
};
