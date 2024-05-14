<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>AltVidio</span>
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
            <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
            <li><a class="nav-link scrollto" href="#about">About</a></li>
            <li class="dropdown"><a href="#"><span>Course</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a href="#">Editing Vidio</a></li>
                </ul>
            </li>
            <li><a class="getstarted scrollto" href="{{ route("login") }}">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->