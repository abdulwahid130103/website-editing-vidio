<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function datatable_playlist() {
		let tabel_playlist = $('#datatable_playlist').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('playlist.index') }}",
			columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                   searchable: false 
                },
				{ 
                    data: 'nama_playlist', 
                    name: 'nama_playlist'
                },
				{ 
                    data: 'deskripsi_playlist', 
                    name: 'deskripsi_playlist'
                },
				{ data: 'kategori_id', name: 'kategori_id' },
				{
                     data: 'thumbnail_playlist', 
                     name: 'thumbnail_playlist',
                     render: function (data, type, full, meta) {
                        var assetUrl = "{{ asset('storage/playlist') }}";
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

    function aksi_tambah_playlist() {
        $('.btn-tambah-data').click(function(e){
            e.preventDefault();
            showHideTombol("tambah");
            $('#modalplaylist').modal('show');
            $('.simpan-data').off('click').on('click',function() {
                var formData = new FormData($('#playlistForm')[0]);
                formData.append('nama_playlist', $('#nama_playlist').val());
                formData.append('deskripsi_playlist', $('#deskripsi_playlist').val());
                formData.append('kategori_id', $('#kategori_id').val());
                formData.append('thumbnail_playlist', $('input[type=file]')[0].files[0]); 
                $.ajax({
                    url: '{{ route('playlist.store') }}',
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
                            $('#modalplaylist').modal('hide');
                            $('#datatable_playlist').DataTable().ajax.reload();
                        } else {
                            // console.log(response.error);
                            if (Array.isArray(response.error)) {
                                var errorMessages = "<ul>";
                                $.each(response.error, function (key, value) {
                                    errorMessages += "<li>" + value + "</li>";
                                });
                                errorMessages += "</ul>";
                                $('#modalplaylist').modal('hide');
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
                        $('#modalplaylist').modal('hide');
                        iziToast.error({
                            title: 'Gagagal!',
                            message: errorMessages,
                            position: 'topRight'
                        });
                    }
                });
                $('#playlistForm')[0].reset();
            });
        });
    }

    function showHideTombol(params){
        if(params == "tambah"){
            $('.modal-title-playlist').html('Tambah Playlist');
            $('.simpan-data').removeClass('d-none');
            $('.edit-data').addClass('d-none');
        }else{
            $('.modal-title-playlist').html('Edit Playlist');
            $('.simpan-data').addClass('d-none');
            $('.edit-data').removeClass('d-none');
        }
    }

    function aksi_edit_playlist(){
        $('body').on('click', '.btn-playlist-edit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: 'playlist/' + id + "/edit",
                type: 'GET',
                success: function(response) {
                    showHideTombol("edit");
                    $('#modalplaylist').modal('show');
                    $('#nama_playlist').val(response.data.nama_playlist);
                    $('#deskripsi_playlist').val(response.data.deskripsi_playlist);
                    $('#kategori_id').empty()
                    $.each(response.kategori, function(key, value) {
                        if (value.id == response.data.kategori_id) {
                            $('#kategori_id').append('<option value="' + value.id + '" selected>' + value.nama_kategori + '</option>');
                        } else {
                            $('#kategori_id').append('<option value="' + value.id + '">' + value.nama_kategori + '</option>');
                        }
                    });

                    var imageSrc = response.data.thumbnail_playlist;
                    if (imageSrc) {
                        $('#get_thumbnail_playlist').attr("src", `{{ asset('storage/playlist/${imageSrc}' ) }} `);;
                        $('#card-thumbnail-playlist').removeClass("d-none");
                    } else {
                        $('#card-thumbnail-playlist').addClass("d-none");
                    }
                    $('#thumbnail_playlist_lama').val(imageSrc);
                    var idNew = response.data.id;
                    $('.edit-data').off('click').on('click',function() {
                        var formData = new FormData($('#playlistForm')[0]);
                        formData.append('_method', 'PUT');
                        formData.append('nama_playlist', $('#nama_playlist').val());
                        formData.append('deskripsi_playlist', $('#deskripsi_playlist').val());
                        formData.append('kategori_id', $('#kategori_id').val());
                        formData.append('thumbnail_playlist_lama', $('#thumbnail_playlist_lama').val());
                        formData.append('thumbnail_playlist', $('input[type=file]')[0].files[0]); 
                        $.ajax({
                            url: 'playlist/' + idNew,
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
                                $('#modalplaylist').modal('hide');
                                $('#datatable_playlist').DataTable().ajax.reload();
                                reset_input();
                            }
                        });
                        $('#playlistForm').reset();
                    });
                }
            });
          
        });
    }

    function aksi_hapus_playlist(){
        $('body').on('click', '.btn-playlist-hapus', function(e) {
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
                        url: 'playlist/' + id,
                        type: 'DELETE',
                        success:function(response){
                            iziToast.success({
                                title: 'Berhasil',
                                message: response.success,
                                position: 'topRight'
                            });
                        }
                    });
                    $('#datatable_playlist').DataTable().ajax.reload();
            } else {
                swal('Cancel hapus data!');
            }
            });
        });
    }

    function reset_input(){
        $('#nama_playlist').val('');
        $('#deskripsi_playlist').val('');
        $('#card-thumbnail-playlist').addClass("d-none");
    }

    $('#modalplaylist').on('hidden.bs.modal',function(){
        $('#nama_playlist').val('');
        $('#deskripsi_playlist').val('');
        $('#card-thumbnail-playlist').addClass("d-none");
    });
    
    $(document).ready(function(){
        datatable_playlist();
        aksi_tambah_playlist();
        aksi_edit_playlist();
        aksi_hapus_playlist();
    });
</script>