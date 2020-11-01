<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Http\Resources\GetMessage;
use App\Models\Chat;
use App\Models\PostUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class ChatController extends Controller
{
    //
    public function SendMessage(Request $request){

        $attachmet = null;
        if($request->image || $request->video){
            $attachmet = "yes";
        }

        $chat =  Chat::create([
            'from'=>auth('sanctum')->id(),
            'to'=>$request->to,
            'type'=>$request->type,
            'message'=>$request->message,
            'attachment'=>$attachmet,
            'read'=>null
        ]);


        //upload fils
        /*if file is image*/
        if($request->image){
            foreach ($request->image as $img){
                $name = time() . uniqid() . '.'  . explode('/',explode(':',substr($img,0,strpos($img,';')))[1])[1];
                $img =   Image::make($img);
                $img->save(public_path('uploads'.DIRECTORY_SEPARATOR.'SocialVFiles'.DIRECTORY_SEPARATOR.'PostsFiles'.DIRECTORY_SEPARATOR).$name);
                $path = '/uploads/SocialVFiles/PostsFiles/' .$name;
                PostUpload::create([
                    'path'=>$path,
                    'type'=>'image',
                    'post_id'=>$chat->id
                ]);
            }
        }
        /*if file is video*/
        if($request->video){
            foreach ($request->video as $vid){
                $name = time() . '.'  . explode('/',explode(':',substr($vid,0,strpos($vid,';')))[1])[1];
                Storage::disk('public')->putFileAs('/SocialVFiles'.DIRECTORY_SEPARATOR.'PostsFiles'.DIRECTORY_SEPARATOR, $vid,$name);
                $path = '/uploads/SocialVFiles/PostsFiles/' .$name;

                PostUpload::create([
                    'path'=>$path,
                    'type'=>'video',
                    'post_id'=>$chat->id
                ]);

            }
        }
        $message = [
            'id'=>$chat->id,
            'to'=>$chat->to,
            'from'=>$chat->from,
            'message'=>$chat->message,
            'type'=>$chat->type,
            'attachment'=>$chat->attachment,
            'attachments'=>$chat->attachments,
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


    public function MessageSeen(Request $request){
        $message =   Chat::find($request->message_id);
        $message->read = now();
        $message->save();
        return response()->json($message,200);
    }
}
