<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_home_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('team_away_id')->constrained('teams')->onDelete('cascade');
            $table->dateTime('game_time')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['pending', 'done'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
