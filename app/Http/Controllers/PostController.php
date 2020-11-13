<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Models\PostUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts =  Post::latest()->orderBy('id')->paginate(100);
     return  PostCollection::collection($posts);
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
    public function store(Request $request)
    {
      //create post
        if($request->body == "" && count( $request->image) == 0 &&  count( $request->video) == 0){
            return response()->json('Inputs Can Not Be Empty !!',402);
        }

       $post =  Post::create([
            'body'=>$request->body,
            'user_id'=>auth('sanctum')->id()
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
                            'post_id'=>$post->id
                        ]);
//                        Storage::disk('public')->putFileAs('/SocialVFiles'.DIRECTORY_SEPARATOR.'PostsFiles'.DIRECTORY_SEPARATOR,$img,$name);
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
                    'post_id'=>$post->id
                ]);

            }
        }

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
