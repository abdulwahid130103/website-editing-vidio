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
				{ data: 'type_vidio', name: 'type_vidio' },
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

    function openLoading(title_open,deskripsi_open) {
        Swal.fire({
            title: title_open,
            html: deskripsi_open,
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });
    }

    function closeLoading() {
        Swal.close();
        // You can add additional logic here after the loading is complete
        Swal.fire({
            icon: 'success',
            title: 'Operasi Selesai',
            text: 'Proses pemuatan telah selesai!',
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
                if($('input[type=file]')[0].files[0] != undefined || $('input[type=file]')[0].files[0] != null || $('input[type=file]')[0].files[0] != ""){
                    formData.append('upload_vidio', $('input[type=file]')[0].files[0]);
                }
                if(
                    $('#link').val() != undefined ||
                    $('#link').val() != null ||
                    $('#link').val() != ""){
                    formData.append('link_vidio', $('#link').val());
                }
                formData.append('is_active', $('#is_active').val());
                formData.append('type_vidio', $('input[name="upload_vidio_select"]:checked').val());
                formData.append('thumbnail_vidio', $('input[type=file]')[1].files[0]);
                $('#modalvidio').modal('hide');
                $.ajax({
                    url: '{{ route('vidio.store') }}',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        openLoading('Mohon Tunggu...! ','Sedang Upload Vidio')
                    },
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            closeLoading();
                            iziToast.success({
                                title: 'Berhasil',
                                message: response.success,
                                position: 'topRight'
                            });
                            $('#modalvidio').modal('hide');
                            $('#datatable_vidio').DataTable().ajax.reload();
                        } else {
                            Swal.close();
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
                            }else if(response.error_file){
                                iziToast.error({
                                    message: response.error_file,
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
                beforeSend: function() {
                    openLoading("Mohon Ditunggu ...!",'Sedang Load Vidio ...!')
                },
                success: function(response) {
                    showHideTombol("edit");
                    Swal.close();
                    if (response.data.type_vidio == 'link') {
                        $('input[name="upload_vidio_select"][value="link"]').prop('checked', true).trigger('change');
                        var videoURL = response.data.link;
                        var videoId = null;
                        $('#link').val(videoURL);

                        if (videoURL.includes('youtube.com')) {
                            videoId = videoURL.replace('https://www.youtube.com/embed/', '');
                        } else if (videoURL.includes('youtu.be')) {
                            videoId = videoURL.replace('https://youtu.be/', '');
                        }
                        if (videoId) {
                            var embedURL = 'https://www.youtube.com/embed/' + videoId;
                            $('#videoPlayer').replaceWith('<iframe id="videoPlayer" data-id="link" width="100%" height="315" src="' + embedURL + '" frameborder="0" allowfullscreen></iframe>');
                        } else {
                            $('#videoPlayer').replaceWith(`<img width="100%" height="315" id="videoPlayer" src="{{ asset('img/not_found.jpg') }}" alt="notfound">`);
                        }
                        $('#display_vidio_container').removeClass('d-none');
                    } else if (response.data.type_vidio == 'upload') {
                        $('input[name="upload_vidio_select"][value="upload"]').prop('checked', true).trigger('change');
                        $('#display_vidio_container').removeClass('d-none');
                        $('#videoPlayer').replaceWith(`
                            <video id="videoPlayer" data-id="upload" width="100%" controls>
                                <source id="videoSource" src="${response.video_link}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        `);
                        $('.custom-file-label').text(response.data.link);
                    }
                    $('#modalvidio').modal('show');
                    $('#judul').val(response.data.judul);
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
                        $('#modalvidio').modal('hide');
                        var formData = new FormData($('#playlistForm')[0]);
                        formData.append('_method', 'PUT');
                        formData.append('judul', $('#judul').val());
                        if($('input[type=file]')[0].files[0] != undefined || $('input[type=file]')[0].files[0] != null || $('input[type=file]')[0].files[0] != ""){
                            formData.append('upload', $('input[type=file]')[0].files[0]);
                        }
                        if(
                            $('#link').val() != undefined ||
                            $('#link').val() != null ||
                            $('#link').val() != ""){
                            formData.append('link', $('#link').val());
                        }
                        formData.append('type_vidio', $('input[name="upload_vidio_select"]:checked').val());
                        formData.append('deskripsi', $('#deskripsi').val());
                        formData.append('playlist_id', $('#playlist_id').val());
                        formData.append('is_active', $('#is_active').val());
                        formData.append('thumbnail_vidio_lama', $('#thumbnail_vidio_lama').val());
                        formData.append('thumbnail_vidio', $('input[type=file]')[1].files[0]);
                        $.ajax({
                            url: 'vidio/' + idNew,
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                openLoading('Mohon Tunggu...! ','Sedang Update Vidio')
                            },
                            success:function(response){
                                if(response.error){
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
                                }else if(response.error_file){
                                    iziToast.error({
                                        message: response.error_file,
                                        position: 'topRight'
                                    });
                                }else{
                                    closeLoading();
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
            Swal.fire({
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

    function upload_vidio_players() {
        $('#customFile').on('change', function(event) {

            $('#videoPlayer').replaceWith(`    <video id="videoPlayer" data-id="upload" width="100%" controls>
                                <source id="videoSource" src="" ype="video/mp4">
                                Your browser does not support the video tag.
                            </video>`);
            var file = event.target.files[0];
            var videoType = /^video\//;

            if (!videoType.test(file.type)) {
                alert('Please select a valid video file.');
                return;
            }
            var videoURL = URL.createObjectURL(file);
            // console.log(videoURL);
            $('#videoSource').attr('src', videoURL);
            $('#videoPlayer')[0].load();
            $('.custom-file-label').text(file.name);
            $('#display_vidio_container').removeClass('d-none');
        });

        $('#link').on('change', function(event) {
            var videoURL = $(this).val();
            var videoId = null;

            if (videoURL.includes('youtube.com')) {
                videoId = videoURL.replace('https://www.youtube.com/embed/', '');
            } else if (videoURL.includes('youtu.be')) {
                videoId = videoURL.replace('https://youtu.be/', '');
            }
            if (videoId) {
                var embedURL = 'https://www.youtube.com/embed/' + videoId;
                $('#videoPlayer').replaceWith('<iframe id="videoPlayer" data-id="link" width="100%" height="315" src="' + embedURL + '" frameborder="0" allowfullscreen></iframe>');
            } else {
                $('#videoPlayer').replaceWith(`<img width="100%" height="315" id="videoPlayer" src="{{ asset('img/not_found.jpg') }}" alt="notfound">`);
            }
            $('#display_vidio_container').removeClass('d-none');
        });

    }

    function reset_vidio_players(){
        $('#hapus_vidio_display').on('click', function() {
            $('#customFile').val('');
            $('#videoSource').attr('src', '');
            let idDataVidio = $('#videoPlayer').data("id");
            // console.log(idDataVidio);
            if(idDataVidio == "upload"){
                $('#videoPlayer')[0].load();
                $('.custom-file-label').text('Choose file');
                $('#display_vidio_container').addClass('d-none');
            }else{
                $('#link').val("");
                $('#display_vidio_container').addClass('d-none');
            }
        });
    }

    function reset_input(){
        $('#judul').val('');
        $('#link').val('');
        $('#deskripsi').val('');
        $('#card-thumbnail-vidio').addClass("d-none");
        $('#customFile').val('');
        $('#videoSource').attr('src', '');
        let idDataVidio = $('#videoPlayer').data("id");
        // console.log(idDataVidio);
        if(idDataVidio == "upload"){
            $('#videoPlayer')[0].load();
            $('.custom-file-label').text('Choose file');
            $('#display_vidio_container').addClass('d-none');
        }else{
            $('#link').val("");
            $('#display_vidio_container').addClass('d-none');
        }
    }

    $('#modalvidio').on('hidden.bs.modal',function(){
        $('#judul').val('');
        $('#link').val('');
        $('#deskripsi').val('');
        $('#card-thumbnail-vidio').addClass("d-none");
        $('#customFile').val('');
        $('#videoSource').attr('src', '');
        let idDataVidio = $('#videoPlayer').data("id");
        // console.log(idDataVidio);
        if(idDataVidio == "upload"){
            $('#videoPlayer')[0].load();
            $('.custom-file-label').text('Choose file');
            $('#display_vidio_container').addClass('d-none');
        }else{
            $('#link').val("");
            $('#display_vidio_container').addClass('d-none');
        }
    });

    $(document).ready(function(){
        datatable_vidio();
        aksi_tambah_vidio();
        aksi_edit_vidio();
        aksi_hapus_vidio();
        upload_vidio_players();
        reset_vidio_players();
        $('input[name="upload_vidio_select"]').on('change', function() {
            $('#customFile').val('');
            $('#videoSource').attr('src', '');
            let idDataVidio = $('#videoPlayer').data("id");
            // console.log(idDataVidio);
            if(idDataVidio == "upload"){
                $('#videoPlayer')[0].load();
                $('.custom-file-label').text('Choose file');
                $('#display_vidio_container').addClass('d-none');
            }else{
                $('#link').val("");
                $('#display_vidio_container').addClass('d-none');
            }
            if ($(this).val() === 'link') {
                $('#link_vidio_container').removeClass('d-none');
                $('#upload_vidio_container').addClass('d-none');
            } else if ($(this).val() === 'upload') {
                $('#link_vidio_container').addClass('d-none');
                $('#upload_vidio_container').removeClass('d-none');
            }
        });

        // Trigger change event on page load to set the correct initial state
        $('input[name="upload_vidio_select"]:checked').trigger('change');


    });
</script>
