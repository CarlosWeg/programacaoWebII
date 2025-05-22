<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->decimal('rating', 2, 1); // 0.0 a 5.0
            $table->text('comment')->nullable();
            $table->date('watched_date')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'movie_id']); // Um usuário só pode avaliar um filme uma vez
            $table->index('rating');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};