<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchBar extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'profile_photo_url'=>$this->profile_photo_url,
            'isFriend'=>$this->isFriendWith(auth('sanctum')->user()),
            'Tohim'=>auth('sanctum')->user()->hasSentFriendRequestTo(User::find($this->id)),
            'Tome'=>$this->hasSentFriendRequestTo(auth('sanctum')->user()),
        ];
    }
}
