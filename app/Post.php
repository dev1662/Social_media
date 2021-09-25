<?php

namespace App;
use App\User;
// use App\likes;
use App\Comments;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $guarded = [];
    
    public function likers(){
        return $this->belongsTo(User::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function likes(){
        return $this->hasMany('App\likes');
    }
    public function comments(){
        return $this->hasMany(Comments::class);
    }
}
