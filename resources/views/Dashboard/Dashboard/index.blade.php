<x-admin.app >

    @slot('title')
        General Dashboard
    @endslot
    @slot('type_menu')
        dashboard
    @endslot
    @slot('style')
        <!-- CSS Libraries -->
        <link rel="stylesheet"
            href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
             <!-- CSS Libraries -->
        <link rel="stylesheet"
        href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
        <style>
            .active-chart{
                background: #6777ef !important;
                color: #fff !important;
            }
        </style>
    @endslot

    @slot('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>User</h4>
                            </div>
                            <div class="card-body">
                                {{ $qtyUser }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Vidio</h4>
                            </div>
                            <div class="card-body">
                                {{ $qtyVidio }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Playlist</h4>
                            </div>
                            <div class="card-body">
                                {{ $qtyPlaylist }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Kategori</h4>
                            </div>
                            <div class="card-body">
                                {{ $qtyKategori }}
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
         <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
         <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
         <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
         <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
         <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
         <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
 
         <!-- Page Specific JS File -->
         <script src="{{ asset('js/page/modules-chartjs.js') }}"></script>
         <script src="{{ asset('js/page/index-0.js') }}"></script>
    @endslot
</x-admin.app>