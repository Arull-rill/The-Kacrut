<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Gallery;
use App\Models\Merchandise;

class HomeController extends Controller
{
    public function index()
    {
        $latestMusics = Music::latest()->take(3)->get();
        $galleries = Gallery::latest()->take(6)->get();
        $merchandises = Merchandise::where('is_available', true)->take(4)->get();

        return view('frontend.home.index', compact(
            'latestMusics',
            'galleries',
            'merchandises'
        ));
    }
}