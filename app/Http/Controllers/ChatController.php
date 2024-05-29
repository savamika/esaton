<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function loadview($userid, $name){
        $chathistory = DB::table('messages')->where('user_id', $userid)->orderBy('created_at', 'asc')->get()->toArray();
        return view('/chat/chat', ['userid' => $userid, 'name' => $name, 'chathistory' => $chathistory]);
    }

    public function getMessage($userid){
        return DB::table('messages')->where('user_id', $userid)->orderBy('created_at', 'asc')->get();
    }

    public function postMessage(Request $request)
    {
        $message = new Message();
        $message->user_id = $request->userid;
        $message->message = $request->message;
        $message->type       = $request->typeTo;
        $message->sent_from  = Auth::user()->role;
        $message->save();

        $chat = [
            'user_id' => $request->userid,
            'message' => $request->message,
            'type' => $request->typeTo,
            'sendFrom' => Auth::user()->role,
            'sendTime' => date('Y-m-d H:i:s'),
        ];

        MessageSent::dispatch($chat);

        return response()->json(['success' => true]);
    }
}
