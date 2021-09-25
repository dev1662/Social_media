<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">


    <title>Social Media</title>
    <link rel="icon" type="image/png" href="/image/talkup.png">
     <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
    html,body{
        background-color:lightgoldenrodyellow;
       background: url(image/bg.jpg);
       background-position: center center;
       background-repeat: no-repeat;
       background-attachment: fixed;
       background-size: cover;
     
    }
</style>
</head>
<body>
<div id="app">
    @guest
   
    @if(Route::has('register'))
    
    @endif
    @else
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
                            <notification  v-bind:notifications='notifications'></notification>
                            
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
            @endguest
        </nav>
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>
