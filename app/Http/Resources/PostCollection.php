<?php

namespace App\Http\Resources;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PostCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'user'=>$this->user,
            'body'=>$this->body,
            'files'=>$this->attachment,
            'comments'=> CommentCollection::collection(Comment::latest()->orderBy('id')->where('post_id',$this->id)->paginate(5)),
            'likes'=> LikeCollection::collection(Like::latest()->orderBy('id')->where('post_id',$this->id)->paginate(15)),
            'likeCount'=>count(LikeCollection::collection($this->likes)),
            'isLiked'=>count(Like::where('user_id',auth('sanctum')->id())->where('post_id',$this->id)->get()) == 0 ? false:true,
            'commentCount'=>count(CommentCollection::collection($this->comments)),
            'loadmoreNumber'=>5,
            'created_at'=>$this->created_at,
        ];
    }
}
