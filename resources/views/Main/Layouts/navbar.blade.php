<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="{{ route('home.index') }}" class="logo d-flex align-items-center">
        <img class="logo-perusahaan" src="{{ asset("img/logo_terbaru_dua.png") }}" alt="">
        <span>AWSVidio</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
            {{-- <li class="search-container-li">
                <div class="search-form">
                    <form action="">
                    <div class="input-group flex-nowrap container-search">
                        <span class="input-group-text" id="addon-wrapping">  <i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Cari disini ...." />
                    </div>
                    </form>
                </div>
            </li> --}}
            <li><a class="nav-link scrollto active" href="{{ route('home.index') }}">Home</a></li>
            <li><a class="nav-link scrollto" href="#about">About</a></li>
            <li><a class="nav-link scrollto" href="{{ url('pengguna/vidio') }}">Vidio</a></li>
            {{-- <li class="dropdown"><a href="#"><span>Course</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a href="#">Editing Vidio</a></li>
                </ul>
            </li> --}}
            @if (!Auth::user())
                <li><a class="getstarted scrollto" href="{{ route("login") }}">Login</a></li>
            @else
                <li><a class="getstarted scrollto" href="{{ route("logout") }}">Logout</a></li>
            @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
