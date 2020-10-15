<?php

namespace App\Http\Resources;

use App\Models\Like;
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
            'comments'=> CommentCollection::collection($this->comments),
            'likes'=> LikeCollection::collection($this->likes),
            'likeCount'=>count(LikeCollection::collection($this->likes)),
            'isLiked'=>count(Like::where('user_id',auth('sanctum')->id())->where('post_id',$this->id)->get()) == 0 ? false:true,
            'commentCount'=>count(CommentCollection::collection($this->comments)),
            'created_at'=>Carbon::createFromFormat('Y-m-d H:i:s',$this->created_at)->diffForHumans(),
        ];
    }
}
