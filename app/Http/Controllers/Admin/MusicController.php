<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    public function index()
    {
        $musics = Music::with('album')->latest()->get();
        return view('admin.music.index', compact('musics'));
    }

    public function create()
    {
        $albums = Album::latest()->get();
        return view('admin.music.form', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'album_id'   => 'nullable|exists:albums,id',
            'cover'      => 'nullable|image|max:2048',
            'audio_file' => 'nullable|mimes:mp3,wav,ogg|max:20480',
            'spotify_embed'   => 'nullable|url',
            'youtube_embed'   => 'nullable|url',
            'apple_music_url' => 'nullable|url',
        ]);

        $data = $request->only([
            'title', 'album_id',
            'spotify_embed', 'youtube_embed', 'apple_music_url'
        ]);

        $data['is_downloadable'] = $request->has('is_downloadable');

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('music/covers', 'public');
        }

        if ($request->hasFile('audio_file')) {
            $data['audio_file'] = $request->file('audio_file')->store('music/audio', 'public');
        }

        Music::create($data);

        return redirect()->route('admin.music.index')
                         ->with('success', 'Lagu berhasil ditambahkan!');
    }

    public function edit(Music $music)
    {
        $albums = Album::latest()->get();
        return view('admin.music.form', compact('music', 'albums'));
    }

    public function update(Request $request, Music $music)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'album_id'   => 'nullable|exists:albums,id',
            'cover'      => 'nullable|image|max:2048',
            'audio_file' => 'nullable|mimes:mp3,wav,ogg|max:20480',
            'spotify_embed'   => 'nullable|url',
            'youtube_embed'   => 'nullable|url',
            'apple_music_url' => 'nullable|url',
        ]);

        $data = $request->only([
            'title', 'album_id',
            'spotify_embed', 'youtube_embed', 'apple_music_url'
        ]);

        $data['is_downloadable'] = $request->has('is_downloadable');

        if ($request->hasFile('cover')) {
            if ($music->cover) Storage::disk('public')->delete($music->cover);
            $data['cover'] = $request->file('cover')->store('music/covers', 'public');
        }

        if ($request->hasFile('audio_file')) {
            if ($music->audio_file) Storage::disk('public')->delete($music->audio_file);
            $data['audio_file'] = $request->file('audio_file')->store('music/audio', 'public');
        }

        $music->update($data);

        return redirect()->route('admin.music.index')
                         ->with('success', 'Lagu berhasil diupdate!');
    }

    public function destroy(Music $music)
    {
        if ($music->cover) Storage::disk('public')->delete($music->cover);
        if ($music->audio_file) Storage::disk('public')->delete($music->audio_file);

        $music->delete();

        return redirect()->route('admin.music.index')
                         ->with('success', 'Lagu berhasil dihapus!');
    }
}