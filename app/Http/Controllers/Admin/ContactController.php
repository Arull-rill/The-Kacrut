<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.contact.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);
        return view('admin.contact.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Pesan berhasil dihapus.');
    }
}