<div class="btn-group" role="group">
    <div class="dropdown d-inline">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-eyedropper" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item has-icon btn-vidio-edit" id="btn-vidio-edit" href="javascript:void(0)" data-id="{{ $model->id }}" data-bs-toggle="modal" data-bs-target="#modalvidio"><i class="far fa-edit"></i> Edit</a>
          <a class="dropdown-item has-icon btn-vidio-hapus" href="javascript:void(0)" data-id="{{ $model->id }}" ><i class="fas fa-times"></i> Hapus</a>
        </div>
      </div>
</div>
