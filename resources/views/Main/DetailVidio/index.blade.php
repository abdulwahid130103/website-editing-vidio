<x-pengguna.app>

    @slot('style')
    <!-- CSS Libraries -->

    <link rel="stylesheet"
    href="{{ asset('module/datatables.min.css') }}">
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
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @endslot
    @slot('main')
        <!-- ======= Hero Section ======= -->
    <section id="hero-vidio-detail-playlist" class="hero-vidio-detail-playlist">


    </section><!-- End Hero -->

    <main id="main">


        <section id="content-vidio">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            @foreach ($data as $item)
                                <input type="text" id="id_vidio" class="id_vidio d-none" value="{{ $item->id }}">
                                <div class="col-lg-12">
                                    <iframe width="100%" class="play-vidio-detail-vidio" style="height: 70vh;" src="{{ $item->link }}" frameborder="0" allowfullscreen></iframe>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card card-comment-container">
                                        <div class="card-body container-deskripsi">
                                            <h1>{{ $item->judul }}</h1>
                                            <h4>{{ $item->kategori }}</h4>
                                            <p>{{ $item->deskripsi }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-lg-12">
                                <div class="card card-comment-container">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <img src="{{ asset('assets/img/blog/blog-1.jpg') }}" class="img-fluid image-comment-detail-vidio" alt="">
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <form action="" id="comment_form">
                                                            <input type="text" name="comment" id="comment" class="comment-form form-control">
                                                            <div class="d-flex">
                                                                <div class="d-flex flex-column star-card">
                                                                    <label class="fa fa-star" for="rating1" onclick="handleStarClick(1)"></label>
                                                                    <input type="checkbox" class="d-none" value="rating1" id="rating1" disabled>
                                                                </div>
                                                                <div class="d-flex flex-column star-card">
                                                                    <label class="fa fa-star" for="rating2" onclick="handleStarClick(2)"></label>
                                                                    <input type="checkbox" class="d-none" value="rating2" id="rating2" disabled>
                                                                </div>
                                                                <div class="d-flex flex-column star-card">
                                                                    <label class="fa fa-star" for="rating3" onclick="handleStarClick(3)"></label>
                                                                    <input type="checkbox" class="d-none" value="rating3" id="rating3" disabled>
                                                                </div>
                                                                <div class="d-flex flex-column star-card">
                                                                    <label class="fa fa-star" for="rating4" onclick="handleStarClick(4)"></label>
                                                                    <input type="checkbox" class="d-none" value="rating4" id="rating4" disabled>
                                                                </div>
                                                                <div class="d-flex flex-column star-card">
                                                                    <label class="fa fa-star" for="rating5" onclick="handleStarClick(5)"></label>
                                                                    <input type="checkbox" class="d-none" value="rating5" id="rating5" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-between mt-3">
                                                                <div class=""></div>
                                                                <div class="">
                                                                    <button type="button" class="btn btn-primary btn-batal-detail-vidio">Batal</button>
                                                                    <button type="button" class="btn btn-primary btn-komentar-detail-vidio">komentar</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row" id="container_list_comment">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-list-detail-vidio">
                            <div class="card-body">
                                <div class="row gap-3">
                                    <div class="col-lg-12">
                                        <a href="">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex align-items-start ">
                                                    <img src="{{ asset('assets/img/blog/blog-1.jpg') }}" class="img-fluid image-list-detail-vidio" alt="">
                                                </div>
                                                <div class="col-lg-6">
                                                    <h4 class="caption-1-detail-vidio">{{ Str::limit("DIA PACAR ORANG OM, GUE SEROBOT LAH‼️SEKARANG MAU GUE BALIKIN AJA🤣🤣 - JUAN AND EVE - PODHUB", 45, '...') }}</h4>
                                                    <p class="caption-2-detail-vidio">3 hari yang lalu</p>
                                                </div>
                                                <div class="col-lg-1 d-flex justify-content-center align-items-center">
                                                    <i class="fa fa-lock me-3" style="transform: translateY(3px)" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-12">
                                        <a href="">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex align-items-start ">
                                                    <img src="{{ asset('assets/img/blog/blog-1.jpg') }}" class="img-fluid image-list-detail-vidio" alt="">
                                                </div>
                                                <div class="col-lg-6">
                                                    <h4 class="caption-1-detail-vidio">{{ Str::limit("DIA PACAR ORANG OM, GUE SEROBOT LAH‼️SEKARANG MAU GUE BALIKIN AJA🤣🤣 - JUAN AND EVE - PODHUB", 45, '...') }}</h4>
                                                    <p class="caption-2-detail-vidio">3 hari yang lalu</p>
                                                </div>
                                                <div class="col-lg-1 d-flex justify-content-center align-items-center">
                                                    <i class="fa fa-lock me-3" style="transform: translateY(3px)" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
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
           <!-- JS Libraies -->
        <script src="{{ asset('module/dataTables.min.js') }}"></script>
        <script src="{{ asset('module/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('module/dataTables.select.min.js') }}"></script>
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
      <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         function get_rating_komen() {
            $("#container_list_comment").empty();
            let id = $("#id_vidio").val();
            $.ajax({
                url: `{{ url('pengguna/get_rating_komen/${id}') }}`,
                type: 'GET',
                success: function(response) {
                    response.ratings.forEach(item => {
                        let starHtml = '';
                        let angka = 5 - item.bintang;
                        for (let i = 0; i < item.bintang; i++) {
                            starHtml += `<i class="fa fa-star star-comment-list" aria-hidden="true"></i>`;
                        }
                        for (let i = 0; i < angka; i++) {
                            starHtml += `<i class="fa fa-star" aria-hidden="true"></i>`;
                        }
                        $("#container_list_comment").append(`
                            <div class="col-lg-12">
                                <div class="card card-comment-container">
                                    <div class="card-body">
                                        <div class="row gap-3">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <img src="{{ asset('storage/user/${item.foto}') }}" class="img-fluid image-comment-detail-vidio" alt="">
                                                    </div>
                                                    <div class="col-lg-10 container-isi-comment">
                                                        <h4 class="user-comment-list">${item.nama_user}<span>${item.time_ago}</span></h4>
                                                        <p class="isi-comment-list">${item.isi}</p>
                                                        <p class="isi-rating-list">${starHtml}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                }
            });
        }

        function handleStarClick(rating) {
            const currentChecked = document.querySelectorAll('.star-card input:checked').length;
            const isSingleChecked = (currentChecked === 1 && document.getElementById(`rating${rating}`).checked);

            if (isSingleChecked) {
                document.getElementById(`rating${rating}`).checked = false;
                document.querySelector(`label[for="rating${rating}"]`).classList.remove('checked');
            } else {
                for (let i = 1; i <= 5; i++) {
                    const starLabel = document.querySelector(`label[for="rating${i}"]`);
                    const starInput = document.getElementById(`rating${i}`);

                    if (i <= rating) {
                        starLabel.classList.add('checked');
                        starInput.checked = true;
                    } else {
                        starLabel.classList.remove('checked');
                        starInput.checked = false;
                    }
                }
            }
        }

        function aksi_tambah_comment() {
            $('.btn-komentar-detail-vidio').off('click').on('click',function(e){
                e.preventDefault();
                const currentChecked = document.querySelectorAll('.star-card input:checked').length;
                var formData = new FormData($('#comment_form')[0]);
                formData.append('comment', $('#comment').val());
                formData.append('rating', currentChecked);
                formData.append('vidio_id',$("#id_vidio").val());
                $.ajax({
                    url: "{{ url('pengguna/store_comment') }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            iziToast.success({
                                title: 'Berhasil',
                                message: response.success,
                                position: 'topRight'
                            });
                            $('#modaluser').modal('hide');
                            $('#datatable_user').DataTable().ajax.reload();
                        } else {
                            if (Array.isArray(response.error)) {
                                var errorMessages = "<ul>";
                                $.each(response.error, function (key, value) {
                                    errorMessages += "<li>" + value + "</li>";
                                });
                                errorMessages += "</ul>";
                                iziToast.error({
                                    message: errorMessages,
                                    position: 'topRight'
                                });
                            }else{
                                iziToast.error({
                                    message: response.errorgambar,
                                    position: 'topRight'
                                });
                            }
                        }
                        // reset_input();
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.error;
                        var errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value + '<br>';
                        });
                        $('#modaluser').modal('hide');
                        iziToast.error({
                            title: 'Gagagal!',
                            message: errorMessages,
                            position: 'topRight'
                        });
                    }
                });
            });
        }

        $(document).ready(function(){
            get_rating_komen();
            aksi_tambah_comment();
        });
      </script>
    @endslot
  </x-pengguna.app>
