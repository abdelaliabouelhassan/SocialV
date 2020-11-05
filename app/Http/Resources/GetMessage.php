<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class GetMessage extends JsonResource
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
          'to'=>$this->to,
          'from'=>$this->from,
          'message'=>$this->message,
          'type'=>$this->type,
          'attachment'=>$this->attachment,
          'attachments'=>$this->attachments,
          'read'=>$this->read,
          'created_at'=>$this->created_at,


        ];
    }
}
