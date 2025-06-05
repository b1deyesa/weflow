<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->unsignedBigInteger('team_home_id')->nullable()->change();
            $table->unsignedBigInteger('team_away_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->unsignedBigInteger('team_home_id')->nullable(false)->change();
            $table->unsignedBigInteger('team_away_id')->nullable(false)->change();
        });
    }
};
