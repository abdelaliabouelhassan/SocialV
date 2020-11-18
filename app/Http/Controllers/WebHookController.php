<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WebHookController extends Controller
{
    public  function handel(Request $request){
        $data =  $request->events;
        $user_id = "";
        $type= "";
        foreach ($data as $userinfo){
            $user_id =  $userinfo['user_id'];
            $type = $userinfo["name"];
        }
        if($type == 'member_removed'){
            $user = User::find($user_id);
            $user->status = 'offline';
            $user->last_online = now();
            $user->save();
        }
        if($type == "member_added"){
            $user = User::find($user_id);
            $user->status = 'online';
            $user->last_online = now();
            $user->save();
        }
        return response()->json('greate',200);
    }
}
