<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="/storage/images/logo.png" style="width: 50px"class="img img-fluid" alt="">
        </a>
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'APUSUOF') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item active"><a href="/clubs-soc" class="nav-link">Clubs & Societies</a></li>
                <li class="nav-item"><a href="/forum/thread?tags=5" class="nav-link">Lost & Found</a></li>
                <li class="nav-item"><a href="/forum" class="nav-link">Q & A</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">Upcoming</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <a class="dropdown-item" href="/events">Events</a>
                        <a class="dropdown-item" href="/volunteering">Volunteering</a>
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif 
                @else
                    <li class="nav-item dropdown" id="markasread" onclick="markNotificationAsRead()">
                        <a id="navbarDropdown" class="mt-1 nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>   
                            <i class="fas fa-bell"></i> Notifications <span class="badge badge-pill badge-danger">{{count(auth()->user()->unreadNotifications)}}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @forelse (auth()->user()->unreadNotifications as $notification)
                                @include('inc.notification.'.snake_case(class_basename($notification->type)))
                                @empty
                                    <a class="dropdown-item">No Unread Notifications</a>
                            @endforelse
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" v-pre>
                                <img src="/storage/images/avatars/{{ Auth::user()->avatar }}" style="width:32px; height: 32px; position:sticky top:10px; left:10px; border-radius:50%" class="mr-2">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/profile">
                                <i class="fa fa-btn fa-user"></i> Profile
                            </a>
                            @if (Auth::user()->role_id == 1)
                                <a class="dropdown-item" href="http://apusuofadmin.me/admin/home">
                                    <i class="fas fa-columns"></i> Admin Dashboard
                                </a>
                            
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
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

    <script src="{{asset('js/main.js')}}"></script>

    @yield('js')