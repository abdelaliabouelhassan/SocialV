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
