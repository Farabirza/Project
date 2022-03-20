
<header id="header">
  <div class="d-flex flex-column">

      <div class="header-logo"><a href="/books">
          <h5><b>Digital</b> Library</h5>
      </a></div>

      <div class="profile">
        <img src="{{ asset('/img/logo/logo-pribadi-white.png') }}" alt="" class="">
      </div>

    <nav id="navbar" class="nav-menu navbar">
      <ul>
        <li id="link-books" class="nav-link active"><i class="bx bxs-book"></i> <span>Books</span> <i class='bx bx-chevron-down nav-drop' role="button" data-bs-toggle="collapse" data-bs-target="#submenu-books" aria-expanded="true" aria-controls="submenu-books"></i></li>
        <ul class="collapse show nav-submenu" id="submenu-books">
            <li class="nav-list"><a href="/index @if(Route::is('books.index')) #section-thumbnails @endif" class='scrollto'>Books index</a></li>
            @if(Route::is('books.index'))
            <li class="nav-list"><a href='/books #section-most_visited' class='scrollto'>Most visited</a></li>
            <li class="nav-list"><a href='/books #section-reviews' class='scrollto'>Recent reviews</a></li>
            @endif
            @auth
            @if(Auth::user()->role == 'admin')
            <li class="nav-list"><hr class="dropdown-divider"></li>
            <li class="nav-list"><a href='/books/create' class='scrollto'>Submit new book</a></li>
            @endif
            @endauth
        </ul>
        @auth
        @if(Auth::user()->role == 'admin')
        <li id="link-dashboard" class="nav-link"><i class="bx bxs-dashboard"></i> <span>Admin Dashboard</span> <i class='bx bx-chevron-down nav-drop' role="button" data-bs-toggle="collapse" data-bs-target="#submenu-dashboard" aria-expanded="false" aria-controls="submenu-dashboard"></i></li>
        <ul class="collapse nav-submenu" id="submenu-dashboard">
            <?php $route = 'App\Http\Controllers\UsersController@dashboard' ?>
            @if(Route::currentRouteAction() == $route)
            <li class="nav-list"><a href="/dashboard @if(Route::currentRouteAction() == $route) #section-users @endif" class="scrollto">Users</a></li>
            <li class="nav-list"><a href="/dashboard @if(Route::currentRouteAction() == $route) #section-books @endif" class="scrollto">Books</a></li>
            <li class="nav-list">Statistics</li>
            <li class="nav-list">Log</li>
            @else
            <li class="nav-list"><a href='/dashboard'>Dashboard</a></li>
            @endif
        </ul>
        @endif
        @endauth
      </ul>
    </nav>

  </div>
</header>

<!-- ======= section header ======= -->
<section id="section-header">
  <div id="inner-header" class="container-fluid vertical-center">
    <div id="user-data" class="d-flex vertical-center">
      @auth
      <img src="{{ asset('/img/icons/male.png') }}" id="user-img" alt="" class="img-fluid rounded-circle">
      <span id="user-name">{{ Auth::user()->profile->first_name }} {{ Auth::user()->profile->last_name }}</span> | <span id="user-role">{{ ucfirst(Auth::user()->role) }}</span> 
      @endauth
      @guest
      <img src="{{ asset('/img/icons/male.png') }}" id="user-img" alt="" class="img-fluid rounded-circle">
      <span id="user-name">Guest</span>
      @endguest
      <i id="user-icon" class='bx bx-chevron-down' type="button" id="user-menu" data-bs-toggle="dropdown" aria-expanded="false"></i>
      <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="user-menu">
        @auth
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><a class="dropdown-item" href="/logout">Log out</a></li>
        @endauth
        @guest
        <li><a class="dropdown-item" href="/login">Log in</a></li>
        <li><a class="dropdown-item" href="/register">Register</a></li>
        @endguest
      </ul>
    </div>
  </div>
</section>
<!-- ======= section header end ======= -->