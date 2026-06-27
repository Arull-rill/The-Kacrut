<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('musics')->latest()->get();
        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.albums.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'release_year' => 'nullable|integer|min:1900|max:2099',
            'description'  => 'nullable|string',
            'cover'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'release_year', 'description']);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('albums/covers', 'public');
        }

        Album::create($data);

        return redirect()->route('admin.albums.index')
                         ->with('success', 'Album berhasil ditambahkan!');
    }

    public function edit(Album $album)
    {
        $album->load('musics');
        return view('admin.albums.form', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'release_year' => 'nullable|integer|min:1900|max:2099',
            'description'  => 'nullable|string',
            'cover'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'release_year', 'description']);

        if ($request->hasFile('cover')) {
            if ($album->cover) Storage::disk('public')->delete($album->cover);
            $data['cover'] = $request->file('cover')->store('albums/covers', 'public');
        }

        $album->update($data);

        return redirect()->route('admin.albums.index')
                         ->with('success', 'Album berhasil diupdate!');
    }

    public function destroy(Album $album)
    {
        if ($album->cover) Storage::disk('public')->delete($album->cover);
        $album->delete();

        return redirect()->route('admin.albums.index')
                         ->with('success', 'Album berhasil dihapus!');
    }
}