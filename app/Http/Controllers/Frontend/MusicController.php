<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Album;

class MusicController extends Controller
{
    public function index()
    {
        $musics = Music::with('album')->latest()->get();
        $albums = Album::with('musics')->latest()->get();

        return view('frontend.music.index', compact('musics', 'albums'));
    }
}