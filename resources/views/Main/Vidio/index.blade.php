<x-pengguna.app>

    @slot('style')

    <link rel="stylesheet"
    href="{{ asset('module/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
    href="{{ asset('module/select.bootstrap4.min.css') }}">
    <link rel="stylesheet"
    href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">

    <link rel="stylesheet"
    href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
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
                        <div class="row gap-2 pt-3" id="container_list_kategori">

                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div id="recent-blog-posts" class="recent-blog-posts">

                            <div class="container">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-3 d-flex justify-content-end">
                                                <select class="form-select filter_playlist" id="filter_playlist" aria-label="Default select example">
                                                    <option selected>All</option>
                                                    <option value="terbaru">Playlist Terbaru</option>
                                                    <option value="terlama">Playlist Terlama</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="list_playlist_terbaru">

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
    <script src="{{ asset('module/jquery-ui.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-toastr.js') }}"></script>
        <!-- JS Libraies -->
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

      <!-- JS Libraies -->
    <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
   <script src="
   https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js
   "></script>
      <script>

        let datas_current = "all";
        let kategori_id_current= null;
        let is_kategori_current = false;
        let isi_filter_current = "all";
        let is_filter_current = false;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function get_list_vidio_main(datas, kategori_id,kategori,isi_filter,filter) {
            $("#list_playlist_terbaru").empty();
            let id = $("#id_vidio").val();
            $.ajax({
                url: `{{ url('pengguna/get_list_vidio_main') }}`,
                type: 'GET',
                data: {
                    "data": datas,
                    "kategori_id": kategori_id,
                    "kategori": kategori,
                    "isi_filter": isi_filter,
                    "filter": filter,
                },
                success: function(response) {
                    if (response.data && response.data.length == 0) {
                        $("#list_playlist_terbaru").append(`
                            <div class="col-lg-12 d-flex justify-content-center alert alert-primary col-xl-12 col-sm-12">
                                <h1>Data Kosong</h1>
                            </div>
                        `);
                    } else {
                        response.data.forEach(item => {
                            let ratingHtml = '';
                            if (item.rating == 0) {
                                ratingHtml += `<div class="ratings">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div>
                                                <h5 class="review-count">${item.rating} Rating</h5>`;
                            } else {
                                ratingHtml += `<div class="ratings">
                                                    <i class="fa fa-star rating-color" aria-hidden="true"></i>
                                                </div>
                                                <h5 class="review-count">${item.rating} Rating</h5>`;
                            }

                            $("#list_playlist_terbaru").append(`
                                <div class="col-lg-4 col-xl-4 col-sm-4">
                                    <a href="{{ url('pengguna/detailPlaylist/${item.id}') }}">
                                        <div class="post-box">
                                            <div class="post-img"><img src="{{ asset('storage/playlist/${item.thumbnail_playlist}') }}" class="img-fluid" alt=""></div>
                                            <h3 class="post-title">${item.nama_playlist}</h3>
                                            <span class="post-date">
                                                <small> ${item.kategori}
                                            </span>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                                        <i class="fa fa-users icon-siswa-content" aria-hidden="true"></i>
                                                        <h5 class="caption-icon-siswa-content">Siswa</h5>
                                                    </div>
                                                    <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                                        <i class="fa fa-bars icon-siswa-content" aria-hidden="true"></i>
                                                        <h5 class="caption-icon-siswa-content">${item.total_vidio} Modul</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3">
                                                ${ratingHtml}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            `);
                        });
                    }
                    pembersihan_small();
                }
            });
        }


        function get_list_kategori() {
            $("#container_list_kategori").empty();
            let id = $("#id_vidio").val();
            $.ajax({
                url: `{{ url('pengguna/get_list_kategori') }}`,
                type: 'GET',
                success: function(response) {
                    let htmlKat = `
                        <div class="col-lg-12 parent_kategori" data-id="all" id="parent_kategori" style="cursor:pointer;">
                            <div class="container-category" id="container-category">
                                <img class="img-category" src="{{ asset('img/editing.jpg') }}" alt="">
                                <h5 class="caption-category">All</h5>
                            </div>
                        </div>
                    `;
                    response.data.forEach(item => {
                        htmlKat += `
                            <div class="col-lg-12 parent_kategori" data-id="${item.id}" id="parent_kategori" style="cursor:pointer;">
                                <div class="container-category" id="container-category">
                                    <img class="img-category" src="{{ asset('img/editing.jpg') }}" alt="">
                                    <h5 class="caption-category">${item.nama_kategori}</h5>
                                </div>
                            </div>
                        `
                    });
                    $("#container_list_kategori").append(htmlKat);
                }
            });
            button_parent_kategori_klik();
        }

        $(document).on('click', '.parent_kategori', function(e) {
            e.preventDefault();
            const id = $(this).data("id");
            if(id == "all"){
                datas_current = "all";
                kategori_id_current = null;
                is_kategori_current = false;
                get_list_vidio_main(datas_current,kategori_id_current,is_kategori_current,isi_filter_current,is_filter_current);
            }else{
                datas_current = "kategori";
                kategori_id_current = id;
                is_kategori_current = true;
                get_list_vidio_main(datas_current,kategori_id_current,is_kategori_current,isi_filter_current,is_filter_current);
            }
        });

        $(document).on("change",'.filter_playlist',function(e) {
            e.preventDefault();
            var selectedValue = $(this).val();
            isi_filter_current = selectedValue;
            is_filter_current = true;
            get_list_vidio_main(datas_current,kategori_id_current,is_kategori_current,isi_filter_current,is_filter_current);
        });

        function pembersihan_small(){
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
        }

        $(document).ready(function(){
            get_list_vidio_main(datas_current,kategori_id_current,is_kategori_current,isi_filter_current,is_filter_current);
            get_list_kategori();
        });

      </script>
    @endslot
  </x-pengguna.app>
