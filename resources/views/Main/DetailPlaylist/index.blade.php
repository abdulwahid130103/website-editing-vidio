<x-pengguna.app>

    @slot('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @endslot
    @slot('main')
        <!-- ======= Hero Section ======= -->
    <section id="hero-vidio-detail-playlist" class="hero-vidio-detail-playlist">


    </section><!-- End Hero -->

    <main id="main">

        @foreach ($datas as $item)
            <section id="content-vidio">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img width="200" class="img-playlist" height="100" src="{{ asset('storage/playlist/'.$item->thumbnail_playlist) }}" alt="" srcset="">
                                    </div>
                                    <div class="col-lg-9 d-flex align-items-center">
                                        <h1 class="title-playlist">{{ $item->nama_playlist }}</h1>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-12">
                                    <p class="caption-playlist"></p>
                                    {{-- <p class="caption-playlist">Yuk Belajar Python dasar di seri Tutorial Python Bahasa Indonesia untuk pemula.</p> --}}
                                </div>
                                <div class="col-lg-12 mb-3">
                                <div class="row">
                                        <div class="col-lg-4">
                                            <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                                <div class="ratings-detail-playlist">
                                                    {{-- <i class="fa fa-star rating-color-detail-playlist" aria-hidden="true"></i> --}}
                                                    @if ($item->rating == 0)
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <h5 class="review-count">{{ $item->rating }} Rating</h5>
                                                    @else
                                                        <i class="fa fa-star rating-color-detail-playlist" aria-hidden="true"></i>
                                                        <h5 class="review-count">{{ $item->rating }} Rating</h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                            <h4 class="penilaian-playlist">{{ $item->penilaian }} penilaian</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                            <h4 class="peserta-playlist">{{ $item->kategori }}</h4>
                                            </div>
                                        </div>
                                </div>
                                </div>

                                <div class="col-lg-12 main-deskripsi-detail-playlist">
                                    <h1>Tentang Kelas</h1>
                                    <p>{{ $item->deskripsi_playlist }}</p>
                                </div>
                                <div class="col-lg-12">
                                    {{-- <h1>kelasterbuka #ngoding #python</h1> --}}
                                </div>
                                <div class="col-lg-12">
                                    <section id="list-vidio">
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button caption-list-vidio" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    {{ $item->nama_playlist }}
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        @foreach ($item->vidio as $item2)
                                                            @if ($item2->unlock == false)
                                                                <div class="col-lg-12">
                                                                    <div class="row container-list-vidio">
                                                                        <div class="col-lg-1">
                                                                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            <h4 class="title-list-vidio">{{ $item2->judul_vidio }}</h4>
                                                                        </div>
                                                                        <div class="col-lg-2 d-flex justify-content-end time-list-vidio">
                                                                            @if ($item2->unlock == false)
                                                                                <i class="fa fa-lock me-3" style="transform: translateY(3px)" aria-hidden="true"></i>
                                                                            @endif
                                                                            <p>{{ $item2->time_vidio }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <a href="{{ url("pengguna/detailVidio/".$item2->id) }}">
                                                                    <div class="col-lg-12">
                                                                        <div class="row container-list-vidio">
                                                                            <div class="col-lg-1">
                                                                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="col-lg-9">
                                                                                <h4 class="title-list-vidio">{{ $item2->judul_vidio }}</h4>
                                                                            </div>
                                                                            <div class="col-lg-2 d-flex justify-content-end time-list-vidio">
                                                                                @if ($item2->unlock == false)
                                                                                    <i class="fa fa-lock me-3" style="transform: translateY(3px)" aria-hidden="true"></i>
                                                                                @endif
                                                                                <p>{{ $item2->time_vidio }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div id="recent-blog-posts" class="recent-blog-posts">

                                <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <div class="post-box">
                                        <div class="post-img post-image-detail"><img src="{{ asset('storage/playlist/'.$item->thumbnail_playlist) }}" class="img-fluid" alt=""></div>
                                        <span class="post-date card-detail-playlist">
                                        <h1>Gratis !</h1>
                                        </span>
                                        {{-- <h3 class="post-title-detail-playlist mb-3">Yang akan kamu dapatkan :</h3> --}}
                                        <div class="row list-count-detail-playlist">
                                            <div class="col-lg-12 d-flex gap-3 justify-content-start align-items-center">
                                                <i class="fa fa-users icon-count-list-detail" aria-hidden="true"></i>
                                                <h5>Siswa</h5>
                                            </div>
                                            <div class="col-lg-12 d-flex gap-3 justify-content-start align-items-center">
                                                <i class="fa fa-bars icon-count-list-detail" aria-hidden="true"></i>
                                                <h5>{{ $item->total_vidio }} Modul</h5>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary btn-sekarang-card-detail">Belajar Sekarang</button>
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
        @endforeach

    </main><!-- End #main -->
    @endslot

    @slot('script')
      <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
    @endslot
  </x-pengguna.app>
