<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{url('/')}}">E-shop</a>
    <div class="search-bar">
      <form action="{{ url('/search-product') }}" method="POST">
        @csrf
        <div class="input-group ">
          <input type="search" class="form-control" id="search_product" name="search_product" placeholder="Search Products" aria-label="Username" aria-describedby="basic-addon1" required>
          <button type="submit" class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></button>
        </div>
      </form>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto ">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/categories')}}">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/my-orders') }}">My Orders</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/get-wishlist') }}" >Wishlist&nbsp;<span class="wish_count"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/view-cart') }}">My Cart&nbsp;<span class="cart_count"></span></a>
        </li>
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
       </ul>
    </div>
  </div>
</nav>