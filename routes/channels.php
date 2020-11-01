<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('Likes', function ($user) {
    return auth('sanctum')->check();
});

Broadcast::channel('CommentTyping', function ($user) {
    return auth('sanctum')->check();
});

Broadcast::channel('SendFriendRequest', function ($user) {
    return auth('sanctum')->check();
});
Broadcast::channel('chat',function ($user){
    return $user;
});

Broadcast::channel('ChatMessages.{id}',function ($user){
    return auth('sanctum')->check();
});

//Broadcast::channel('ChatVedioCall.{id}',function ($user){
//    return auth('sanctum')->check();
//});
Broadcast::channel('VedioCallRuning.{id}',function ($user){
    return auth('sanctum')->check();
});
