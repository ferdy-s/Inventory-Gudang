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

              <div class="mb-2">
                <label>Deskripsi</label>
                <textarea id="edit_deskripsi" name="deskripsi" class="form-control"></textarea>
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
    width: 100px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    margin: 5px;
    border: 1px solid #ddd;
}
</style>

<script>

// ================= PREVIEW MULTI IMAGE =================
function previewImageEdit() {
    const files = $('#edit_gambar')[0].files;
    const container = $('#edit_gambar_preview');

    container.html('');

    for (let i = 0; i < files.length; i++) {
        container.append(`<img src="${URL.createObjectURL(files[i])}">`);
    }
}


// ================= LOAD DATA =================
$('body').on('click', '#button_edit_barang', function () {

    let id = $(this).data('id');

    $.get(`/barang/${id}/edit`, function (res) {

        let data = res.data;

        $('#barang_id').val(data.id);
        $('#edit_nama_barang').val(data.nama_barang);
        $('#edit_stok_minimum').val(data.stok_minimum);
        $('#edit_jenis_id').val(data.jenis_id);
        $('#edit_satuan_id').val(data.satuan_id);
        $('#edit_deskripsi').val(data.deskripsi);

        // 🔥 HANDLE MULTI IMAGE
        let images = [];

        try {
            images = typeof data.gambar === 'string'
                ? JSON.parse(data.gambar)
                : data.gambar;
        } catch {
            images = [];
        }

        let html = images.length
            ? images.map(img => `<img src="/storage/${img}">`).join('')
            : `<span class="text-muted">No Image</span>`;

        $('#edit_gambar_preview').html(html);

        $('#modal_edit_barang').modal('show');
    });

});


// ================= UPDATE =================
$(document).on('click', '#update', function (e) {

    e.preventDefault();

    let id = $('#barang_id').val();
    let formData = new FormData();

let files = $('#edit_gambar')[0].files;
for (let i = 0; i < files.length; i++) {
    formData.append('gambar[]', files[i]);
}

formData.append('nama_barang', $('#edit_nama_barang').val());
formData.append('stok_minimum', $('#edit_stok_minimum').val());
formData.append('deskripsi', $('#edit_deskripsi').val());
formData.append('jenis_id', $('#edit_jenis_id').val());
formData.append('satuan_id', $('#edit_satuan_id').val());

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append('_method', 'PUT');

    $.ajax({
        url: `/barang/${id}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,

        beforeSend: function () {
            $('#update').prop('disabled', true).text('Menyimpan...');
        },

        success: function (res) {

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: res.message,
                timer: 1500,
                showConfirmButton: false
            });

            $('#modal_edit_barang').modal('hide');

            $('#update').prop('disabled', false).text('Update');

           if (typeof loadData === 'function') {
    loadData();
}
        },

        error: function () {

            $('#update').prop('disabled', false).text('Update');

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan server'
            });
        }
    });

});
</script>
