<x-admin.app >

    @slot('title')
        Komentar Vidio
    @endslot

    @slot('type_menu')
        transaction
    @endslot
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

         <!-- CSS Libraries -->
        <link rel="stylesheet"
            href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">

    @endslot

    @slot('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Komentar Vidio</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Komentar</a></div>
                    <div class="breadcrumb-item">Vidio</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Komentar Vidio</h4>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder container_list_komen_admin" id="container_list_komen_admin">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="display_vidio_container" class="col-lg-12 display_vidio_container mb-4">

                                                </div>
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
    </div>
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

        <!-- Page Specific JS File -->
        <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
        <!-- JS Libraies -->
        <script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('js/page/components-user.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
        <script src="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js
        "></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function openLoading(title_open,deskripsi_open) {
                Swal.fire({
                    title: title_open,
                    html: deskripsi_open,
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
            }

            function closeLoading() {
                Swal.close();
                // You can add additional logic here after the loading is complete
                Swal.fire({
                    icon: 'success',
                    title: 'Operasi Selesai',
                    text: 'Proses pemuatan telah selesai!',
                });
            }

            function get_vidio_detail() {
                $("#display_vidio_container").empty();
                let id = "{{ $vidio_id }}";
                $.ajax({
                    url: `{{ url('admin/get_vidio_playlist/${id}') }}`,
                    type: 'GET',
                    beforeSend: function() {
                        openLoading("Mohon Ditunggu ...!",'Sedang Load Vidio ...!')
                    },
                    success: function(response) {
                        Swal.close();
                        response.data.forEach(item => {
                            $("#display_vidio_container").append(`
                               <video id="videoPlayer" data-id="upload" width="100%" controls>
                                    <source id="videoSource" src="" ype="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="card profile-widget">
                                    <div class="profile-widget-description">
                                        <div class="profile-widget-name">${item.judul} <div
                                                class="text-muted d-inline font-weight-normal">
                                                <div class="slash"></div> ${item.kategori}
                                            </div>
                                        </div>
                                        ${item.deskripsi}
                                    </div>
                                </div>
                            `);
                            if (item.type_vidio == 'link') {
                                var videoURL = item.link;
                                var videoId = null;
                                if (videoURL.includes('youtube.com')) {
                                    videoId = videoURL.replace('https://www.youtube.com/embed/', '');
                                } else if (videoURL.includes('youtu.be')) {
                                    videoId = videoURL.replace('https://youtu.be/', '');
                                }
                                if (videoId) {
                                    var embedURL = 'https://www.youtube.com/embed/' + videoId;
                                    $('#videoPlayer').replaceWith('<iframe id="videoPlayer" class="play-vidio-detail-vidio" data-id="link" width="100%" style="height: 70vh;" src="' + embedURL + '" frameborder="0" allowfullscreen></iframe>');
                                } else {
                                    $('#videoPlayer').replaceWith(`<img width="100%" class="play-vidio-detail-vidio" style="height: 70vh;" id="videoPlayer" src="{{ asset('img/not_found.jpg') }}" alt="notfound">`);
                                }
                            } else if (item.type_vidio == 'upload') {
                                $('#videoPlayer').replaceWith(`
                                    <video id="videoPlayer" class="play-vidio-detail-vidio" style="height: 70vh;" data-id="upload" width="100%" controls>
                                        <source id="videoSource" src="${response.video_link}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                `);
                            }
                        });
                    }
                });
            }

            function get_list_koment_admin() {
                $("#container_list_komen_admin").empty();
                let id = "{{ $vidio_id }}";
                $.ajax({
                    url: `{{ url('admin/get_list_koment_admin/${id}') }}`,
                    type: 'GET',
                    success: function(response) {
                        let htmlContent = '';

                        console.log(response.ratings);
                        if(response.ratings.length != 0){
                            response.ratings.forEach(item => {
                            let starHtml = '';

                            let angka = 5 - item.bintang;
                            for (let i = 0; i < item.bintang; i++) {
                                starHtml += `<i class="fa fa-star star-comment-list" aria-hidden="true"></i>`;
                            }
                            for (let i = 0; i < angka; i++) {
                                starHtml += `<i class="fa fa-star" aria-hidden="true"></i>`;
                            }

                            htmlContent += `<li class="media">
                                                <img alt="image"
                                                    class="rounded-circle mr-3"
                                                    width="70" height="70"
                                                    src="{{ asset('storage/user/${item.foto}') }}">
                                                <div class="media-body">
                                                    {{-- <div class="media-right">
                                                        <div class="text-primary">Approved</div>
                                                    </div> --}}
                                                    <div class="media-title mb-1">${item.nama_user}</div>
                                                    <div class="text-time">${item.time_ago}</div>
                                                    <div class="media-description text-muted">
                                                        ${item.isi}
                                                    </div>
                                                    <div class="media-links">
                                                       ${starHtml}
                                                    </div>
                                                </div>
                                            </li>`;
                        });
                        }else{
                            htmlContent += `<div class="col-12 mb-4">
                                    <div class="hero bg-primary text-white">
                                        <div class="hero-inner">
                                            <h2>Komentar Kosong</h2>
                                        </div>
                                    </div>
                                </div>`;
                        }

                        $("#container_list_komen_admin").append(htmlContent);

                    }
                });
            }

            $(document).ready(function(){
                get_vidio_detail();
                get_list_koment_admin();
            });
        </script>
    @endslot

</x-admin.app>
