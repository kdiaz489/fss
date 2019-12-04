<nav class="navbar navbar-expand-sm bg-denim shadow-sm" data-toggle="affix">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ url('/') }}">


              <img src="{{asset('img/fss-white.svg')}}" width="80px" height="60px">

            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav nav-fill w-100 ">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="/fil">Fill</a>
                      </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="/stor">Stor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/ship">Ship</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/contact">Contact</a>
                        </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/dashboard">Dashboard</a>

                            @impersonate()
                                <a class="dropdown-item" href="{{route('admin.impersonate.destroy')}}">End Impersonate</a>
                            @endimpersonate

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
