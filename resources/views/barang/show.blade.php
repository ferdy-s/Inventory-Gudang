<!-- Modal Detail Barang -->
<div class="modal fade" id="modal_detail_barang" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow-lg"
      style="backdrop-filter: blur(12px); background: rgba(255,255,255,0.93); border-radius: 18px; font-family:'Poppins', sans-serif; font-weight:300; color:#333;">

      <!-- Header -->
      <div class="modal-header border-0" style="background: rgba(250,250,250,0.8);">
        <h5 class="modal-title" style="font-weight:300; font-size:18px; letter-spacing:0.5px;">Detail Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:24px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <input type="hidden" id="barang_id">
        <div class="row">
          <!-- Gambar -->
          <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="text-center w-100">
              <img src="" id="detail_gambar_preview"
                class="img-fluid rounded shadow-sm"
                style="max-height: 280px; border:1px solid #e0e0e0; object-fit:cover;">
            </div>
          </div>

          <!-- Informasi Barang -->
          <div class="col-md-6">
            <div class="form-group mb-2">
              <label style="font-weight:300;">Nama Barang</label>
              <input type="text" class="form-control form-control-sm" id="detail_nama_barang" disabled>
            </div>

            <div class="form-group mb-2">
              <label style="font-weight:300;">Jenis Barang</label>
              <select class="form-control form-control-sm" id="detail_jenis_id" disabled>
                <option value="">-- Jenis Barang --</option>
                @foreach ($jenis_barangs as $jenis)
                  <option value="{{ $jenis->id }}">{{ $jenis->jenis_barang }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group mb-2">
              <label style="font-weight:300;">Satuan Barang</label>
              <select class="form-control form-control-sm" id="detail_satuan_id" disabled>
                <option value="">-- Satuan Barang --</option>
                @foreach ($satuans as $satuan)
                  <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group mb-2">
              <label style="font-weight:300;">Stok Saat Ini</label>
              <input type="text" class="form-control form-control-sm" id="detail_stok" disabled>
            </div>

            <div class="form-group mb-2">
              <label style="font-weight:300;">Stok Minimum</label>
              <input type="number" class="form-control form-control-sm" id="detail_stok_minimum" disabled>
            </div>

            <div class="form-group mb-2">
              <label style="font-weight:300;">Deskripsi</label>
              <textarea class="form-control form-control-sm" id="detail_deskripsi" rows="3" disabled></textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer border-0" style="background: rgba(245,245,245,0.75);">
        <button type="button" class="btn btn-primary px-4" data-dismiss="modal"
          style="border-radius:8px; background:#4f46e5; border:none; font-weight:300;">
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modern 2025 Styles -->
<style>
  input.form-control, select.form-control, textarea.form-control {
    border-radius: 10px;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
    font-weight: 300;
    background: rgba(255,255,255,0.9);
    color: #333;
  }
  input:disabled, select:disabled, textarea:disabled {
    background: rgba(245,245,245,0.5);
    color: #555;
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
    animation: fadeZoomIn 0.35s ease;
  }
  @keyframes fadeZoomIn {
    from { transform: scale(0.95); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
  }
</style>

<!-- Script (optional, inisialisasi gambar detail) -->
<script>
  function showDetailBarang(data) {
    $('#detail_nama_barang').val(data.nama_barang);
    $('#detail_jenis_id').val(data.jenis_id);
    $('#detail_satuan_id').val(data.satuan_id);
    $('#detail_stok').val(data.stok ?? 'Stok Kosong');
    $('#detail_stok_minimum').val(data.stok_minimum);
    $('#detail_deskripsi').val(data.deskripsi);
    $('#detail_gambar_preview').attr('src', '/storage/' + data.gambar);
    $('#modal_detail_barang').modal('show');
  }
</script>
