<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->get('/LoadPosts','PostController@index');
Route::middleware('auth:sanctum')->post('/CreatePost','PostController@store');
Route::middleware('auth:sanctum')->post('/CreateComment','CommentController@store');
Route::middleware('auth:sanctum')->post('/CreateCommentReplay','CommentController@storeReplay');
Route::middleware('auth:sanctum')->post('/LoadMoreComment','CommentController@loadMoreComment');
Route::middleware('auth:sanctum')->post('/LikePost','LikeController@store');
Route::middleware('auth:sanctum')->post('/Translate','TranslateController@TranslateText');
Route::middleware('auth:sanctum')->post('/Search','SearchController@SearchBar');
Route::middleware('auth:sanctum')->post('/AddFriend','FriendShipsController@send_a_friend_request');
Route::middleware('auth:sanctum')->post('/CancelRequest','FriendShipsController@Cancel_a_friend_request');
Route::middleware('auth:sanctum')->get('/LoadFriendRequests','FriendShipsController@LoadFriendRequests');
Route::middleware('auth:sanctum')->post('/DeleteRequest','FriendShipsController@DeleteRequest');
Route::middleware('auth:sanctum')->post('/ConfirmRequest','FriendShipsController@ConfirmRequest');
Route::middleware('auth:sanctum')->post('/UnFriend','FriendShipsController@UnFriend');
Route::middleware('auth:sanctum')->get('/getFriends','FriendShipsController@getFriends');
Route::middleware('auth:sanctum')->post('/SetUserOnline','UserController@SetUserOnline');
Route::middleware('auth:sanctum')->post('/SetUserOffline','UserController@SetUserOffline');
Route::middleware('auth:sanctum')->post('/SendMessage','ChatController@SendMessage');
Route::middleware('auth:sanctum')->post('/GetMessage','ChatController@getMessage');
Route::middleware('auth:sanctum')->post('/MessageSeen','ChatController@MessageSeen');
Route::middleware('auth:sanctum')->post('/DeleteChat','ChatController@DeleteChat');
Route::middleware('auth:sanctum')->post('/removeMsg','ChatController@removeMsg');
Route::middleware('auth:sanctum')->post('/DeleteForEveryone','ChatController@DeleteForEveryone');
Route::middleware('auth:sanctum')->get('/GetMessageNotification','ChatController@GetMessageNotification');
Route::middleware('auth:sanctum')->get('/Getcountries', 'AppGeneralApiController@Getcountries');
Route::middleware('auth:sanctum')->get('/Getcities/{name}', 'AppGeneralApiController@Getcities');
Route::middleware('auth:sanctum')->post('/UpdateInfo', 'UserController@UpdateInfo');
Route::middleware('auth:sanctum')->post('/UpdateProfileImage', 'UserController@UpdateProfileImage');
Route::middleware('auth:sanctum')->post('/ChangePassword', 'UserController@ChangePassword');