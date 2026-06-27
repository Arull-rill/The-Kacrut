<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Album;
use App\Models\Gallery;
use App\Models\Merchandise;
use App\Models\Order;
use App\Models\ContactMessage;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'musics'       => Music::count(),
            'albums'       => Album::count(),
            'galleries'    => Gallery::count(),
            'merchandises' => Merchandise::count(),
            'orders'       => Order::count(),
            'messages'     => ContactMessage::where('is_read', false)->count(),
            'users'        => User::count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentOrders   = Order::with('merchandise')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'recentMessages', 'recentOrders'));
    }
}