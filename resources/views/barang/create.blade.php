<!-- Tambah Barang Modal -->
<div class="modal fade" id="modal_tambah_barang" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow-lg"
         style="backdrop-filter: blur(12px); background: rgba(255,255,255,0.92); border-radius: 18px; font-family:'Poppins', sans-serif; font-weight:300; color:#333;">

      <div class="modal-header border-0" style="background: rgba(250,250,250,0.8);">
        <h5 class="modal-title" style="font-weight:300; font-size:18px; letter-spacing:0.5px;">Tambah Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:24px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="form_tambah_barang" enctype="multipart/form-data" autocomplete="on">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label style="font-weight:300;">Gambar</label>
                <input type="file" class="form-control form-control-sm" name="gambar" id="gambar" onchange="previewImage()" accept="image/*">
                <img src="" id="preview" class="img-fluid mt-3 d-none rounded" style="max-height:260px; border:1px solid #e0e0e0; object-fit:cover;">
                <div class="alert alert-danger mt-2 d-none" id="alert-gambar" style="font-size:13px;"></div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group mb-2">
                <label style="font-weight:300;">Nama Barang</label>
                <input type="text" class="form-control form-control-sm paste-enabled" name="nama_barang" id="nama_barang" placeholder="Masukkan nama barang...">
                <div class="alert alert-danger mt-2 d-none" id="alert-nama_barang" style="font-size:13px;"></div>
              </div>

              <div class="form-group mb-2">
                <label style="font-weight:300;">Jenis Barang</label>
                <select class="form-control form-control-sm" name="jenis_id" id="jenis_id">
                  <option value="">-- Pilih Jenis --</option>
                  @foreach ($jenis_barangs as $jenis)
                    <option value="{{ $jenis->id }}">{{ $jenis->jenis_barang }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group mb-2">
                <label style="font-weight:300;">Satuan Barang</label>
                <select class="form-control form-control-sm" name="satuan_id" id="satuan_id">
                  <option value="">-- Pilih Satuan --</option>
                  @foreach ($satuans as $satuan)
                    <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group mb-2">
                <label style="font-weight:300;">Stok Minimum</label>
                <input type="number" class="form-control form-control-sm paste-enabled" name="stok_minimum" id="stok_minimum" placeholder="Misal: 10">
                <div class="alert alert-danger mt-2 d-none" id="alert-stok_minimum" style="font-size:13px;"></div>
              </div>

              <div class="form-group mb-2">
                <label style="font-weight:300;">Deskripsi</label>
                <textarea class="form-control form-control-sm paste-enabled" name="deskripsi" id="deskripsi" placeholder="Tuliskan deskripsi barang..." rows="3"></textarea>
                <div class="alert alert-danger mt-2 d-none" id="alert-deskripsi" style="font-size:13px;"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer border-0" style="background: rgba(245,245,245,0.7);">
          <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius:8px;">Keluar</button>
          <button type="button" id="store" class="btn btn-primary px-4" style="border-radius:8px; background:#4f46e5; border:none;">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Styling tambahan modern 2025 -->
<style>
  input.form-control, select.form-control, textarea.form-control {
    border-radius: 10px;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
    font-weight: 300;
  }
  input:focus, select:focus, textarea:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.15rem rgba(79,70,229,0.25);
  }
  label {
    color: #555;
    font-size: 14px;
  }
  .modal-content {
    animation: zoomFade 0.35s ease;
  }
  @keyframes zoomFade {
    from { transform: scale(0.95); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
  }
</style>

<script>
  // ✅ Izinkan paste text dari luar ke semua input
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.paste-enabled').forEach(el => {
      el.addEventListener('paste', function(e) {
        e.stopPropagation();
        const text = (e.clipboardData || window.clipboardData).getData('text');
        document.execCommand("insertText", false, text);
        e.preventDefault();
      });
    });
  });

  // ✅ Preview image sebelum upload
  function previewImage() {
    const file = document.getElementById('gambar').files[0];
    const preview = document.getElementById('preview');
    if (file) {
      preview.src = URL.createObjectURL(file);
      preview.classList.remove('d-none');
    }
  }

  // ✅ Simpan Barang (AJAX)
  $('#store').click(function(e) {
    e.preventDefault();
    let formData = new FormData($('#form_tambah_barang')[0]);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
      url: '/barang',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function() {
        $('#store').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
      },
      success: function(res) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: res.message,
          timer: 1800,
          showConfirmButton: false
        });
        $('#modal_tambah_barang').modal('hide');
        $('#form_tambah_barang')[0].reset();
        $('#preview').addClass('d-none');
        $('#store').prop('disabled', false).html('Tambah');
        $('#table_id').DataTable().ajax.reload();
      },
      error: function(xhr) {
        $('#store').prop('disabled', false).html('Tambah');
        if (xhr.status === 422) {
          const errors = xhr.responseJSON;
          if (errors.nama_barang) $('#alert-nama_barang').removeClass('d-none').text(errors.nama_barang[0]);
          if (errors.stok_minimum) $('#alert-stok_minimum').removeClass('d-none').text(errors.stok_minimum[0]);
          if (errors.deskripsi) $('#alert-deskripsi').removeClass('d-none').text(errors.deskripsi[0]);
          if (errors.gambar) $('#alert-gambar').removeClass('d-none').text(errors.gambar[0]);
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan server.' });
        }
      }
    });
  });
</script>
