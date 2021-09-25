@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8" style="padding-top:120px; padding-left:80px; padding-right:80px;">
            <!-- <br><br><br><br><br><br><br> -->
            <div class="card ">
                <div class="card-header" style="background-color:rgb(240, 240, 240);
                 border:3px solid grey; color:black; font-size:20px;">

                    <img src="/image/login.png" alt="" width="5%"><i>&emsp;

                        {{ __('Login') }}  {{ __('System') }}
                    
                </i> 
                    
                
                
                
                </div>

                <div class="card-body" style="background-color:lightblue; border: 3px solid grey;">
                    <form  method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><strong>{{ __('E-mail Address') }}</strong></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><strong>{{ __('Password') }}</strong></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                       <strong>
                                       {{ __('Remember Me') }}
                                       </strong> 
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link " style="color:black" href="{{ route('password.request') }}">
                                        
                                        <b>
                                            {{ __('Forgot Your Password?') }}
                                        </b>
                                    </a><br><br>
                                @endif
                                Dont have an Account?
                                <a href="/register" style="color:black">
                                   <b> {{ __('Register')}}</b>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
