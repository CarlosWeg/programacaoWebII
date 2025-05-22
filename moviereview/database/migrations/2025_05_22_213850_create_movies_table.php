<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('director');
            $table->integer('year');
            $table->string('genre');
            $table->text('synopsis');
            $table->string('poster_url')->nullable();
            $table->integer('duration'); // em minutos
            $table->timestamps();
            
            $table->index(['title', 'year']);
            $table->index('genre');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};