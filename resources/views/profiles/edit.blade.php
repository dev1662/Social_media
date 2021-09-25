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
    <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
        <div class="row " style="padding-left:200px;">
            <h1 >Edit Profile</h1>
        </div>
  <div class="row ">

   <div class="col-8 offset-2">
        @csrf
        @method('PATCH')
    <div class="form-group row">

                            <label for="caption" class="col-md-4 col-form-label ">Title</label>

                           
                                <input id="title"
                                 type="text"
                                 name="title"
                                  class="form-control @error('title') is-invalid @enderror" 
                                  value="{{ old('title') ?? $user->profile->title }}"  
                                  autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                             <div class="form-group row">

                            <label for="caption" class="col-md-4 col-form-label ">Description</label>


                                <input id="description"
                                type="text"
                                name="description"
                                class="form-control @error('description') is-invalid @enderror" 
                                 value="{{ old('description') ?? $user->profile->description }}"  
                                autocomplete="description" autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group row">

                            <label for="caption" class="col-md-4 col-form-label ">URL</label>


                                <input id="url"
                                type="text"
                                name="url"
                                class="form-control @error('url') is-invalid @enderror" 
                                 value="{{ old('url') ?? $user->profile->url }}"  
                                autocomplete="url" autofocus>

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                    <div class="row pr-2">
                            <label for="image" class="col-md-5 col-form-label ">Profile Image</label>

                           
                                <input id="profile"
                                 type="file"
                                 name="profile"
                                  class="form-control-file" 
                                 >

                                @error('profile')
                                    
                                        <strong>{{ $message }}</strong>
                                  
                                @enderror

                        <!-- </div> -->
                        </div>

                        <div class="row pt-4">
                            <button class="btn btn-primary">Save Profile</button>
                        </div>
    </div>
</div>


</form>
</div>


<main class="py-4">
            @yield('content')
        </main>
        </div>    
</body>
</html>