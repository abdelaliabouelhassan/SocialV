<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CommentCollection extends JsonResource
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
            'replay'=>CommentReplayCollection::collection($this->replay),
            'created_at'=>$this->created_at,
        ];
    }
}
