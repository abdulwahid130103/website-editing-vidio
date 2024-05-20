<section>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalplaylist">
        <form id="playlistForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title modal-title-playlist">Tambah Playlist</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Nama Playlist</label>
                                <input type="text" id="nama_playlist" name="nama_playlist" placeholder="Masukkan nama playlist ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Kategori Playlist</label>
                                <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
                                    <select class="form-control select2 kategori_id" name="kategori_id" id="kategori_id">
                                        @foreach (getKategori() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-none" id="card-thumbnail-playlist">
                            <div class="card" >
                                <div class="card-body">
                                  <div class="mb-2 text-muted">Thumbnail Playlist</div>
                                  <div class="chocolat-parent">
                                      <div data-crop-image="285">
                                        <img alt="image" src="#" id="get_thumbnail_playlist" class="img-fluid">
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Deskripsi Playlist</label>
                                <textarea id="deskripsi_playlist" name="deskripsi_playlist" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Thumbnail Playlist</label>
                                <input type="file" id="thumbnail_playlist" name="thumbnail_playlist"  class="form-control">
                                <input type="hidden" id="thumbnail_playlist_lama" name="thumbnail_playlist_lama"  class="form-control">
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