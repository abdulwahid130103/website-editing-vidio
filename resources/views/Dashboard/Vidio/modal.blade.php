<section>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalvidio">
        <form id="vidioForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title modal-title-vidio">Tambah Vidio</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Materi Vidio</label>
                                <input type="text" id="judul" name="judul" placeholder="Masukkan materi vidio ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Link vidio</label>
                                <input type="text" id="link" name="link" placeholder="Masukkan link vidio ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Deskripsi Vidio</label>
                                <textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Playlist</label>
                                <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
                                    <select class="form-control select2 playlist_id" name="playlist_id" id="playlist_id">
                                        @foreach (getPlaylist() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_playlist }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Status</label>
                                <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
                                    <select class="form-control select2 is_active" name="is_active" id="is_active">
                                        <option value="1">Publish</option>
                                        <option value="0">Private</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-none" id="card-thumbnail-vidio">
                            <div class="card" >
                                <div class="card-body">
                                  <div class="mb-2 text-muted">Thumbnail Vidio</div>
                                  <div class="chocolat-parent">
                                      <img alt="image" src="#" id="get_thumbnail_vidio" class="img-fluid">
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Thumbnail Vidio</label>
                                <input type="file" id="thumbnail_vidio" name="thumbnail_vidio"  class="form-control">
                                <input type="hidden" id="thumbnail_vidio_lama" name="thumbnail_vidio_lama"  class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary simpan-data">Simpan</button>
                <button type="button" class="btn btn-primary edit-data">Edit</button>
            </div>
          </div>
        </div>
        </form>
      </div>
</section>