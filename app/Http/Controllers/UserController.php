<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

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

    public function UpdateInfo(Request $request){

   
         $user =    User::find(auth('sanctum')->id());
         $user->update([
            "name"=>$request->name,
            "gender"=>$request->gender,
            "maritalstatus"=>$request->maritalstatus,
            "dateofbirth"=>$request->dateofbirth,
            "city"=>$request->city,
            "country"=>$request->country,
            "address"=>$request->address

         ]);


         return response()->json('Your Info Updated Successfully',200);
    }

       public function UpdateProfileImage(Request $request){
        $name = time() . uniqid() . '.'  . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        $img =   Image::make($request->image);
        $img->save(public_path('uploads' . DIRECTORY_SEPARATOR . 'SocialVFiles' . DIRECTORY_SEPARATOR . 'UsersFiles' . DIRECTORY_SEPARATOR) . $name);
        $path = '/uploads/SocialVFiles/UsersFiles/' . $name;
        $user =    User::find(auth('sanctum')->id());
        $user->update([
            "profile_photo_path" => $path,   
        ]);

        return response()->json('Your Profile Image Updated Successfully', 200);

    }

    public function ChangePassword(Request $request){
        $user =    User::find(auth('sanctum')->id());
        if (!Hash::check($request->user["current_password"], $user->password)) {
            return response()->json(__('The provided password does not match your current password.'), 400);
        }
        if($request->user["password"] != "" && $request->user["repassword"] != ""){
            if ($request->user["password"] == $request->user["repassword"]) {
                $user->password = Hash::make($request->user["password"]);
                $user->save();
                return response()->json('Your Password Updated Successfully', 200);
            } else {
                return response()->json('The Password not match', 403);
            }
        }
        return response()->json('opsssss ! XoX', 404);
       
        
    }

}
