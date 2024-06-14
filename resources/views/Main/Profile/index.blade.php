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
                        <div class="card card-profile">
                            <div class="card-body">
                                <h5 class="card-title text-center profile-title">PROFILE</h5>
                                <div class="row pt-5">
                                    <div class="col-lg-6">
                                        <form action="" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                                          <div class="row gy-4">

                                            <div class="col-md-6">
                                              <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                                            </div>

                                            <div class="col-md-6 ">
                                              <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                                            </div>

                                            <div class="col-md-12">
                                              <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                                            </div>

                                            <div class="col-md-12">
                                              <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                            </div>

                                          </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <form action="" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                                          <div class="row gy-4">

                                            <div class="col-md-6">
                                              <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                                            </div>

                                            <div class="col-md-6 ">
                                              <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                                            </div>

                                            <div class="col-md-12">
                                              <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                                            </div>

                                            <div class="col-md-12">
                                              <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
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

      </script>
    @endslot
  </x-pengguna.app>
