<x-pengguna.app>

  @slot('style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  @endslot
  @slot('main')
      <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container container-hero-section">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up" class="caption-hero-satu" >Kuasai Masa Depan Anda</h1>
          <h1  data-aos="fade-up" class="content-hero-value" id="content-hero-value"></h1>
          <h2 data-aos="fade-up" data-aos-delay="400" class="caption-hero-dua">Tingkatkan potensi karir Anda disini !</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Mulai Sekarang</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Vidio</h2>
          <p>Playlist Terbaru</p>
        </header>

        <div class="row" id="list_playlist_terbaru">

            @foreach ($datas as $item)
                <div class="col-lg-4 col-xl-4 col-sm-4">
                    <a href="{{ url("pengguna/detailPlaylist/".$item->id) }}">
                        <div class="post-box">
                            <div class="post-img"><img src="{{ asset('storage/playlist/'.$item->thumbnail_playlist) }}" class="img-fluid" alt=""></div>
                            <h3 class="post-title">{{ $item->nama_playlist }}</h3>
                            <span class="post-date">
                                <small>{{ $item->kategori }}
                            </span>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                        <i class="fa fa-users icon-siswa-content" aria-hidden="true"></i>
                                        <h5 class="caption-icon-siswa-content">Siswa</h5>
                                    </div>
                                    <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                        <i class="fa fa-bars icon-siswa-content" aria-hidden="true"></i>
                                        <h5 class="caption-icon-siswa-content">{{ $item->total_vidio }} Modul</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-3">
                                @if ($item->rating == 0)
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="review-count">{{ $item->rating }} Rating</h5>
                                @else
                                    <div class="ratings">
                                        <i class="fa fa-star rating-color" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="review-count">{{ $item->rating }} Rating</h5>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

              {{-- <div class="col-lg-4">
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
              </div> --}}

        </div>

      </div>

    </section><!-- End Recent Blog Posts Section -->
  </main><!-- End #main -->
  @endslot

  @slot('script')
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
    <script>
      gsap.registerPlugin(TextPlugin)

        var playlistContainer = document.getElementById('list_playlist_terbaru');
        if (playlistContainer) {
            var smallElements = playlistContainer.getElementsByTagName('small');

            for (var i = 0; i < smallElements.length; i++) {
                var smallElement = smallElements[i];
                var fragment = document.createDocumentFragment();
                while (smallElement.firstChild) {
                    fragment.appendChild(smallElement.firstChild);
                }
                smallElement.parentNode.replaceChild(fragment, smallElement);
            }
        }
      const fullText = "Dengan Skill Baru Hari Ini!";
      const contentSelector = ".content-hero-value";

      function animateTextAdding() {
        let displayText = "";
        const timeline = gsap.timeline({
          onComplete: () => {
            const cursor = document.querySelector('.cursor-dua');
            cursor.classList.add('blinking');
            gsap.delayedCall(3, () => {
              cursor.classList.remove('blinking');
              animateTextRemoving();
            });
          }
        });

        fullText.split('').forEach(char => {
          timeline.to(contentSelector, {
            duration: 0.1,
            text: displayText += char,
            ease: "none",
            onComplete: () => updateCursor()
          });
        });
      }

      function animateTextRemoving() {
        let reverseText = fullText;
        const timeline = gsap.timeline({
          onComplete: () => {
            document.querySelector(contentSelector).classList.add('cursor');
            animateTextAdding();
          }
        });

        while (reverseText.length > 0) {
          reverseText = reverseText.slice(0, -1);
          timeline.to(contentSelector, {
            duration: 0.1,
            text: reverseText,
            ease: "none",
            onComplete: () => updateCursor()
          });
        }
      }

      function updateCursor() {
        const element = document.querySelector(contentSelector);
        if (!element.classList.contains('cursor')) {
          element.classList.add('cursor');
        }
        element.innerHTML = element.textContent + '<span class="cursor cursor-dua">|</span>';
      }

      animateTextAdding();
    </script>
  @endslot
</x-pengguna.app>
