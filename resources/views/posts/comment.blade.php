



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media</title>
    <script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div id="app">

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" 
    style="background-color:white!important;">
        <div class="container" >
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                <div ><strong> <img src="/image/talkup.png" style="
                height:30px;
                 border-right: 1px solid #333;
                 " width="100%"  class="pr-3"></strong></div>
                  <div class="pl-3 pt-1"> <strong>Social Media </strong></div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><strong style="font-size:20px;">{{ __('Login') }}</strong></a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><strong style="font-size: 20px; ">{{ __('Register') }}</strong></a>
                                </li>
                                @endif
                                @else
                                
                                <a href="/">
                                
                                
                                <img class="pr-4 pt-2"  src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/40/000000/external-home-finance-kiranshastry-solid-kiranshastry.png"/>
                            </a>
                            <notification v-bind:notifications='notifications'></notification>
                            
                            <a href="/p/create"> 
                            <img class="pr-4 pt-2" src="https://img.icons8.com/ios-glyphs/40/000000/add--v2.png"/>
                        </a>



                        


                            <li class="nav-item dropdown">
                               <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <b style="font-size: 18px;"> <img src="{{ Auth::user()->profile->profileImage() }}" style="max-width: 40px;
                             " class="rounded-circle w-100 " alt=""></b> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="/profile/{{Auth::user()->id}}" class="dropdown-item">{{ __('Profile')}}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"   
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
        
            </div>
</nav>


<div class="container pt-4">
    <div class="row">
        <div class="col-8">
        <img src="/storage/{{$comments->post->image}}" class="w-100" alt="">
         
        </div>
        <div class="col-4">
           <div class="d-flex align-items-baseline">
               <div class="pr-4">
                   <img src="{{$comments->post->user->profile->profileImage()}}" style="max-width: 60px;" class="rounded-circle w-100" alt="">
                </div> &emsp;
                <div class="font-weight-bold"><a href="/profile/{{$comments->post->user->id}}"><span class="text-dark">{{ $comments->post->user->username}}</span>        
 </a>
 
</div>
                <ul class="navbar-nav ml-auto">

           <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Delete <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="/p/{{$comments->post->id}}/delete" class="dropdown-item">{{ __('Delete Post')}}</a>
                              
</ul>
           </div>
           <hr>
           <p><span class="font-weight-bold"><a href="/profile/{{$comments->post->user->id}}"><span class="text-dark">{{ $comments->post->user->username}}</span></a> </span >  &emsp;{{ $comments->post->caption}} </p>
           <like-button :post-id= "{{$comments->post->id}}" :user-id="{{Auth::id()}}" :likes = "{{$comments->post->likes}}"    ></like-button>
           <br>
           <p style="color: grey;">{{$comments->post->created_at->diffforhumans()}}</p>
            <hr>
            <!-- <b>Comments:</b>    -->
            @foreach($comments->post->comments as $postc)
            <p><b>{{$postc->user->username}}</b>&emsp;{{$postc->comments}} 
            @if(Auth::id() === $postc->user->id)
                   <button class="btn btn-primary "  > <a  style="color: aliceblue; text-decoration:none;" href="/comment/{{$postc->id}}/delete">Delete</a></button>
                    
                    @endif
                    <br>
                    <!-- <button class="btn btn-primary " id="formButton" style="background-color:brown; border:2px solid brown;">Reply</button>
                    <form action="" style="display:none;" id="form1" >
                        <input type="hidden" name="commentid" value="">
                        <input type="hidden" name="userid" value="">
                      

                            <input type="text" name="reply" id="reply" value="{{ $postc->user->username}}" class="form-control">

                        
                    </form> -->
                    
                </p>
                <p style="color: grey;">{{$postc->created_at->diffforhumans()}}</p>
        @endforeach
        
           
            <form action="{{ route ('comment.add') }}" style=" align-items:baseline;" method="post" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="userid" value="{{Auth::id() }}">
                     <input type="hidden" name="postid" value="{{$comments->post->id}}">
                     <div  class="form-group d-flex " >
                                     <hr>
                                     <input type="text"  name="comments"  class="form-control "
                                        
                                          placeholder="Add a Comment">
     
     
                                 <!-- <input  type="text" name="comment" class="form-control"  -->
                                 <!-- <button  class="btn btn-primary">Post</button> -->
                                 <input type="submit" name="comment" value="Post" class="btn btn-primary">
                             </div>
     
                         </form>
       </div>
    </div>
</div>

<main class="py-4">
            @yield('content')
        </main>
        </div>    
</body>
</html>