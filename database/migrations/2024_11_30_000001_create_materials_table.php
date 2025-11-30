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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('section_number'); // e.g., "1.1", "1.2"
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('youtube_url'); // YouTube video URL or ID
            $table->integer('order')->default(0); // For ordering materials
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
