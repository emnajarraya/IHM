<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateModerateursCentresTable extends Migration
{
    public function up(): void
    {
        Schema::create('moderateurs_centres', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('centre_interet_id')->constrained('centre_interets')->onDelete('cascade');
            $table->primary(['user_id', 'centre_interet_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moderateurs_centres');
    }
}

