<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
   public function index() {
        $userId = Auth::id();
        $messages = Message::where('sender_id', $userId)
                        ->orWhere('recipient_id', $userId)
                        ->latest()
                        ->get();
        return view('messages.index', compact('messages'));
    }

    public function store(Request $request) {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $request->recipient_id,
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Message sent.');
    }

    public function show($id) {
        $message = Message::findOrFail($id);
        // Only allow sender or recipient to view
        if (!in_array(Auth::id(), [$message->sender_id, $message->recipient_id])) {
            abort(403);
        }
        // mark as read
        if ($message->recipient_id == Auth::id() && !$message->read_at) {
            $message->update(['read_at' => now()]);
        }
        return response()->json($message);
    }

    public function destroy($id) {
        $message = Message::findOrFail($id);
        // Only allow sender to delete
        if ($message->sender_id != Auth::id()) {
            abort(403);
        }
        $message->delete();
        return redirect()->back()->with('success', 'Message deleted.');
    }
}
