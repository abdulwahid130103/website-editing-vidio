<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function datatable_kategori() {
		let tabel_role = $('#datatable_kategori').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('kategori.index') }}",
			columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                   searchable: false
                },
				{ data: 'nama_kategori', name: 'nama_kategori' },
				{ data: 'action', name: 'action' },
			]
		});
    }

    function aksi_tambah_kategori() {
        $('.btn-tambah-data').click(function(e){
            e.preventDefault();
            showHideTombol("tambah");
            $('#modalkategori').modal('show');
            $('.simpan-data').off('click').on('click',function() {
                $.ajax({
                    url: '{{ route('kategori.store') }}',
                    type: 'POST',
                    data: {
                        "nama_kategori" : $('#nama_kategori').val(),
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
                            $('#modalkategori').modal('hide');
                            $('#datatable_kategori').DataTable().ajax.reload();
                        } else {
                            if (Array.isArray(response.error)) {
                                var errorMessages = "<ul>";
                                $.each(response.error, function (key, value) {
                                    errorMessages += "<li>" + value + "</li>";
                                });
                                errorMessages += "</ul>";
                                $('#modalkategori').modal('hide');
                                iziToast.error({
                                    message: errorMessages,
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
                        $('#modalkategori').modal('hide');
                        iziToast.error({
                            title: 'Gagagal!',
                            message: errorMessages,
                            position: 'topRight'
                        });
                    }
                });
                $('#kategoriForm')[0].reset();
            });
        });
    }

    function showHideTombol(params){
        if(params == "tambah"){
            $('.modal-title-kategori').html('Tambah Kategori');
            $('.simpan-data').removeClass('d-none');
            $('.edit-data').addClass('d-none');
        }else{
            $('.modal-title-kategori').html('Edit Kategori');
            $('.simpan-data').addClass('d-none');
            $('.edit-data').removeClass('d-none');
        }
    }

    function aksi_edit_kategori(){
        $('body').on('click', '.btn-kategori-edit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: 'kategori/' + id + "/edit",
                type: 'GET',
                success: function(response) {
                    showHideTombol("edit");
                    $('#modalkategori').modal('show');
                    console.log(response.data);
                    $('#nama_kategori').val(response.data.nama_kategori);
                    var idNew = response.data.id;
                    $('.edit-data').off('click').on('click',function() {
                        $.ajax({
                            url: '/admin/kategori/' + idNew,
                            type: 'PUT',
                            data: {
                                nama_kategori : $('#nama_kategori').val()
                            },
                            success:function(response){
                                if (response.success) {
                                    iziToast.success({
                                        title: 'Berhasil',
                                        message: response.success,
                                        position: 'topRight'
                                    });
                                    $('#modalkategori').modal('hide');
                                    $('#datatable_kategori').DataTable().ajax.reload();
                                } else {
                                    if (Array.isArray(response.error)) {
                                        var errorMessages = "<ul>";
                                        $.each(response.error, function (key, value) {
                                            errorMessages += "<li>" + value + "</li>";
                                        });
                                        errorMessages += "</ul>";
                                        $('#modalkategori').modal('hide');
                                        iziToast.error({
                                            message: errorMessages,
                                            position: 'topRight'
                                        });
                                    }
                                }
                                reset_input();
                            }
                        });
                        $('#kategoriForm').reset();
                    });
                }
            });

        });
    }

    function aksi_hapus_kategori(){
        $('body').on('click', '.btn-kategori-hapus', function(e) {
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
                        url: '/admin/kategori/' + id,
                        type: 'DELETE',
                        success:function(response){
                            iziToast.success({
                                title: 'Berhasil',
                                message: response.success,
                                position: 'topRight'
                            });
                        }
                    });
                    $('#datatable_kategori').DataTable().ajax.reload();
            } else {
                swal('Cancel hapus data!');
            }
            });
        });
    }

    function reset_input(){
        $('#nama_kategori').val("");
    }

    $('#modalkategori').on('hidden.bs.modal',function(){
        $('#nama_kategori').val('');
    });

    $(document).ready(function(){
        datatable_kategori();
        aksi_tambah_kategori();
        aksi_edit_kategori();
        aksi_hapus_kategori();
    });
</script>
