<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Notifications\NotifyLikedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    //
    public function get(){
        $notification=  Auth::user()->unreadNotifications;
        //  dd($notification);
        // $user= Auth::user();

        // Notification::send( new NotifyLikedPost($notification, $user));
        return $notification;
    }
    public function read(Request $request){
        Auth::user()->unreadNotifications->find($request->id)->markAsRead();
        return 'success';
    }
}
