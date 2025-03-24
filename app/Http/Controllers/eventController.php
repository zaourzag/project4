<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageBroadcasted;

class EventController extends Controller
{
    public function broadcastEvent(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'state' => 'required|string',
            'message' => 'required|string',
        ]);

        // Broadcast the event
        broadcast(new MessageBroadcasted($request->state, $request->message));

        return response()->json(['success' => true, 'message' => 'Event broadcasted successfully']);
    }
}