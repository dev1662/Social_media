<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;
class Comments extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
