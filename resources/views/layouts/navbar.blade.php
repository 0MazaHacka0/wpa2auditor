<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#app-navbar-collapse" aria-controls="app-navbar-collapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('home') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('tasks_index') }}">Tasks</a></li>
                <li class="nav-item"><a class="nav-link" href=" {{ route('dicts_index') }} ">Dicts</a> </li>
            </ul>
            <ul class="navbar-nav">
                <!-- Right Side Of Navbar -->

                <!-- Search form -->
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

                <!-- Authentication Links -->
                @if (Auth::guest())

                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    </ul>

                @else
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>