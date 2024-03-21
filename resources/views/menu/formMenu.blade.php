<div class="modal fade" id="modalFormMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">  
          <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" action="menu" enctype="multipart/form-data">
              @csrf
              <div id="method"></div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Nama Menu</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_menu" value="" name="nama_menu">
                </div>
              </div>

              <div class="form-group row">
            <label for="jenis_id" class="col-sm-4 col-form-label">Jenis</label>
            <div class="col-sm-8">
              <select name="jenis_id" id="jenis_id" class="form-control">
                {{-- <option value="">Pilih Jenis</option> --}}
                @foreach ($jenis as $p)
                <option value="{{ $p->id }}">{{ $p->nama_jenis }}</option>
                @endforeach
              </select>
            </div>
          </div>

          
          
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-4 col-form-label">Harga</label>
              <div class="col-md-8 col-sm-6  form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" id="harga" placeholder="Harga" value="" name="harga">
                <span class="color-black form-control-feedback left" aria-hidden="true">Rp. </span>
              </div>
              </div>

              <div class="form-group row">
                <label for="fileInput" class="col-sm-4 col-form-label">Gambar</label>
                <div class="col-sm-8">
                <input type="file" class="form-control" id="image" value="" name="image">
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleFormControlTextarea1" class="col-sm-4 col-form-label">Deskripsi</label>
                <div class="col-sm-8">
                <textarea class="form-control" id="deskripsi" value="" name="deskripsi"></textarea>
                </div>
              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
          </form>
    </div>
</div>
