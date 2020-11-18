<?php

namespace App\Http\Resources;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class GetMessageNotification extends JsonResource
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
           'message'=>$this->lastMsg->message,
           'isread'=>$this->lastMsg->read,
            'to'=>$this->lastMsg->to,
            'type'=>$this->lastMsg->type,
            'attachment'=>$this->lastMsg->attachment,
            'who'=>$this->lastMsg->who,
            'ismy'=>auth('sanctum')->id() == $this->lastMsg->from ? true : false,
            'created_at'=>$this->lastMsg->created_at,
            'user'=>$this->lastMsg->from == auth('sanctum')->id() ? User::findOrFail($this->lastMsg->to) : User::findOrFail($this->lastMsg->from),
        ];
    }
}
