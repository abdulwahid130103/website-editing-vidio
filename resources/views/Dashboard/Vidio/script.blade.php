<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function datatable_vidio() {
		let tabel_playlist = $('#datatable_vidio').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('vidio.index') }}",
			columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                   searchable: false 
                },
				{ data: 'judul',name: 'judul'},
				{ data: 'deskripsi', name: 'deskripsi' },
				{ data: 'playlist_id', name: 'playlist_id' },
				{ data: 'tanggal_upload',name: 'tanggal_upload'},
				{ data: 'link', name: 'link' },
				{ 
                    data: 'is_active', 
                    name: 'is_active',
                    render: function (data, type, full, meta) {
                        var isNonaktif = (data == 0);
                        var badgeClass = isNonaktif ? 'badge badge-danger' : 'badge badge-success';
                        var valueData = isNonaktif ? 'Private' : 'Publish';
                        return '<div class="badge ' + badgeClass + '">' + valueData + '</div>';
                    }
                },
                {
                     data: 'thumbnail_vidio', 
                     name: 'thumbnail_vidio',
                     render: function (data, type, full, meta) {
                        var assetUrl = "{{ asset('storage/vidio') }}";
                        return `
                        <div class="product-item">
                            <div class="product-image">
                            <img alt="image" src="${assetUrl}/${data}" class="img-fluid">
                            </div>
                        </div>
                        `;
                    }
                },
				{ data: 'action', name: 'action' },
			]
		});
    }

    function aksi_tambah_vidio() {
        $('.btn-tambah-data').click(function(e){
            e.preventDefault();
            showHideTombol("tambah");
            $('#modalvidio').modal('show');
            $('.simpan-data').off('click').on('click',function() {
                var formData = new FormData($('#vidioForm')[0]);
                formData.append('judul', $('#judul').val());
                formData.append('link', $('#link').val());
                formData.append('deskripsi', $('#deskripsi').val());
                formData.append('playlist_id', $('#playlist_id').val());
                formData.append('is_active', $('#is_active').val());
                formData.append('thumbnail_vidio', $('input[type=file]')[0].files[0]); 
                $.ajax({
                    url: '{{ route('vidio.store') }}',
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
                            $('#modalvidio').modal('hide');
                            $('#datatable_vidio').DataTable().ajax.reload();
                        } else {
                            // console.log(response.error);
                            if (Array.isArray(response.error)) {
                                var errorMessages = "<ul>";
                                $.each(response.error, function (key, value) {
                                    errorMessages += "<li>" + value + "</li>";
                                });
                                errorMessages += "</ul>";
                                $('#modalvidio').modal('hide');
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
                        $('#modalvidio').modal('hide');
                        iziToast.error({
                            title: 'Gagagal!',
                            message: errorMessages,
                            position: 'topRight'
                        });
                    }
                });
                $('#vidioForm')[0].reset();
            });
        });
    }

    function showHideTombol(params){
        if(params == "tambah"){
            $('.modal-title-vidio').html('Tambah Vidio');
            $('.simpan-data').removeClass('d-none');
            $('.edit-data').addClass('d-none');
        }else{
            $('.modal-title-vidio').html('Edit Vidio');
            $('.simpan-data').addClass('d-none');
            $('.edit-data').removeClass('d-none');
        }
    }

    function aksi_edit_vidio(){
        $('body').on('click', '.btn-vidio-edit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: 'vidio/' + id + "/edit",
                type: 'GET',
                success: function(response) {
                    showHideTombol("edit");
                    $('#modalvidio').modal('show');
                    $('#judul').val(response.data.judul);
                    $('#link').val(response.data.link);
                    $('#deskripsi').val(response.data.deskripsi);
                    $('#playlist_id').empty()
                    $.each(response.playlist, function(key, value) {
                        if (value.id == response.data.playlist_id) {
                            $('#playlist_id').append('<option value="' + value.id + '" selected>' + value.nama_playlist + '</option>');
                        } else {
                            $('#playlist_id').append('<option value="' + value.id + '">' + value.nama_playlist + '</option>');
                        }
                    });
                    $('#is_active').empty()
                    var data_is_active = `
                        <option value="1" ${response.data.is_active == 1 ? 'selected' : ''}>Publish</option>
                        <option value="0" ${response.data.is_active == 0 ? 'selected' : ''}>Private</option>
                    `;
                    $('#is_active').append(data_is_active)

                    var imageSrc = response.data.thumbnail_vidio;
                    if (imageSrc) {
                        $('#get_thumbnail_vidio').attr("src", `{{ asset('storage/vidio/${imageSrc}' ) }} `);;
                        $('#card-thumbnail-vidio').removeClass("d-none");
                    } else {
                        $('#card-thumbnail-vidio').addClass("d-none");
                    }
                    $('#thumbnail_vidio_lama').val(imageSrc);
                    var idNew = response.data.id;
                    $('.edit-data').off('click').on('click',function() {
                        var formData = new FormData($('#playlistForm')[0]);
                        formData.append('_method', 'PUT');
                        formData.append('judul', $('#judul').val());
                        formData.append('link', $('#link').val());
                        formData.append('deskripsi', $('#deskripsi').val());
                        formData.append('playlist_id', $('#playlist_id').val());
                        formData.append('is_active', $('#is_active').val());
                        formData.append('thumbnail_vidio_lama', $('#thumbnail_vidio_lama').val());
                        formData.append('thumbnail_vidio', $('input[type=file]')[0].files[0]); 
                        $.ajax({
                            url: 'vidio/' + idNew,
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
                                $('#modalvidio').modal('hide');
                                $('#datatable_vidio').DataTable().ajax.reload();
                                reset_input();
                            }
                        });
                        $('#vidioForm').reset();
                    });
                }
            });
          
        });
    }

    function aksi_hapus_vidio(){
        $('body').on('click', '.btn-vidio-hapus', function(e) {
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
                        url: 'vidio/' + id,
                        type: 'DELETE',
                        success:function(response){
                            iziToast.success({
                                title: 'Berhasil',
                                message: response.success,
                                position: 'topRight'
                            });
                        }
                    });
                    $('#datatable_vidio').DataTable().ajax.reload();
            } else {
                swal('Cancel hapus data!');
            }
            });
        });
    }
    function reset_input(){
        $('#judul').val('');
        $('#link').val('');
        $('#deskripsi').val('');
        $('#card-thumbnail-vidio').addClass("d-none");
    }

    $('#modalvidio').on('hidden.bs.modal',function(){
        $('#judul').val('');
        $('#link').val('');
        $('#deskripsi').val('');
        $('#card-thumbnail-vidio').addClass("d-none");
    });
    $(document).ready(function(){
        datatable_vidio();
        aksi_tambah_vidio();
        aksi_edit_vidio();
        aksi_hapus_vidio();
    });
</script>