<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar-light admin-header">
            <div class="container-fluid">
                <!-- Add logo -->
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <img src="/images/Justmeals-logo-backend.png" alt="" class="jumbo-logo">
                </a>

                <!-- Responsive button-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Center Side Of Navbar -->
                    <ul class="navbar-nav gap mx-auto mb-2 mb-lg-0">
                        <!-- Authentication Links -->
                        @guest
                            <li class="d-flex">
                                <a aria-current="page" class="mx-2" href="{{ route('login') }}"><i class="fa-solid fa-user"></i></a>
                                <div class="position-relative"><a aria-current="page" class="nav-item" href="{{ route('login') }}">{{ __('Login') }}</a></div>
                            </li>
                            @if (Route::has('register'))
                                <li class="d-flex">
                                    <a class="mx-2" href="{{ route('register') }}"><i class="fa-solid fa-user-plus"></i></a>
                                    <div class="position-relative"><a class="nav-item" href="{{ route('register') }}">{{ __('Register') }}</a></div>
                                </li>
                            @endif
                        @else
                                <li class="d-flex">
                                     <a href="{{route('admin.restaurants.index')}}" class="mx-2"><i class="fa-solid fa-house"></i></a>
                                        <div class="position-relative"><a href="{{route('admin.restaurants.index')}}" class="nav-item">I miei ristoranti</a></div>
                                </li>
                            {{-- <li class="d-flex">
                                <a id="navbarDropdown" href="{{route('admin.orders.index')}}" class="mx-2"><i class="fa-solid fa-utensils"></i></a>
                                     <div class="position-relative"><a class="nav-item" href="{{route('admin.orders.index')}}">Ordini ricevuti</a></div>
                            <li> --}}
                            </ul>

                            <!-- Right side of Navbar -->
                            <ul class="navbar-nav">
                                <li class="d-flex">
                                        {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        </a> --}}

                                        <div class="bottone-storto">
                                            <div class="pos">Logout</div>
                                                <div class="prospettiva">
                                                <a class="dropdown-item storto btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <span style="color: transparent">{{ __('Logout') }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item bottone-storto" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a> --}}
                                    </div>
                                </li>
                            </ul>
                        @endguest
                </div>
            </div>
        </nav>

        