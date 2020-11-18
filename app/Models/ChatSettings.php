<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSettings extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function  lastMsg(){
        return $this->belongsTo('App\Models\Chat','last_msg_id');
    }
}
