<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return response()->json(['data' => Message::where('receiver_id', Auth::id())
            ->with('user')
            ->get()
        ]);
    }

    public function sendMessage(Request $request, $id)
    {
        $user = User::findOrFail($id);

        /** @var Message $message */
        $message = $user->messages()->create([
            'receiver_id' => $id,
            'sender_id' => Auth::id(),
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($message));
        return ['status' => 'Message Sent!'];
    }
}
