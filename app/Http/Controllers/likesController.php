<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class likesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(User $user){
        return auth()->user()->likes()->toggle($user->posts);
    }
}
