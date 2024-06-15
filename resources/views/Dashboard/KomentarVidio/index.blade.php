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
                                <h2 class="section-title">Playlist Vidio</h2>
                                <div class="row">
                                    @foreach ($datas as $item)
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <a href="{{ url("admin/get_detail_playlist/".$item->id) }}">
                                                <article class="article article-style-c">
                                                    <div class="article-header">
                                                        <div class="article-image" data-background="{{ asset('storage/playlist/'.$item->thumbnail_playlist) }}">
                                                        </div>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-category"><a href="#">{{ $item->kategori }}</a>
                                                            {{-- <div class="bullet"></div> <a href="#">5 Days</a> --}}
                                                        </div>
                                                        <div class="article-title">
                                                            <h2><a href="javascript:void(0)" style="text-decoration: none;">{{ $item->nama_playlist }}</a></h2>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                                                <i class="fa fa-users icon-siswa-admin" aria-hidden="true"></i>
                                                                <h5 class="caption-icon-siswa-admin">Siswa</h5>
                                                            </div>
                                                            <div class="col-lg-6 d-flex gap-2 justify-content-start align-items-center">
                                                                <i class="fa fa-bars icon-siswa-admin" aria-hidden="true"></i>
                                                                <h5 class="caption-icon-siswa-admin">{{ $item->total_vidio }} Modul</h5>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-3">
                                                            @if ($item->rating == 0)
                                                                <div class="ratings">
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                </div>
                                                                <h5 class="review-count">{{ $item->rating }}  Rating</h5>
                                                            @else
                                                                <div class="ratings">
                                                                    <i class="fa fa-star rating-color" aria-hidden="true"></i>
                                                                </div>
                                                                <h5 class="review-count">{{ $item->rating }} Rating</h5>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </article>
                                            </a>
                                        </div>
                                    @endforeach
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

    @endslot

</x-admin.app>
