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
                                @foreach ($datas as $item)
                                <h2 class="section-title">{{ $item->nama_playlist }}</h2>
                                <div class="row">
                                    @if (!empty($item->vidio))
                                        @foreach ($item->vidio as $item2)
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                                <article class="article article-style-b">
                                                    <div class="article-header">
                                                        <div class="article-image"
                                                            data-background="{{ asset('storage/vidio/'.$item2->thumbnail_vidio) }}">
                                                        </div>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-title">
                                                            <h2><a href="javascript:void(0)" style="text-decoration: none;">{{ $item2->judul_vidio }}</a></h2>
                                                        </div>
                                                        <p>{{ Str::limit($item2->deskripsi, 45, '...') }} </p>
                                                        <div class="article-cta">
                                                            <a href="{{ url('admin/get_detail_vidio_playlist/'.$item2->id) }}">Lihat Komentar <i class="fas fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        @endforeach
                                    @else
                                    <div class="col-12 mb-4">
                                        <div class="hero bg-primary text-white">
                                            <div class="hero-inner">
                                                <h2>Vidio Kosong</h2>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
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
