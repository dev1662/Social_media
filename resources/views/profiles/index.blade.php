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



<div class="container">
  <div class="row">
      <div class="col-3 p-4 pl-4">
          <img src="{{$user->profile()->profileImage()}}" style="height: 220px;" class="rounded-circle w-100" alt="">
      </div>
      <div class="col-9 p-5 pl-5 " >
    <div class="pl-5 d-flex justify-content-between align-items-baseline">
       <div class="d-flex align-items-center pb-4">
         <div class="h4">{{$user->username}}</div >
        
        <follow-button user-id="{{$user->id}}" follows="{{$follows}}" v-show="{{ $profileId !== $user->id }}"></follow-button>
      </div>
     
      
        @can('update', $user->profile)
            <button  class=" btn btn-primary ">
              <a style="color:aliceblue; text-decoration:none;" href="/p/create">Add new Posts</a></button>
            @endcan
          </div>
          @can('update', $user->profile)

          <button style="margin-left:50px;" class=" btn btn-primary ">
          <a style="color:aliceblue;  text-decoration:none;" href="/profile/{{$user->id}}/edit">Edit Profile</a></button>
          
          @endcan
    <div class="pl-5 d-flex">
        <div class="pr-5" style="font-size:large ;"><strong>{{$postCount}}</strong> posts</div>
        <div class="pr-5" style="font-size:large ;"><strong>{{$followersCount}}</strong> followers</div>
        <div class="pr-5" style="font-size:large ;"><strong>{{$followingCount}}</strong> following</div>
    </div>
    <div class="pl-5 pt-4" style="font-size:large ;"><strong>{{ $user->profile->title }}</strong></div>
    <div class="pl-5" style="font-size:large ;">
    {{$user->profile->description}}
    </div>
    <div  class="pl-5 " style="font-size:large ;">
   <a href="{{$user->profile->url}}" target="_blank">{{$user->profile->url}}
    </a> </div>
  </div>
  </div>
  <div class="row ">
    @foreach($user->posts as $post)
    <div class="col-4  pb-4">
                @foreach($post->comments as $comment)
                <a href="/comment/{{$comment->id}}">
                @endforeach
                <img src="/storage/{{$post->image}}" class="w-100">
                </a>
              </div>
              
              
              @endforeach
            </div>
            
            <!-- <div class="row">
              <div class="col-4">
                      <img src="/image/photo3.jpg" class="w-100" alt="">
                    </div>
                  <div class="col-4">
                    <img src="/image/photo2.jpg" class="w-100" alt="">
                  </div>
                  <div class="col-4">
                    <img src="/image/profile.jpg" class="w-100" alt="">
                  </div>
                </div> -->
                
              </div>

              <main class="py-4">
            @yield('content')
        </main>
        </div>    
</body>
</html>