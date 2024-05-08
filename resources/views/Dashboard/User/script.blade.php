<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function datatable_user() {
		let tabel_playlist = $('#datatable_user').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('user.index') }}",
			columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                   searchable: false 
                },
				{ 
                    data: 'username', 
                    name: 'username'
                },
				{ data: 'email', name: 'email' },
				{ data: 'role_id', name: 'role_id' },
				{
                     data: 'foto', 
                     name: 'foto',
                     render: function (data, type, full, meta) {
                        var assetUrl = "{{ asset('storage/user/') }}";
                        return '<figure class="avatar mr-2"><img src="' + assetUrl + '/' + data + '" alt="foto" style="object-fit: cover;"></figure>';
                    }
                },
				{ data: 'action', name: 'action' },
			]
		});
    }

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

    function showHideTombol(params){
        if(params == "tambah"){
            $('.modal-title-user').html('Tambah user');
            $('.simpan-data').removeClass('d-none');
            $('.edit-data').addClass('d-none');
            $('.password-data').addClass('d-none');
        }else if(params == "edit"){
            $('.modal-title-user').html('Edit user');
            $('.simpan-data').addClass('d-none');
            $('.edit-data').removeClass('d-none');
            $('.password-data').addClass('d-none');
        }else if(params == "detail"){
            $('.modal-title-user').html('Detail user');
            $('.simpan-data').addClass('d-none');
            $('.edit-data').addClass('d-none');
            $('.password-data').addClass('d-none');
        }else if(params == "password"){
            $('.modal-title-user').html('Password user');
            $('.simpan-data').addClass('d-none');
            $('.edit-data').addClass('d-none');
            $('.password-data').removeClass('d-none');
        }
        
    }

    function aksi_tambah_user() {
        $('.btn-tambah-data').click(function(e){
            selectionInput("tambah");
            e.preventDefault();
            $('#modaluser').modal('show');
            showHideTombol("tambah");
            $('.simpan-data').off('click').on('click',function() {
                var newPassword = $('#password').val();
                var confirmPassword = $('#konfirmasi-password').val();


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
                var formData = new FormData($('#userForm')[0]);
                formData.append('nama_lengkap', $('#nama_lengkap').val());
                formData.append('username', $('#username').val());
                formData.append('email', $('#email').val());
                formData.append('password', $('#password').val());
                formData.append('role_id', $('#role_id').val());
                formData.append('no_telfon', $('#no_telfon').val());
                formData.append('alamat', $('#alamat').val());
                formData.append('foto', $('input[type=file]')[0].files[0]); 
                $.ajax({
                    url: '{{ route('user.store') }}',
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
                                $('#modaluser').modal('hide');
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
                        $('#modaluser').modal('hide');
                        iziToast.error({
                            title: 'Gagagal!',
                            message: errorMessages,
                            position: 'topRight'
                        });
                    }
                });
                $('#userForm')[0].reset();
            });
        });
    }
    function selectionInput(selection){

        if(selection == "detail"){
            $('#nama_lengkap').attr('disabled', 'disabled');
            $('.nama_lengkap_container').removeClass('d-none');
            $('#username').attr('disabled', 'disabled');
            $('.username_container').removeClass('d-none');
            $('#email').attr('disabled', 'disabled');
            $('.email_container').removeClass('d-none');
            $('#role_id').attr('disabled', 'disabled');
            $('.role_id_container').removeClass('d-none');
            $('#no_telfon').attr('disabled', 'disabled');
            $('.no_telfon_container').removeClass('d-none');
            $('#alamat').attr('disabled', 'disabled');
            $('.alamat_container').removeClass('d-none');
            $('.input-foto-container').addClass('d-none');
            $('.label-password').addClass('d-none');
            $('.password-container').addClass('d-none');
            $('.password-container2').addClass('d-none');
            $('#card-foto').removeClass('d-none');
        }else if(selection == "tambah"){
            $('#nama_lengkap').removeAttr('disabled');
            $('.nama_lengkap_container').removeClass('d-none');
            $('#username').removeAttr('disabled');
            $('.username_container').removeClass('d-none');
            $('#email').removeAttr('disabled');
            $('.email_container').removeClass('d-none');
            $('#role_id').removeAttr('disabled');
            $('.role_id_container').removeClass('d-none');
            $('#no_telfon').removeAttr('disabled');
            $('.no_telfon_container').removeClass('d-none');
            $('#alamat').removeAttr('disabled');
            $('.alamat_container').removeClass('d-none');
            $('.input-foto-container').removeClass('d-none');
            $('.label-password').removeClass('d-none');
            $('.password-container').removeClass('d-none');
            $('.password-container2').removeClass('d-none');
            $('#card-foto').addClass('d-none');
        }else if(selection == "edit"){
            $('#nama_lengkap').removeAttr('disabled');
            $('#username').removeAttr('disabled');
            $('#email').removeAttr('disabled');
            $('#role_id').removeAttr('disabled');
            $('#no_telfon').removeAttr('disabled');
            $('#alamat').removeAttr('disabled');
            $('.input-foto-container').removeClass('d-none');
            $('.label-password').removeClass('d-none');
            $('.password-container').removeClass('d-none');
            $('.password-container2').removeClass('d-none');
            $('#card-foto').addClass('d-none');
        }else if(selection == "password"){
            $('#card-foto').addClass('d-none');
            $('#nama_lengkap').removeAttr('disabled');
            $('.nama_lengkap_container').addClass('d-none');
            $('#username').removeAttr('disabled');
            $('.username_container').addClass('d-none');
            $('#email').removeAttr('disabled');
            $('.email_container').addClass('d-none');
            $('#role_id').removeAttr('disabled');
            $('.role_id_container').addClass('d-none');
            $('#no_telfon').removeAttr('disabled');
            $('.no_telfon_container').addClass('d-none');
            $('#alamat').removeAttr('disabled');
            $('.alamat_container').addClass('d-none');
            $('.input-foto-container').addClass('d-none');
            $('.label-password').removeClass('d-none');
            $('.password-container').removeClass('d-none');
            $('.password-container2').removeClass('d-none');
        }
    }
    function aksi_detail_user(){ 
        $('body').on('click', '.btn-user-detail', function(e) {
            selectionInput("detail");
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: 'user/' + id,
                type: 'GET',
                success: function(response) {
                    showHideTombol("detail");
                    $('#modaluser').modal('show');
                    $('#nama_lengkap').val(response.data.nama_lengkap);
                    $('#username').val(response.data.username);
                    $('#email').val(response.data.email);
                    $('#no_telfon').val(response.data.no_telfon);
                    $('#alamat').val(response.data.alamat);
                    $('#role_id').empty()
                    $.each(response.role, function(key, value) {
                        if (value.id == response.data.role_id) {
                            $('#role_id').append('<option value="' + value.id + '" selected>' + value.nama_role + '</option>');
                        } else {
                            $('#role_id').append('<option value="' + value.id + '">' + value.nama_role + '</option>');
                        }
                    });

                    var imageSrc = response.data.foto;
                    if (imageSrc) {
                        $('#get_foto').attr("src", `{{ asset('storage/user/${imageSrc}' ) }} `);;
                        $('#card-foto').removeClass("d-none");
                    } else {
                        $('#card-foto').addClass("d-none");
                    }
                }
            });
          
        });
    }
    function aksi_ganti_password_user(){ 
        $('body').on('click', '.btn-user-ganti-password', function(e) {
            e.preventDefault();
            selectionInput("password");
            showHideTombol("password");
            $('#modaluser').modal('show');
            var id = $(this).data('id');
            $('.password-data').off('click').on('click',function() {
                var newPassword = $('#password').val();
                var confirmPassword = $('#konfirmasi-password').val();


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

                var formData = new FormData($('#userForm')[0]);
                formData.append('id', id);
                formData.append('password', $('#password').val());

                $.ajax({
                    url: 'user/password',
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
                                $('#modaluser').modal('hide');
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
                        $('#modaluser').modal('hide');
                        iziToast.error({
                            title: 'Gagagal!',
                            message: errorMessages,
                            position: 'topRight'
                        });
                    }
                });
                $('#userForm')[0].reset();
            });
         
          
        });
    }

    // function aksi_edit_playlist(){
    //     $('body').on('click', '.btn-playlist-edit', function(e) {
    //         e.preventDefault();
    //         var id = $(this).data('id');
    //         $.ajax({
    //             url: 'playlist/' + id + "/edit",
    //             type: 'GET',
    //             success: function(response) {
    //                 showHideTombol("edit");
    //                 $('#modalplaylist').modal('show');
    //                 $('#nama_playlist').val(response.data.nama_playlist);
    //                 $('#kategori_id').empty()
    //                 $.each(response.kategori, function(key, value) {
    //                     if (value.id == response.data.kategori_id) {
    //                         $('#kategori_id').append('<option value="' + value.id + '" selected>' + value.nama_kategori + '</option>');
    //                     } else {
    //                         $('#kategori_id').append('<option value="' + value.id + '">' + value.nama_kategori + '</option>');
    //                     }
    //                 });

    //                 var imageSrc = response.data.thumbnail_playlist;
    //                 if (imageSrc) {
    //                     $('#get_thumbnail_playlist').attr("src", `{{ asset('storage/playlist/${imageSrc}' ) }} `);;
    //                     $('#card-thumbnail-playlist').removeClass("d-none");
    //                 } else {
    //                     $('#card-thumbnail-playlist').addClass("d-none");
    //                 }
    //                 $('#thumbnail_playlist_lama').val(imageSrc);
    //                 var idNew = response.data.id;
    //                 $('.edit-data').off('click').on('click',function() {
    //                     var formData = new FormData($('#playlistForm')[0]);
    //                     formData.append('_method', 'PUT');
    //                     formData.append('nama_playlist', $('#nama_playlist').val());
    //                     formData.append('kategori_id', $('#kategori_id').val());
    //                     formData.append('thumbnail_playlist_lama', $('#thumbnail_playlist_lama').val());
    //                     formData.append('thumbnail_playlist', $('input[type=file]')[0].files[0]); 
    //                     $.ajax({
    //                         url: 'playlist/' + idNew,
    //                         type: 'POST',
    //                         dataType: 'json',
    //                         data: formData,
    //                         contentType: false,
    //                         processData: false,
    //                         success:function(response){
    //                             if(response.status == 0){
    //                                 var errorMessages = "<ul>";
    //                                 console.log(response.errors);
    //                                 $.each(response.errors, function (key, value) {
    //                                     errorMessages += "<li>" + value + "</li>";
    //                                 });
    //                                 errorMessages += "</ul>";

    //                                 iziToast.error({
    //                                     message: errorMessages,
    //                                     position: 'topRight'
    //                                 });
    //                             }else{
    //                                 iziToast.success({
    //                                     title: 'Berhasil',
    //                                     message: response.success,
    //                                     position: 'topRight'
    //                                 });
    //                             }
    //                             $('#modalplaylist').modal('hide');
    //                             $('#datatable_playlist').DataTable().ajax.reload();
    //                             reset_input();
    //                         }
    //                     });
    //                     $('#playlistForm').reset();
    //                 });
    //             }
    //         });
          
    //     });
    // }

    function aksi_hapus_user(){
        $('body').on('click', '.btn-user-hapus', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
            title: 'Apakah anda yakin?',
            text: 'ingin menghapus data ini!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: 'user/' + id,
                        type: 'DELETE',
                        success:function(response){
                            iziToast.success({
                                title: 'Berhasil',
                                message: response.success,
                                position: 'topRight'
                            });
                        }
                    });
                    $('#datatable_user').DataTable().ajax.reload();
            } else {
                swal('Cancel hapus data!');
            }
            });
        });
    }

    

    function reset_input(){
        $('#nama_lengkap').val('');
        $('#username').val('');
        $('#email').val('');
        $('#no_telfon').val('');
        $('#alamat').val('');
        $('#password').val('');
        $('#konfirmasi-password').val('');
    }

    $('#modaluser').on('hidden.bs.modal',function(){
        reset_input();
    });
    
    $(document).ready(function(){
        datatable_user();
        aksi_tambah_user();
        aksi_detail_user();
        aksi_ganti_password_user();
        // aksi_edit_playlist();
        aksi_hapus_user();
    });
</script>