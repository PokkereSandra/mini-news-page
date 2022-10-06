<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 nav-link" href="{{asset('/')}}">NEWS</a>
    <a class="navbar-brand ps-3 nav-link" href="{{asset('/most-commented')}}">MOST COMMENTED</a>
    <!-- Navbar-->
    @if (Route::has('login'))
        @auth
            <a class="navbar-brand ps-3 nav-link" href="{{asset('/add-article')}}">ADD ARTICLE</a>
            <ul class="navbar-nav ms-auto me-3 me-lg-4">
                <a id="navbarDropdown" class="navbar-nav ms-auto me-3 me-lg-4 nav-link" href="#" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->username }} <span class="caret"></span>
                </a>
                <a class="navbar-nav ms-auto me-3 me-lg-4 nav-link" id="account-dropdown" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <span class="caret"></span>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                    <ul class="navbar-nav ms-auto me-3 me-lg-4">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        @endif
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </ul>
                @endauth
                @endif
            </ul>
</nav>
