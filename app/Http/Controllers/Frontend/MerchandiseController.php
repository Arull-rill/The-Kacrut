<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;

class MerchandiseController extends Controller
{
    public function index()
    {
        $merchandises = Merchandise::where('is_available', true)->latest()->get();

        return view('frontend.merchandise.index', compact('merchandises'));
    }
}