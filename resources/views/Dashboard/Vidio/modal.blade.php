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
                                <label>Time Vidio</label>
                                <input type="text" id="time" name="time" placeholder="Masukkan durasi vidio ...." class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Type Vidio</label>
                                <div class="selectgroup w-100">
                                  <label class="selectgroup-item">
                                    <input type="radio" name="upload_vidio_select" id="upload_vidio_select" value="link" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button">Link</span>
                                  </label>
                                  <label class="selectgroup-item">
                                    <input type="radio" name="upload_vidio_select" id="upload_vidio_select" value="upload" class="selectgroup-input">
                                    <span class="selectgroup-button">Upload</span>
                                  </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-none" id="upload_vidio_container" class="upload_vidio_container">
                            <div class="form-group">
                                <label>Upload vidio</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" accept="video/*">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" id="link_vidio_container" class="link_vidio_container">
                            <div class="form-group">
                                <label>Link vidio</label>
                                <input type="text" id="link" name="link" placeholder="Masukkan link vidio ...." class="form-control" required>
                            </div>
                        </div>
                        <div id="display_vidio_container" class="col-lg-12 d-none display_vidio_container mb-4">
                            <video id="videoPlayer" data-id="upload" width="100%" controls>
                                <source id="videoSource" src="" ype="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            {{-- <iframe width="100%" height="315" src="https://www.youtube.com/embed/0LvmB84gEqs?si=xc4dYzCinN7rZIAd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin"></iframe> --}}
                            {{-- <video controls width="100%">
                                <source src="https://www.youtube.com/watch?v=ErdMgdJMhrw" type="video/mp4">
                                Your browser does not support the video tag.
                            </video> --}}

                            {{-- <iframe width="100%" height="315" src="https://www.youtube.com/embed/ErdMgdJMhrw" frameborder="0" allowfullscreen></iframe> --}}
                            <div class="d-flex justify-content-center mt-4">
                                <button type="button" class="btn btn-primary hapus_vidio_display" id="hapus_vidio_display">Hapus Vidio</button>
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
