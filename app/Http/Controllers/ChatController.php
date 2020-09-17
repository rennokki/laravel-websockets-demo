<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Send the message to chat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        SendMessage::broadcast(
            $request->message, $request->user()
        )->toOthers();

        return response()->json(['ok' => true]);
    }
}
