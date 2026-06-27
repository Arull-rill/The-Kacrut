<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'website_name' => 'required|string|max:255',
        ]);

        $keys = [
            'website_name', 'logo', 'banner',
            'instagram', 'facebook', 'whatsapp',
            'email', 'address', 'footer_text'
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        return back()->with('success', 'Settings berhasil disimpan.');
    }
}