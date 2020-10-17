<?php

namespace App\Http\Controllers;

use App\Events\commentTyping;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentReplayCollection;
use App\Models\Comment;
use App\Models\CommentReplay;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $i = 5;

    public function loadMoreComment(Request $request){

        $comment = Comment::latest()->orderBy('id')->where('post_id',$request->post_id)->paginate($request->loadmoreNumber);
     return   CommentCollection::collection($comment);
    }


    public function store(Request $request)
    {
       $request->validate([
           'comment'=>'required',
           'post_id'=>'required'
       ]);

       Comment::create([
            'body'=>$request->comment,
            'post_id'=>$request->post_id,
            'user_id'=>auth('sanctum')->id(),
       ]);
        $comment = Comment::latest()->orderBy('id')->where('post_id',$request->post_id)->paginate(1);
         broadcast(new commentTyping(CommentCollection::collection($comment),$request->post_id,'comment'));
        return response()->json('Created Successfully',200);

    }


    public function storeReplay(Request $request){
        $request->validate([
            'comment_id'=>'required',
            'replay'=>'required'
        ]);
       CommentReplay::create([
          'comment_id'=>$request->comment_id,
           'body'=>$request->replay,
           'user_id'=>auth('sanctum')->id(),
       ]);
        $commentReplay = CommentReplay::latest()->orderBy('id')->where('comment_id',$request->comment_id)->paginate(1);
        broadcast(new commentTyping(CommentReplayCollection::collection($commentReplay),$request->comment_id,'replay'));

        return response()->json('Created Successfully',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
