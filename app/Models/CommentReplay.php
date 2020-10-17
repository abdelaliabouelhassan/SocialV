<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReplay extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function comment(){
        return $this->belongsTo('App\Models\Comment','comment_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
