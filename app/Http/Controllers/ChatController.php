<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Http\Resources\GetMessage;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ChatController extends Controller
{
    //
    public function SendMessage(Request $request){
       $chat =  Chat::create([
             'from'=>auth('sanctum')->id(),
             'to'=>$request->to,
             'type'=>$request->type,
             'message'=>$request->message,
             'attachment'=>null,
             'read'=>null
        ]);
       $message = [
           'id'=>$chat->id,
           'to'=>$chat->to,
           'from'=>$chat->from,
           'message'=>$chat->message,
           'type'=>$chat->type,
           'attachment'=>$chat->attachment,
           'read'=>$chat->read,
           'created_at'=>Carbon::createFromFormat('Y-m-d H:i:s',$chat->created_at)->diffForHumans(),
       ];
        broadcast(new MessageEvent($message));
        return response()->json($message,200);
    }


    public function getMessage(Request $request){
      $message =   GetMessage::collection(Chat::whereIn('from', [auth('sanctum')->id(), $request->user_id])
          ->whereIn('to', [auth('sanctum')->id(), $request->user_id])->latest()->orderby('id','DESC')->paginate(50));

    return $message;

    }
}
