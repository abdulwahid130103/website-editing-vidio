
@if (Auth::user())
<section>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalpasswordprofile">
        <form id="passwordprofileForm">
        @csrf
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title modal-title-passwordprofile">Update Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
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
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary password-profile-data">Ganti Password</button>
            </div>
          </div>
        </div>
        </form>
      </div>
</section>
@endif
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

    $(document).on('click','.tombol-ganti-password',function(e){
        e.preventDefault();
        $('#modalpasswordprofile').modal('show');
        $('.password-profile-data').off('click').on('click',function() {
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
                url: "{{ route('profile.password') }}",
                type: 'POST',
                data: {
                    "password" : $('#password_profile').val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        iziToast.success({
                            title: 'Berhasil',
                            message: response.success,
                            position: 'topRight'
                        });
                        $('#modalpasswordprofile').modal('hide');
                    } else {
                        if (Array.isArray(response.error)) {
                            var errorMessages = "<ul>";
                            $.each(response.error, function (key, value) {
                                errorMessages += "<li>" + value + "</li>";
                            });
                            errorMessages += "</ul>";
                            $('#modalpasswordprofile').modal('hide');
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
                    reset_input();
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.error;
                    var errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value + '<br>';
                    });
                    $('#modalpasswordprofile').modal('hide');
                    iziToast.error({
                        title: 'Gagagal!',
                        message: errorMessages,
                        position: 'topRight'
                    });
                }
            });
            $('#passwordprofileForm')[0].reset();
        });
    });

    function reset_input(){
        $('#password_profile').val('');
        $('#konfirmasi_password_profile').val('');
    }

    $('#modalpasswordprofile').on('hidden.bs.modal',function(){
        reset_input();
    });
</script>
