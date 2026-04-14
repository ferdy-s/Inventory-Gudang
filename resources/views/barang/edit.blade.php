<!-- Modal Edit Barang FINAL -->
<div class="modal fade" id="modal_edit_barang" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content shadow border-0 rounded-4">

      <div class="modal-header border-0">
        <h5 class="modal-title fw-semibold">Edit Barang</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form id="form_edit_barang" enctype="multipart/form-data">
        <div class="modal-body">

          <input type="hidden" id="barang_id">

          <div class="row">

            <!-- LEFT IMAGE -->
            <div class="col-md-6">
              <label>Upload Gambar</label>

              <input type="file"
                     id="edit_gambar"
                     name="gambar[]"
                     multiple
                     class="form-control"
                     accept="image/*"
                     onchange="previewImageEdit()">

              <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>

              <div id="edit_gambar_preview" class="mt-3 d-flex flex-wrap"></div>
            </div>

            <!-- RIGHT FORM -->
            <div class="col-md-6">

              <div class="mb-2">
                <label>Nama Barang</label>
                <input type="text" id="edit_nama_barang" name="nama_barang" class="form-control">
              </div>

              <div class="mb-2">
                <label>Jenis</label>
                <select id="edit_jenis_id" name="jenis_id" class="form-control">
                  @foreach ($jenis_barangs as $jenis)
                  <option value="{{ $jenis->id }}">{{ $jenis->jenis_barang }}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-2">
                <label>Satuan</label>
                <select id="edit_satuan_id" name="satuan_id" class="form-control">
                  @foreach ($satuans as $satuan)
                  <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-2">
                <label>Stok Minimum</label>
                <input type="number" id="edit_stok_minimum" name="stok_minimum" class="form-control">
              </div>

              <div class="mb-3">
  <label>Deskripsi</label>
  <textarea id="edit_deskripsi"
            name="deskripsi"
            class="form-control textarea-besar auto-resize"
            rows="4"></textarea>
</div>

            </div>

          </div>

        </div>

        <div class="modal-footer border-0">
          <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
          <button type="button" id="update" class="btn btn-primary">Update</button>
        </div>

      </form>
    </div>
  </div>
</div>

<style>
#edit_gambar_preview img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    margin: 5px;
    border: 1px solid #ddd;
}
/* MODAL LEBAR CUSTOM */
#modal_edit_barang .modal-dialog {
    max-width: 90%;   /* bisa kamu ubah: 85%, 90%, 95% */
    margin: 1.75rem auto;
}

/* OPTIONAL: lebih lebar lagi di layar besar */
@media (min-width: 1400px) {
    #modal_edit_barang .modal-dialog {
        max-width: 80%;
    }
}
/* TEXTAREA BESAR */
.textarea-besar {
    min-height: 290px;   /* tinggi awal */
    font-size: 14px;
    line-height: 1.6;
    padding: 1px;
    border-radius: 1px;
}

/* AUTO RESIZE SUPPORT */
.auto-resize {
    resize: auto;  /* pengguna bisa resize manual */
    overflow: scroll;
}
</style>

