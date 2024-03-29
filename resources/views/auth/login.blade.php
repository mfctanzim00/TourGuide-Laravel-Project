@extends('layouts.frontend.app')
@section('content')
    <div class="login-area page-area py-5 my-5" style="padding-top: 7rem !important;background-image:url('/frontend/img/High_resolution_wallpaper_background_ID_77700326921.jpg');background-repeat: no-repeat;background-attachment: fixed;
  background-size: cover;font-family: 'Gill Sans', sans-serif;">
        <div class="container">
            <div class="row">
                <div class="col-md-8  p-4" style="font-family: 'Gill Sans', sans-serif;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h3 class="text-light">Login to your Account</h3>
                        <hr>
                        <div class="form-group" style="font-family: 'Gill Sans', sans-serif;">
                            <label for="exampleInputEmail1"class="text-light">Email address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="font-family: 'Gill Sans', sans-serif;">
                            <label for="exampleInputPassword1"class="text-light">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="row mb-3 text-light" style="font-family: 'Gill Sans', sans-serif;">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }} style="margin-left: -0.25rem;">

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-left text-light" style="font-family: 'Gill Sans', sans-serif;">Login Now</button>

                        <div class="row d-flex justify-content-center space-between" style="margin-left:469px;font-family: 'Gill Sans', sans-serif;">
                            <a href="{{ url('login/google') }} " class="btn btn-outline-info text-light">Sign in with Google <i class="fa fa-google-plus" style="color:rgb(185,57,11);"></i></a><span class="text-dark font-weight-bold mt-3"></span>
                        </div>

                        <div class="float-right" style="font-family: 'Gill Sans', sans-serif;">


                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-danger" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>

                    </form>
                </div>
                <div class="col-md-4 p-4 text-light" style="font-family: 'Gill Sans', sans-serif;">
                    <h4 class="py-4 text-light">Don't have an account ?</h4>
                    <p>
                        <a href="{{ route('register') }}" class="btn btn-success btn-lg">Create New Account</a>
                    </p>
                </div>



            </div>
        </div>
    </div>

    </div>









































    {{-- <div class="container py-5 my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Login') }}
                </div>

                <div class="card-body py-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-0 py-5 my-5">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection