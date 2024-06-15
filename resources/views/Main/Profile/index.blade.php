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
                                <form action="" method="post" class="php-email-form form_profile_main" id="form_profile_main" data-aos="fade-up" data-aos-delay="200">
                                    <div class="row pt-5">
                                        <div class="col-lg-6">
                                            <div class="row gy-4">

                                            <div class="col-md-6">
                                                <input type="text" name="username_profile" class="form-control username_profile" id="username_profile" placeholder="Masukkan username ..." required="">
                                            </div>

                                            <div class="col-md-6 ">
                                                <input type="text" class="form-control nama_lengkap_profile" name="nama_lengkap_profile" id="nama_lengkap_profile" placeholder="Masukkan nama lengkap ..." required="">
                                            </div>

                                            <div class="col-md-12">
                                                <input type="email" class="form-control email_profile" name="email_profile" id="email_profile" placeholder="Masukkan email ..." required="">
                                            </div>

                                            <div class="col-md-12">
                                                <input type="text" class="form-control no_telfon_profile" name="no_telfon_profile" id="no_telfon_profile" placeholder="Masukkan no telfon ..." required="">
                                            </div>

                                            <div class="col-md-12">
                                                <textarea class="form-control alamat_profile" name="alamat_profile" id="alamat_profile" rows="6" placeholder="Masukkan alamat ..." required=""></textarea>
                                            </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control upload_foto_lama d-none" name="upload_foto_lama" id="upload_foto_lama" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                            <div class="image-wrapper">
                                                <img class="display_profile" src="{{ asset('img/user_profile.jpg') }}" id="display_profile" alt="">
                                            </div>
                                            <input type="file" class="form-control upload_foto" name="upload_foto" id="upload_foto" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                        </div>
                                        <div class="col-lg-12 mt-4 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary btn_update_profile_main" id="btn_update_profile_main">Update Profile</button>
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

        function getProfile() {
            $('#upload_foto').val('');
            $.ajax({
                url: `{{ route('penggunamain.profile.get_profile') }}`,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#nama_lengkap_profile').val(response.data.nama_lengkap);
                    $('#username_profile').val(response.data.username);
                    $('#email_profile').val(response.data.email);
                    $('#no_telfon_profile').val(response.data.no_telfon);
                    $('#alamat_profile').val(response.data.alamat);

                    var imageSrc = response.data.foto;
                    if (imageSrc) {
                        $('#display_profile').attr("src", `{{ asset('storage/user/${imageSrc}' ) }} `);
                    } else {
                        $('#display_profile').attr("src", `{{ asset('img/user_profile.jpg' ) }} `);
                    }
                    $('#upload_foto_lama').val(imageSrc);
                    var idNew = response.data.id;

                    $('.btn_update_profile_main').off('click').on('click',function() {
                        Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: 'ingin update profile !',
                        icon: 'warning',
                        showDenyButton: true,
                        showCancelButton: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                var formData = new FormData($('#form_profile_main')[0]);
                                formData.append('_method', 'PUT');
                                formData.append('nama_lengkap', $('#nama_lengkap_profile').val());
                                formData.append('username', $('#username_profile').val());
                                formData.append('email', $('#email_profile').val());
                                formData.append('no_telfon', $('#no_telfon_profile').val());
                                formData.append('alamat', $('#alamat_profile').val());
                                formData.append('foto_lama_profile', $('#upload_foto_lama').val());
                                formData.append('foto_profile', $('input[type=file]')[0].files[0]);
                                $.ajax({
                                    url: `{{ url('pengguna/update_password_profile') }}`,
                                    type: 'POST',
                                    dataType: 'json',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
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
                                        }
                                        getProfile();
                                    }
                                });
                                $('#form_profile_main').reset();
                            } else {
                                Swal.fire('Cancel update data!');
                            }
                        });
                    });
                }
            });
        }

        $(document).ready(function () {
            getProfile();
        });
      </script>
    @endslot
  </x-pengguna.app>
