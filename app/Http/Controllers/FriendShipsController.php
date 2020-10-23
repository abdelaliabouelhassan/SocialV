<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendShipsController extends Controller
{
    public function send_a_friend_request(Request $request){
        $sender = auth('sanctum')->user();
        $recipient =   User::find($request->user_id);
        $sender->befriend($recipient);
        return response()->json('Request Sent Successfully',200);
    }
}
