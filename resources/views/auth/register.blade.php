@extends('layouts.frontend.app')
@section('content')

  <div class="login-area page-area py-5 my-5" style="padding-top: 7rem !important;background-image:url('/frontend/img/High_resolution_wallpaper_background_ID_77700326921.jpg');background-repeat: no-repeat;background-attachment: fixed;
  background-size: cover;font-family: 'Gill Sans', sans-serif;">
    <div class="container">
             <!--error msg-->
             @if ($errors->any())

             @foreach ($errors->all() as $error)
              <div class="alert  alert-danger alert-dismissible fade show" role="alert">
         <span class="badge badge-pill badge-danger">Error !!</span>{{$error}}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
       </button>
       </div>
             @endforeach

       </div>
       @endif
       <!--End error msg-->

      <div class="row">
          <div class="col-md-8  p-4" style="font-family: 'Gill Sans', sans-serif;">
           <form method="POST" action="{{ route('register') }}">
                        @csrf
              <h3 class="text-light" style="font-family: 'Gill Sans', sans-serif;">Create New Account</h3>
              <hr>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1"class="text-light" style="font-family: 'Gill Sans', sans-serif;">Name</label>
                   <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"class="text-light" style="font-family: 'Gill Sans', sans-serif;">Username</label>
                     <input id="userid" type="text" class="form-control @error('userid') is-invalid @enderror" name="userid" value="{{ old('userid') }}" required autocomplete="userid" autofocus>

                                @error('userid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"class="text-light" style="font-family: 'Gill Sans', sans-serif;">Email address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"class="text-light" style="font-family: 'Gill Sans', sans-serif;">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password-confirm"class="text-light" style="font-family: 'Gill Sans', sans-serif;">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>


              </div>

              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" style="margin-left: -0.25rem;">
                <label class="form-check-label text-light" for="exampleCheck1" style="font-family: 'Gill Sans', sans-serif;">Remember Me</label>
              </div>
              <button type="submit" class="btn btn-success text-light" style="font-family: 'Gill Sans', sans-serif;"><i class="fa fa-check"></i> Register Now</button>
            </form>
          </div>
          <div class="col-md-4  p-4 text-light">
            <h4 class="py-4 text-light" style="font-family: 'Gill Sans', sans-serif;">Already have an account  ?</h4>
            <p>
              <a href="{{route('login')}}" class="btn btn-primary btn-lg" style="font-family: 'Gill Sans', sans-serif;">Login Now</a>
            </p>
          </div>
      </div>
    </div>
  </div>







































@endsection