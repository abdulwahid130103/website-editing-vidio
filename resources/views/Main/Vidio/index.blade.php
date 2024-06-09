<x-pengguna.app>

    @slot('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @endslot
    @slot('main')
        <!-- ======= Hero Section ======= -->
    <section id="hero-vidio" class="hero-vidio">


    </section><!-- End Hero -->

    <main id="main">

        <section id="content-vidio">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="">Pilihan playlist Vidio</h1>
                        <p class="">Pilih dan jadilah profesional !</p>
                    </div>
                    <div class="col-lg-3">
                        <h3>Kategori Playlist</h3>
                        <div class="row gap-2">
                            <div class="col-lg-12">
                                <div class="container-category" id="container-category">
                                    <img class="img-category" src="{{ asset('img/logo_codepolitan.jpg') }}" alt="">
                                    <h5 class="caption-category">Kategori</h5>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="container-category" id="container-category">
                                    <img class="img-category" src="{{ asset('img/logo_codepolitan.jpg') }}" alt="">
                                    <h5 class="caption-category">Kategori</h5>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="container-category" id="container-category">
                                    <img class="img-category" src="{{ asset('img/logo_codepolitan.jpg') }}" alt="">
                                    <h5 class="caption-category">Kategori</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div id="recent-blog-posts" class="recent-blog-posts">

                            <div class="container">
                              <div class="row">
                                <div class="col-lg-4">
                                  <div class="post-box">
                                    <div class="post-img"><img src="{{ asset('assets/img/blog/blog-1.jpg') }}" class="img-fluid" alt=""></div>
                                    <span class="post-date">
                                        <small>By Eko Kurniawan Khannedy <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check fa-fw text-primary icon-success-content" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"></path></svg></small>
                                    </span>
                                    <h3 class="post-title">Laravel Eloquent API Resource</h3>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                                <i class="fa fa-users icon-siswa-content" aria-hidden="true"></i>
                                                <h5 class="caption-icon-siswa-content">Siswa</h5>
                                            </div>
                                            <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                                <i class="fa fa-bars icon-siswa-content" aria-hidden="true"></i>
                                                <h5 class="caption-icon-siswa-content">12 Modul</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="ratings">
                                            <i class="fa fa-star rating-color" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="review-count">12 Reviews</h5>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="post-box">
                                    <div class="post-img"><img src="{{ asset('assets/img/blog/blog-2.jpg') }}" class="img-fluid" alt=""></div>
                                    <span class="post-date">
                                        <small>By Eko Kurniawan Khannedy <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check fa-fw text-primary icon-success-content" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"></path></svg></small>
                                    </span>
                                    <h3 class="post-title">Laravel Eloquent API Resource</h3>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                                <i class="fa fa-users icon-siswa-content" aria-hidden="true"></i>
                                                <h5 class="caption-icon-siswa-content">Siswa</h5>
                                            </div>
                                            <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                                <i class="fa fa-bars icon-siswa-content" aria-hidden="true"></i>
                                                <h5 class="caption-icon-siswa-content">12 Modul</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="ratings">
                                            <i class="fa fa-star rating-color" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="review-count">12 Reviews</h5>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="post-box">
                                    <div class="post-img"><img src="{{ asset('assets/img/blog/blog-3.jpg') }}" class="img-fluid" alt=""></div>
                                    <span class="post-date">
                                        <small>By Eko Kurniawan Khannedy <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check fa-fw text-primary icon-success-content" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"></path></svg></small>
                                    </span>
                                    <h3 class="post-title">Laravel Eloquent API Resource</h3>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                                <i class="fa fa-users icon-siswa-content" aria-hidden="true"></i>
                                                <h5 class="caption-icon-siswa-content">Siswa</h5>
                                            </div>
                                            <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                                <i class="fa fa-bars icon-siswa-content" aria-hidden="true"></i>
                                                <h5 class="caption-icon-siswa-content">12 Modul</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="ratings">
                                            <i class="fa fa-star rating-color" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="review-count">12 Reviews</h5>
                                    </div>
                                  </div>
                                </div>

                              </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
    @endslot

    @slot('script')
      <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
    @endslot
  </x-pengguna.app>
