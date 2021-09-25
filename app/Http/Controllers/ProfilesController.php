<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use App\Post;


class ProfilesController extends Controller
{
     public function index(User $user)
    {
        $follows= (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $profileId=auth()->user()->profile->id; 
        // $profileid= $user->profile->id;

        $postCount= Cache::remember('count.posts.'. $user->id, now()->addSeconds(30), function() use ($user){
            return $user->posts->count();
        });
        $followersCount = Cache::remember('count.followers.'. $user->id, now()->addSeconds(30), function() use ($user){
            return $user->profile->followers->count();
        });
        $followingCount = Cache::remember('count.following.'. $user->id, now()->addSeconds(30), function() use ($user){
            return $user->following->count();
        });
        $post= Post::with('comments')->get();
        return view('profiles/index', compact('user', 'follows', 'profileId',  'postCount', 'followersCount', 'followingCount','post'));
        
    }
    public function edit(User $user){
        $this->authorize('update', $user->profile);
        return view('profiles/edit', compact('user'));
    }
    public function update(User $user){
        $this->authorize('update', $user->profile);
        $data= request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url   ',
            'profile' => '',
        ]);
        if(request('profile')){
            $imagepath= (request('profile')->store('profile', 'public'));
            $image = Image::make(public_path("storage/{$imagepath}"))->fit(1000, 1000);
            $image->save();
            $imageArray=  ['profile' => $imagepath];
        }
       
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        return redirect("/profile/{$user->id}");
    }
}
