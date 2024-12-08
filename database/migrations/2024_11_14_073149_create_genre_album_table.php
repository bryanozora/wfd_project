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
        Schema::create('genre_album', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('genre_id')->constrained('genre')->references('id');
            $table->foreignId('album_id')->constrained('album')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_album');
    }
};
