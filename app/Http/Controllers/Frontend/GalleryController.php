<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Gallery::where('type', 'photo')->latest()->get();
        $videos = Gallery::where('type', 'video')->latest()->get();

        return view('frontend.gallery.index', compact('photos', 'videos'));
    }
}