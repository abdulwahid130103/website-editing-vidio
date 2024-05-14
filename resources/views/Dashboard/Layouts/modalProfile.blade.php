@if (Auth::user())
<section>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalprofile">
        <form id="profileForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title modal-title-profile">Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <input type="hidden" value="{{ Auth::user()->id }}" id="id_user">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" id="nama_lengkap_profile" name="nama_lengkap_profile" placeholder="Masukkan nama_lengkap ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" id="username_profile" name="username_profile" placeholder="Masukkan username ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email_profile" name="email_profile" placeholder="Masukkan email ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Role</label>
                                <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
                                    <select class="form-control select2 role_id_profile" name="role_id_profile" id="role_id_profile" required>
                                        @foreach (getRole() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>No.Telf</label>
                                <input type="number" id="no_telfon_profile" name="no_telfon_profile" placeholder="Masukkan no_telfon ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea id="alamat_profile" name="alamat_profile" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12" id="card-foto-profile">
                            <div class="card" >
                                <div class="card-body">
                                  <div class="mb-2 text-muted">Foto</div>
                                  <div class="chocolat-parent">
                                      <img alt="image" src="#" id="get_foto_profile" class="img-fluid">
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" id="foto_profile" name="foto_profile"  class="form-control">
                                <input type="hidden" id="foto_lama_profile" name="foto_lama_profile"  class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update-data-profile">update Profile</button>
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

    function getProfile() {   
        $('#tombol-profile').click(function(e){
            e.preventDefault();
            $('#modalprofile').modal('show');
            var id = $('#id_user').val();
            console.log(id);
            $.ajax({
                url: 'profile/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#nama_lengkap_profile').val(response.data.nama_lengkap);
                    $('#username_profile').val(response.data.username);
                    $('#email_profile').val(response.data.email);
                    $('#no_telfon_profile').val(response.data.no_telfon);
                    $('#alamat_profile').val(response.data.alamat);
                    $('#role_id_profile').empty()
                    $.each(response.role, function(key, value) {
                        if (value.id == response.data.role_id) {
                            $('#role_id_profile').append('<option value="' + value.id + '" selected>' + value.nama_role + '</option>');
                        } else {
                            $('#role_id_profile').append('<option value="' + value.id + '">' + value.nama_role + '</option>');
                        }
                    });

                    var imageSrc = response.data.foto;
                    if (imageSrc) {
                        $('#get_foto_profile').attr("src", `{{ asset('storage/user/${imageSrc}' ) }} `);;
                        $('#card-foto_profile').removeClass("d-none");
                    } else {
                        $('#card-foto_profile').addClass("d-none");
                    }
                    $('#foto_lama_profile').val(imageSrc);
                    var idNew = response.data.id;
                    $('.update-data-profile').off('click').on('click',function() {
                        var formData = new FormData($('#profileForm')[0]);
                        formData.append('_method', 'PUT');
                        formData.append('nama_lengkap', $('#nama_lengkap_profile').val());
                        formData.append('username', $('#username_profile').val());
                        formData.append('email', $('#email_profile').val());
                        formData.append('role_id', $('#role_id_profile').val());
                        formData.append('no_telfon', $('#no_telfon_profile').val());
                        formData.append('alamat', $('#alamat_profile').val());
                        formData.append('foto_lama_profile', $('#foto_lama_profile').val());
                        formData.append('foto_profile', $('input[type=file]')[0].files[0]); 
                        $.ajax({
                            url: 'profile/' + idNew,
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
                                $('#modalprofile').modal('hide');
                                $('#datatable_profile').DataTable().ajax.reload();
                                reset_input();
                            }
                        });
                        $('#profileForm').reset();
                    });
                }
            });
        });
    }

    $(document).ready(function () {
        getProfile();
    });
</script>