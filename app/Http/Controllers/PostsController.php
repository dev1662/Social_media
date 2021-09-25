<?php

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;
use App\Notifications\NotifyLikedPost;
use Illuminate\Support\Facades\Cache;
use App\Profile;
// use App\Comments;
use App\likes;

use App\Notifications\PostLikes;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        
        $users= auth()->user()->following()->pluck('profiles.user_id');
        // $user= auth()->user()->likes()->pluck('profiles.user_id');
        
        $posts = Post::with('likes')->whereIn('user_id', $users)->with('user')->get();
        // $comments= Comments::latest()->get();
        // $likes= (auth()->user()) ? auth()->user()->likes->contains(Auth::user()->id) : false;
        
        // $user  = Auth::user();
        // $likesCount = Cache::remember('count.likes.'. Auth::user()->id, now()->addSeconds(30), function() use ($user){
        //     return $user->likes->count();
        // });
        //dd($likesCount);
        // $post = Post::whereIn('user_id', $user)->with('user')->latest()->get();
        // dd($posts[0]->comments);
        return view('posts.index', compact('posts', 'likes'));


        
    }
    public function create(){
        return view('posts.create');
    }

    public function store(){
        $data=request()->validate([
            'caption' => 'required',
            'image'  =>  ['required', 'image'],
        ]);
        
        $imagepath= (request('image')->store('uploads', 'public'));
        $image = Image::make(public_path("storage/{$imagepath}"))->fit(1100, 900);
        $image->save();
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagepath
        ]);
        return redirect('/profile/'. auth()->user()->id);
    }
    public function show(\App\Post $post){
        $comments= Comments::get();
        return view('posts.show', compact('post', 'comments'));
    }
    public function destroy(Post $post){
        // $this->authorize('delete', $user->post);
        $post= Post::with('comments')->delete();
        
        return redirect('/profile/'. auth()->user()->id);
        return view('posts.show', compact('post'));

    }
    public function saveLike(request $request){
        // return $request->all();
        $likecheck= likes::where(['user_id'=> Auth::id(), 'post_id'=> $request->id])->first();
        if($likecheck){
            likes::where(['user_id'=> Auth::id(), 'post_id'=> $request->id])->delete();
            return 'deleted';
        }else{

            $likes= new likes;
            $likes->user_id= Auth::id();
            $likes->post_id= $request->id;
            $likes->save();
            $post = Post::find($request->id);
            $user=Auth::user();
            $post->user->notify(new PostLikes($post, $user, $likes));

        }

    }
    // public function savecomment(request $request){
    //     $comments = new Comments;
    //     $comments->user_id= Auth::id();
    //     $comments->post_id= $request->id;
    //     $comments->save();
    // }
  
}
