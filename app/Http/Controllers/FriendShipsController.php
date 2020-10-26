<?php

namespace App\Http\Controllers;

use App\Events\FriendRequestEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendShipsController extends Controller
{
    public function send_a_friend_request(Request $request){
        $sender = auth('sanctum')->user();
        $recipient =   User::find($request->user_id);
        $sender->befriend($recipient);
        $user = [
            'id'=>auth('sanctum')->id(),
            'name'=>auth('sanctum')->user()->name,
            'image'=>auth('sanctum')->user()->profile_photo_url
        ];
        broadcast(new FriendRequestEvent($request->user_id,'request',$user))->toOthers();
        return response()->json('Request Sent Successfully',200);
    }
    public function Cancel_a_friend_request(Request $request){
        DB::delete('delete from friendships where sender_id = ? and recipient_id = ?',[auth('sanctum')->id(),$request->user_id]);
        return response()->json('Request Canceled Successfully',200);
    }

    public function DeleteRequest(Request $request){
        $user = auth('sanctum')->user();
        $sender = User::find($request->user_id);
        $user->denyFriendRequest($sender);
        $user = [
            'id'=>auth('sanctum')->id(),
            'name'=>auth('sanctum')->user()->name,
            'image'=>auth('sanctum')->user()->profile_photo_url
        ];
        broadcast(new FriendRequestEvent($request->user_id,'denied',$user))->toOthers();
        return response()->json('Request denied Successfully',200);
    }

    public  function  ConfirmRequest(Request $request){
        $user = auth('sanctum')->user();
        $sender = User::find($request->user_id);
        $user->acceptFriendRequest($sender);
        $user = [
            'id'=>auth('sanctum')->id(),
            'name'=>auth('sanctum')->user()->name,
            'image'=>auth('sanctum')->user()->profile_photo_url
        ];
        broadcast(new FriendRequestEvent($request->user_id,'accepted',$user))->toOthers();
        return response()->json('Request Accepted Successfully',200);
    }

    public function UnFriend(Request $request){
        $user = auth('sanctum')->user();
        $friend = User::find($request->user_id);
        $user->unfriend($friend);
        return response()->json('Un Friend Successfully',200);
    }

    public function LoadFriendRequests(){
          $user =auth('sanctum')->user();
            $user->getPendingFriendships();
            $data = [];
            foreach ($user->getFriendRequests() as $userPanding){
                        $pandinguser = User::where('id',$userPanding->sender_id)->first();
                        $users = [
                          'name'=>   $pandinguser->name,
                          'id'=> $pandinguser->id,
                          'image'=> $pandinguser->profile_photo_url,
                        ];

                array_push($data,$users);
              }
            return $data;
    }

    public function getFriends(){
        $user = auth('sanctum')->user();
      return  $user->getFriends();
    }
}
