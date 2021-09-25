<?php

namespace App;
use App\User;
// use App\Post;

use Illuminate\Database\Eloquent\Model;

class likes extends Model
{
    //
    public function user_likers(){
      return  $this->belongsTo(User::class);
    }
    public function post_likers(){
       return $this->belongsTo('App\Post','likes');
    }
}
