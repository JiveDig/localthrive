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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('ranking_id')->constrained('entries')->onDelete('cascade');
            $table->foreignUuid('place_id')->constrained('entries')->onDelete('cascade');
            $table->integer('value');
            $table->timestamps();

            // Prevent duplicate votes
            $table->unique(['user_id', 'ranking_id', 'place_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
