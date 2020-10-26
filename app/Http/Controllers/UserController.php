<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function  SetUserOnline(Request $request)
    {
       $user = User::find($request->id);
       $user->status = 'online';
       $user->save();
        return response()->json('online',200);
    }
    public function  SetUserOffline(Request $request)
    {
        $user = User::find($request->id);
        $user->status = 'offline';
        $user->save();
        return response()->json('offline',200);
    }

}
