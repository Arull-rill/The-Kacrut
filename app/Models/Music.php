<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $table = 'musics'; // ← TAMBAH INI

    protected $fillable = [
        'album_id',
        'title',
        'cover',
        'audio_file',
        'spotify_embed',
        'youtube_embed',
        'apple_music_url',
        'is_downloadable',
    ];

    protected $casts = [
        'is_downloadable' => 'boolean',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}