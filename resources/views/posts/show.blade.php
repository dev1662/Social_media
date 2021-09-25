@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row">
       <div class="col-8">
       <img src="/storage/{{$post->image}}" class="w-100" alt="">
       </div>
       <div class="col-4">
           <div class="d-flex align-items-baseline">
               <div class="pr-4">
                   <img src="{{$post->user->profile->profileImage()}}" style="max-width: 60px;" class="rounded-circle w-100" alt="">
                </div> &emsp;
                <div class="font-weight-bold"><a href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username}}</span> </a></div>
                <ul class="navbar-nav ml-auto">

           <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Delete <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="/p/{{$post->id}}/delete" class="dropdown-item">{{ __('Delete Post')}}</a>
                                    <!-- <a class="dropdown-item" href="{{ route('logout') }}"   
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a> -->
</ul>
           </div>
           <hr>
           <p><span class="font-weight-bold"><a href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username}}</span></a> </span >  &emsp;{{ $post->caption}} </p>
           
       </div>
   </div>
</div>
@endsection