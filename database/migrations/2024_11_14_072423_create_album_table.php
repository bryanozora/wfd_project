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
        Schema::create('album', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('artist_id')->constrained('users')->references('id');
            $table->string('name');
            $table->string('photo');
            $table->text('description');
            $table->integer('price')->nullable()->default(null);
            $table->integer('stock')->nullable()->default(null);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album');
    }
};
