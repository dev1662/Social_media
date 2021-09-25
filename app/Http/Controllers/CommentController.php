<?php

namespace App\Http\Controllers;

use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Post;
use App\Comments;
use App\Notifications\NotifyLikedPost;
use App\Post;
use App\User;
use Symfony\Component\HttpKernel\Event\ViewEvent;

// use App\User;
// use Illuminate\Contracts\Session\Session;

class CommentController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('auth');
    }
  
    public function create(){
        // return view('posts.index');

    }
    public function store(request $request){
    //    $this->validate($request, array(
    //         'comment'=> 'required',
    //    ));
   
    // dd($request->comments);
    $comment= new Comments;
    $comment->comments = $request->comments;
    $comment->post_id = $request->postid;
    $comment->user_id = $request->userid;
    
    $comment->save();
    
    $post = Post::find($request->postid);
    $user = Auth::user();
    // $comment = Comments::find($request->comments);
    $post->user->notify(new NotifyLikedPost($post,  $user , $comment));


    // $user = Auth::user();
    // $comment->user->notify(new NotifyLikedPost($comment, $user));
    // $user = User::find($request->userid);
    // $post = Post::find($request->postid);
    // $user->post->notify(new NotifyLikedPost($user, $post));


    // User::find($request->userid)->notify(new NotifyLikedPost($post, $user));
    return redirect()->back();
        // $comment->save();
        // auth()->user()->comments()->create([
        //     'comment' => $data['comment']
        // ]);
    }
    public function show(\App\Comments $comments, User $user){
        $post = Post::with('comments')->get();
        $follows= (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $profileId=auth()->user()->profile->id; 
        // return view('posts.comment', compact( 'comments','post'));
        return view('posts.comment', compact( 'comments','post','follows','profileId','user'));
    }
    public function destroy(\App\Comments $comments){
        $comments->delete();
        return redirect()->back();
        return view('posts.index', compact('comments'));
    }
}
