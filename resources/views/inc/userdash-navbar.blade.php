<nav class="navbar navbar-expand-sm bg-denim shadow-sm py-0" data-toggle="affix">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ url('/') }}">
    
    
              <img src="{{asset('img/fss-white.svg')}}" width="80px" height="60px">
    
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
    
            <div class="collapse navbar-collapse p-0" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav nav-fill w-100 ">
    
                        <li class="nav-item py-0"></li>
                        <li class="nav-item py-0"></li>
                        <li class="nav-item py-0"></li>
                        <li class="nav-item py-0"></li>
                        <li class="nav-itemp y-0"></li>
    
                        <li class="nav-item dropdown p-0">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white w-100 text-wrap text-break" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
    
                            <div class="dropdown-menu mt-0 w-100 text-center py-0" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item px-0" href="/dashboard">Dashboard</a>
    
                                <a class="dropdown-item px-0" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
    
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
    
                        </li>

                   <!--
                    <li class="nav-item dropdown p-0">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white w-75 text-wrap text-break" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
    
                        <div class="dropdown-menu w-75 mt-0 text-center" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item px-0" href="/dashboard">Dashboard</a>
    
                            <a class="dropdown-item px-0" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
    
    
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
    
                    </li>
                -->
                
                </ul>
    
            </div>
        </div>
    </nav>
    