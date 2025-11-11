<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class MessageController extends Controller
{
    // Show all messages in the admin dashboard
    public function index()
    {
        // latest messages first, paginated 10 per page
        $messages = Contact::latest()->paginate(10);

        return view('admin.messages.index', compact('messages'));
    }

    // Optional: show a single message
    public function show(Contact $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    // Optional: delete a message
    public function destroy(Contact $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }
}
