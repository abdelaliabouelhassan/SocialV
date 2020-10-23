<?php

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test',function (){

    $user1 = User::find(1);
    $user2 = User::find(3);

   $user1->befriend($user2);
 return   $user2->getFriends();
//  return  $user1->getAllFriendships();

//      $user1->hasSentFriendRequestTo($user2);

//    $user2->acceptFriendRequest($user1);
//    $user1->unfriend($user2);
//    $user1->blockFriend($user2);
//    $user1->unblockFriend($user2);
//    $user1->isFriendWith($user2);



});


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');


Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('{path}',function (){
    return view('dashboard');
})->where('path','[a-zA-Z0-9-/]+');
