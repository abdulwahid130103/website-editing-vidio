<section>
    <div class="modal fade" tabindex="-1" role="dialog" id="modaluser">
        <form id="userForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title modal-title-user">Tambah user</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 nama_lengkap_container">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama_lengkap ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 username_container">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" id="username" name="username" placeholder="Masukkan username ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 email_container">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email" name="email" placeholder="Masukkan email ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 role_id_container">
                            <div class="form-group">
                                <label>Role</label>
                                <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
                                    <select class="form-control select2 role_id" name="role_id" id="role_id">
                                        @foreach (getRole() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 no_telfon_container">
                            <div class="form-group">
                                <label>No.Telf</label>
                                <input type="number" id="no_telfon" name="no_telfon" placeholder="Masukkan no_telfon ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 alamat_container">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 card_foto_container" id="card-foto">
                            <div class="card" >
                                <div class="card-body">
                                  <div class="mb-2 text-muted">Foto</div>
                                  <div class="chocolat-parent">
                                      <img alt="image" src="#" id="get_foto" class="img-fluid">
                                      {{-- <div data-crop-image="285">
                                      </div> --}}
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 input-foto-container">
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" id="foto" name="foto"  class="form-control">
                                <input type="hidden" id="foto_lama" name="foto_lama"  class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-12 label-password">
                            <label class="text-danger font-italic"> * Password harus sesuai *</label>
                        </div>
                        <div class="col-lg-12 password-container">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" class="form-control"
                                        placeholder="Masukkan Password Baru ..." id="password"
                                        name="password">
                                    <button type="button" class="btn btn-outline-primary toggle-password">
                                        <i class="fa fa-eye"></i> Show
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 password-container2">
                            <label class="form-label" for="example-text-input">Konfirmasi Password</label>
                            <div class="mb-4 input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="password" class="form-control" placeholder="Konfirmasi password ..."
                                    id="konfirmasi-password" name="konfirmasi-password">
                                <button type="button" class="btn btn-outline-primary toggle-password">
                                    <i class="fa fa-eye"></i> Show
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary simpan-data">Simpan</button>
                <button type="button" class="btn btn-primary edit-data">Edit</button>
                <button type="button" class="btn btn-primary password-data">Ganti Password</button>
            </div>
          </div>
        </div>
        </form>
      </div>
</section>