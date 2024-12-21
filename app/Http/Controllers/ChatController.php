<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, ['title' => 'required']);
        $data=Chat::create([
           'user_id' => $request->user->id,
           'title'=>$request->title
        ]);
        return response()->json([
            'message' => 'Create successfully',
            'data' => $data,
        ], 200);
    }
    public function create_message(Request $request)
    {
        $this->validate($request, ['message' => 'required','chat_id'=>'required']);
        $data=Message::create([
           'message' => $request->message,
           'sender_id' => $request->user->id,
           'chat_id' => $request->chat_id,
           'seen'=>0
        ]);
        return response()->json([
            'message' => 'Create successfully',
            'data' => $data,
        ], 200);
    }
    public function chats(Request $request)
    {
        $data=Chat::where('user_id',$request->user->id)->get();
        return response()->json([
            'message' => 'successfully',
            'data' => $data,
        ], 200);
    }
    public function setting()
    {
        $data=Setting::first();
        return response()->json([
            'message' => 'successfully',
            'data' => $data,
        ], 200);
    }

    public function messages(Request $request)
    {
        $this->validate($request, ['chat_id'=>'required']);
        $data=Chat::where('id',$request->chat_id)->where('user_id',$request->user->id)->with('messages')->first();
        return response()->json([
            'message' => 'successfully',
            'data' => $data,
        ], 200);
    }
}
