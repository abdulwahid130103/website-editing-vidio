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
                                <h5 class="card-title text-center profile-title">UPDATE PASSWORD</h5>
                                <form action="" method="post" class="php-email-form form_update_password_main" id="form_update_password_main" data-aos="fade-up" data-aos-delay="200">
                                    <div class="row pt-5 d-flex justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="row gy-4">

                                                <div class="col-lg-12">
                                                    <label class="text-danger font-italic"> * Password harus sesuai *</label>
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="hidden" value="{{ Auth::user()->id }}" id="id_user_profile_password">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-key"></i>
                                                            </span>
                                                            <input type="password" class="form-control"
                                                                placeholder="Masukkan Password Baru ..." id="password_profile"
                                                                name="password_profile">
                                                            <button type="button" class="btn btn-outline-primary toggle-password-profile">
                                                                <i class="fa fa-eye"></i> Show
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <label class="form-label" for="example-text-input">Konfirmasi Password</label>
                                                    <div class="mb-4 input-group">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-key"></i>
                                                        </span>
                                                        <input type="password" class="form-control" placeholder="Konfirmasi password ..."
                                                            id="konfirmasi_password_profile" name="konfirmasi_password_profile">
                                                        <button type="button" class="btn btn-outline-primary toggle-password-profile">
                                                            <i class="fa fa-eye"></i> Show
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-4 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary btn_update_password" id="btn_update_password">Update Password</button>
                                        </div>
                                    </div>
                                </form>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.toggle-password-profile', function() {
            $(this).toggleClass('show-password');
            var input = $(this).siblings('input');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).html('<i class="fa fa-eye-slash"></i> Hide');
            } else {
                input.attr('type', 'password');
                $(this).html('<i class="fa fa-eye"></i> Show');
            }
        });

        function reset_input(){
            $('#password_profile').val('');
            $('#konfirmasi_password_profile').val('');
        }


        $(document).on('click','.btn_update_password',function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'ingin update password !',
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var newPassword = $('#password_profile').val();
                        var confirmPassword = $('#konfirmasi_password_profile').val();
                        if (newPassword.trim() === '' || confirmPassword.trim() === '') {
                            iziToast.error({
                                message: 'Password baru harus diisi',
                                position: 'topRight'
                            });
                            return;
                        }

                        if (newPassword !== confirmPassword) {
                            iziToast.error({
                                message: 'Password tidak sama',
                                position: 'topRight'
                            });
                            return;
                        }

                        $.ajax({
                            url: `{{ route('penggunaupdate_password_main.store') }}`,
                            type: 'POST',
                            data: {
                                "password" : $("#password_profile").val(),
                            },
                            success:function(response){
                                if(response.status == 0){
                                    var errorMessages = "<ul>";
                                    console.log(response.errors);
                                    $.each(response.errors, function (key, value) {
                                        errorMessages += "<li>" + value + "</li>";
                                    });
                                    errorMessages += "</ul>";

                                    iziToast.error({
                                        message: errorMessages,
                                        position: 'topRight'
                                    });
                                }else{
                                    iziToast.success({
                                        title: 'Berhasil',
                                        message: response.success,
                                        position: 'topRight'
                                    });
                                    reset_input();
                                }
                            }
                        });
                        $('#form_update_password_main').reset();
                    } else {
                        Swal.fire('Cancel update data!');
                    }
                });
        });
      </script>
    @endslot
  </x-pengguna.app>
