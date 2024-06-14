<x-auth>

    @slot('title')
        Login
    @endslot


    @slot('style')
        <!-- CSS Libraries -->
        <link rel="stylesheet"
            href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
    @endslot

    @slot('main')
        <div class="card card-primary">
            <div class="card-header">
                <h4>Login</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="" id="login_form" class="login_form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email"
                            type="email"
                            class="form-control email"
                            name="email"
                            id="email"
                            tabindex="1"
                            placeholder="Masukkan email anda ..."
                            required
                            autofocus>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="password" class="form-control password" id="password"
                                    placeholder="Masukkan Password Baru ..." id="password"
                                    name="password">
                                <button type="button" class="btn btn-outline-primary toggle-password">
                                    <i class="fa fa-eye"></i> Show
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="button"
                            class="btn btn-primary btn-lg btn-block btn-login"
                            tabindex="4">
                            Login
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @endslot

    @slot('script')
        <!-- JS Libraies -->
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.toggle-password', function() {
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

            $(document).on('click', '.btn-login', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('authenticate') }}',
                    type: 'POST',
                    data: {
                        "email" : $('#email').val(),
                        "password" : $('#password').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            iziToast.success({
                                message: response.isi,
                                position: 'topRight'
                            });
                            window.location.href = response.redirect_url;
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
                                    message: response.error_is_email,
                                    position: 'topRight'
                                });
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.error;
                        var errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value + '<br>';
                        });
                        iziToast.error({
                            title: 'Gagagal!',
                            message: errorMessages,
                            position: 'topRight'
                        });
                    }
                });
                $('#login_form')[0].reset();
            });

        </script>
        <!-- Page Specific JS File -->
    @endslot

</x-auth>
