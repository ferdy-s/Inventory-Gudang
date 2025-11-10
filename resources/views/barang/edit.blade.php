<!-- Modal Edit Barang -->
<div class="modal fade" id="modal_edit_barang" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow-lg"
      style="backdrop-filter: blur(14px); background: rgba(255,255,255,0.97); border-radius: 18px; font-family:'Poppins', sans-serif; color:#333;">

      <!-- Header -->
      <div class="modal-header border-0" style="background: rgba(250,250,250,0.9);">
        <h5 class="modal-title" style="font-weight:400; font-size:18px;">Edit Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:24px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Form -->
      <form id="form_edit_barang" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" id="barang_id">
          <input type="hidden" name="gambar_lama" id="gambar_lama">

          <div class="row">
            <!-- Kolom Gambar -->
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label style="font-weight:400;">Gambar Barang (Opsional)</label>
                <div class="input-group mb-2">
                  <span class="input-group-text bg-white border-end-0"><i class="fas fa-image text-primary"></i></span>
                  <input type="file" class="form-control form-control-sm border-start-0" id="edit_gambar" name="gambar" accept="image/*" onchange="previewImageEdit()">
                </div>

                <!-- Nama file lama (simulasi label value) -->
                <small id="file_label" class="text-secondary d-block" style="font-size:13px;">Belum ada file</small>

                <div class="mt-3 text-center">
                  <img id="edit_gambar_preview" src="" class="img-fluid rounded shadow-sm" style="max-height:280px; object-fit:cover;">
                  <p class="mt-2 mb-0 text-muted" style="font-size:14px;">Jika tidak memilih file baru, gambar lama tetap digunakan.</p>
                </div>
              </div>
            </div>

            <!-- Kolom Data -->
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label>Nama Barang</label>
                <input type="text" class="form-control form-control-sm" name="nama_barang" id="edit_nama_barang" placeholder="Masukkan nama barang...">
              </div>

              <div class="form-group mb-2">
                <label>Jenis Barang</label>
                <select class="form-control form-control-sm" name="jenis_id" id="edit_jenis_id">
                  @foreach ($jenis_barangs as $jenis)
                    <option value="{{ $jenis->id }}">{{ $jenis->jenis_barang }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group mb-2">
                <label>Satuan Barang</label>
                <select class="form-control form-control-sm" name="satuan_id" id="edit_satuan_id">
                  @foreach ($satuans as $satuan)
                    <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group mb-2">
                <label>Stok Minimum</label>
                <input type="number" class="form-control form-control-sm" name="stok_minimum" id="edit_stok_minimum">
              </div>

              <div class="form-group mb-2">
                <label>Deskripsi</label>
                <textarea class="form-control form-control-sm" name="deskripsi" id="edit_deskripsi" rows="3"></textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer border-0" style="background: rgba(245,245,245,0.8);">
          <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius:8px;">Keluar</button>
          <button type="button" id="update" class="btn btn-primary px-4" style="border-radius:8px; background:#4f46e5; border:none;">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script -->
<script>
  // ✅ Preview gambar baru
  function previewImageEdit() {
    const file = document.getElementById('edit_gambar').files[0];
    const preview = document.getElementById('edit_gambar_preview');
    const label = document.getElementById('file_label');
    if (file) {
      label.textContent = file.name;
      preview.src = URL.createObjectURL(file);
    }
  }

  // ✅ Saat klik tombol Edit Barang
  $('body').on('click', '#button_edit_barang', function() {
    const id = $(this).data('id');
    $.get(`/barang/${id}/edit`, function(res) {
      const data = res.data;

      // Prefill semua input
      $('#barang_id').val(data.id);
      $('#edit_nama_barang').val(data.nama_barang);
      $('#edit_stok_minimum').val(data.stok_minimum);
      $('#edit_jenis_id').val(data.jenis_id);
      $('#edit_satuan_id').val(data.satuan_id);
      $('#edit_deskripsi').val(data.deskripsi);
      $('#gambar_lama').val(data.gambar);

      // tampilkan preview dan nama file lama
      const gambarPath = '/storage/' + data.gambar;
      const namaFile = data.gambar.split('/').pop();
      $('#edit_gambar_preview').attr('src', gambarPath);
      $('#file_label').text(namaFile);

      // buka modal
      $('#modal_edit_barang').modal('show');
    });
  });


  $('#update').click(function(e) {
    e.preventDefault();
    let barang_id = $('#barang_id').val();
    let formData = new FormData($('#form_edit_barang')[0]);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append('_method', 'PUT');

    $.ajax({
      url: `/barang/${barang_id}`,
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function() {
        $('#update').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
      },
      success: function(res) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: res.message,
          timer: 1500,
          showConfirmButton: false
        });
        $('#modal_edit_barang').modal('hide');
        $('#update').prop('disabled', false).html('Update');
        $('#table_id').DataTable().ajax.reload();
      },
      error: function(xhr) {
        $('#update').prop('disabled', false).html('Update');
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan server.' });
      }
    });
  });
</script>
