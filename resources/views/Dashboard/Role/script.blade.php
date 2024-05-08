<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function datatable_role() {
		let tabel_role = $('#datatable_role').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('role.index') }}",
			columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                   searchable: false 
                },
				{ data: 'nama_role', name: 'nama_role' },
				{ data: 'action', name: 'action' },
			]
		});
    }

    function aksi_tambah_role() {
        $('.btn-tambah-data').click(function(e){
            e.preventDefault();
            showHideTombol("tambah");
            $('#modalrole').modal('show');
            $('.simpan-data').off('click').on('click',function() {
                $.ajax({
                    url: '{{ route('role.store') }}',
                    type: 'POST',
                    data: {
                        "nama_role" : $('#roleForm #nama_role').val(),
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
                            $('#modalrole').modal('hide');
                            $('#datatable_role').DataTable().ajax.reload();
                        } else {
                            if (Array.isArray(response.error)) {
                                var errorMessages = "<ul>";
                                $.each(response.error, function (key, value) {
                                    errorMessages += "<li>" + value + "</li>";
                                });
                                errorMessages += "</ul>";
                                $('#modalrole').modal('hide');
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
                        $('#modalrole').modal('hide');
                        iziToast.error({
                            title: 'Gagagal!',
                            message: errorMessages,
                            position: 'topRight'
                        });
                    }
                });
                $('#roleForm')[0].reset();
            });
        });
    }

    function showHideTombol(params){
        if(params == "tambah"){
            $('.modal-title-role').html('Tambah Role');
            $('.simpan-data').removeClass('d-none');
            $('.edit-data').addClass('d-none');
        }else{
            $('.modal-title-role').html('Edit Role');
            $('.simpan-data').addClass('d-none');
            $('.edit-data').removeClass('d-none');
        }
    }

    function aksi_edit_role(){
        $('body').on('click', '.btn-role-edit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: 'role/' + id + "/edit",
                type: 'GET',
                success: function(response) {
                    showHideTombol("edit");
                    $('#modalrole').modal('show');
                    console.log(response.data);
                    $('#nama_role').val(response.data.nama_role);
                    var idNew = response.data.id;
                    $('.edit-data').off('click').on('click',function() {
                        $.ajax({
                            url: '/admin/role/' + idNew,
                            type: 'PUT',
                            data: {
                                nama_role : $('#nama_role').val()
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
                                }
                                $('#modalrole').modal('hide');
                                $('#datatable_role').DataTable().ajax.reload();
                                reset_input();
                            }
                        });
                        $('#roleForm').reset();
                    });
                }
            });
          
        });
    }

    function aksi_hapus_role(){
        $('body').on('click', '.btn-role-hapus', function(e) {
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
                        url: '/admin/role/' + id,
                        type: 'DELETE',
                        success:function(response){
                            iziToast.success({
                                title: 'Berhasil',
                                message: response.success,
                                position: 'topRight'
                            });
                        }
                    });
                    $('#datatable_role').DataTable().ajax.reload();
            } else {
                swal('Cancel hapus data!');
            }
            });
        });
    }

    function reset_input(){
        $('#nama_role').val("");
    }

    $('#modalrole').on('hidden.bs.modal',function(){
        $('#nama_role').val('');
    });
    
    $(document).ready(function(){
        datatable_role();
        aksi_tambah_role();
        aksi_edit_role();
        aksi_hapus_role();
    });
</script>