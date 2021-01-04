 <nav
      class="navbar navbar-expand-lg navbar-dark navbar-event fixed-top navbar-fixed-top"
    >
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Evnt</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('event') }}">Event</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('category') }}">Category</a>
            </li>
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Sign In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-signup px-4" href="{{ route('register') }}">Sign Up</a>
            </li>
            @endguest

            
          </ul>

          @auth
               <!-- Desktop Menu -->
          <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item dropdown">
              <a
                href="#"
                class="nav-link"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
              >
                <img
                  src="{{ url('frontend/images/icon-user.png') }}"
                  alt=""
                  class="rounded-circle mr-2 profile-picture"
                />
                Hi, {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu">
                <a href="#" class="dropdown-item">Dashboard</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
              </div>
            </li>
            <li class="nav-item">
              <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                @php
                $carts = \App\Cart::where('user_id', Auth::user()->id)->count();
                @endphp

                @if($carts > 0)
                  <img src="{{ url('frontend/images/icon-cart-filled.svg') }}" alt="" />
                  <div class="cart-badge">{{ $carts }}</div>
                @else
                <img src="{{ url('frontend/images/icon-cart-empty.svg') }}" alt="" />
                @endif
              </a>
            </li>
          </ul>

          <!-- Mobile Menu -->
          <ul class="navbar-nav d-block d-lg-none">
            <li class="nav-item">
              <a href="#" class="nav-link">
                Hi, {{ Auth::user()->name }}
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link d-inline-block">
                Cart
              </a>
            </li>

             <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link d-inline-block"  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
              </a>
            </li>
          </ul>
          <!-- End Mobile Menu -->
          @endauth
        </div>
      </div>
    </nav>

