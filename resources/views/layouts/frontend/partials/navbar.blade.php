<header class="default-header"style="font-family: 'Gill Sans', sans-serif; color:black;">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container px-3">
          <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{asset('frontend/img/project_logo_2.png')}}" alt="" style="width:160px; height: 100;">
          </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="lnr lnr-menu"></span>
              </button>

              <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent"style="font-family: 'Gill Sans', sans-serif; color:black;">
                <ul class="navbar-nav scrollable-menu"style="font-family: 'Gill Sans', sans-serif; color:black;">
                    <li><a href="/">Home</a></li>
                    <li><a href="/posts">Posts</a></li>
                    <li><a href="/categories">Categories</a></li>
                    <li><a href="/#about">About</a></li>
























                    
                    @if (Route::has('login'))
                    @auth
                        <!-- Dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" onclick="dropMenu()">
                        <img class="user-avatar rounded-circle" style="    width: 31px;
    margin-top: -7px;" src="{{asset('storage/user/'.Auth::user()->image)}}" alt="User Avatar">
                        </a>
                        <div class="dropdown-menu menu1" style="display: none font-family: 'Gill Sans', sans-serif; color:black;" id="dropMenu">
                            @if (Auth::user()->role->id == 1)
                            <a href="{{route('admin.profile')}}" class="dropdown-item" target="_blank"> <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;{{Auth::user()->name}}</a>
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fa fa-tv" aria-hidden="true"></i>&nbsp; Dashboard</a>
                            <a class="dropdown-item" href="{{ route('comment-notification.index') }}"><i class="fa fa-bell" aria-hidden="true"></i>&nbsp; Notifications</a>
                            @elseif(Auth::user()->role->id == 2)
                            <a href="{{route('user.profile')}}" class="dropdown-item" target="_blank"> <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;{{Auth::user()->name}}</a>
                            <a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="fa fa-tv" aria-hidden="true"></i>&nbsp; Dashboard</a>
                            <a class="dropdown-item" href="{{ route('user.like.posts') }}"><i class="fa fa-heart" aria-hidden="true"></i>&nbsp; Favorite List</a>
                            <a class="dropdown-item" href="{{ route('comment-notification.index') }}"><i class="fa fa-bell" aria-hidden="true"></i>&nbsp; Notifications</a>
                            @else
                            null
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp; {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>

                    </li>
                    <script>
                        function dropMenu(){
                        var dropmenu = document.getElementById('dropMenu');
                            if (dropmenu.style.display === "none") {
                                dropmenu.style.display = "block";
                            } else {
                                dropmenu.style.display = "none";
                            }
                            }
                    </script>
                    @else
                    <li><a href="{{ route('login') }}">Login</a></li>

                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                @endauth

                 @endif




                
                </ul>
              </div>
        </div>
    </nav>
</header>