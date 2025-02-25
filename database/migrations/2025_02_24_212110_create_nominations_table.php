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
        Schema::create('nominations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('ranking_id')->constrained('entries')->onDelete('cascade');
            $table->foreignUuid('place_id')->constrained('entries')->onDelete('cascade');
            $table->timestamps();

            // Prevent duplicate nominations for the same ranking and place combination
            $table->unique(['ranking_id', 'place_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominations');
    }
};
