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
    Schema::create('musics', function (Blueprint $table) {
        $table->id();
        $table->foreignId('album_id')->nullable()->constrained()->nullOnDelete();
        $table->string('title');
        $table->string('cover')->nullable();
        $table->string('audio_file')->nullable();
        $table->string('spotify_embed')->nullable();
        $table->string('youtube_embed')->nullable();
        $table->string('apple_music_url')->nullable();
        $table->boolean('is_downloadable')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musics');
    }
};
