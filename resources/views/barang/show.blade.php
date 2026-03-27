<div class="modal fade" id="modal_detail_barang" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-fullwidth">
    <div class="modal-content modern-modal">

      <!-- HEADER -->
      <div class="modal-header clean-header">
        <h5>Detail Barang</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- BODY -->
      <div class="modal-body clean-body">

        <div class="layout-wrap">

          <!-- LEFT -->
          <div class="left-panel">

            <div class="media-viewer">

              <!-- SLIDER -->
              <div id="slider_images" class="slider-track"></div>

              <!-- NAV -->
              <button class="nav prev" onclick="slideLeft()">‹</button>
              <button class="nav next" onclick="slideRight()">›</button>

            </div>

            <!-- 🔥 THUMBNAIL (JS nanti isi) -->
            <div id="slider_thumbs" class="slider-thumbs"></div>

          </div>

          <!-- RIGHT -->
          <div class="right-panel">

            <h2 id="detail_nama_barang" class="title-main">-</h2>

            <div class="info-list">
              <div><span>Jenis</span><span id="detail_jenis"></span></div>
              <div><span>Satuan</span><span id="detail_satuan"></span></div>
              <div><span>Stok</span><span id="detail_stok"></span></div>
              <div><span>Min Stok</span><span id="detail_stok_minimum"></span></div>
            </div>

            <div class="desc-section">
              <div class="label">Deskripsi</div>
              <div id="detail_deskripsi" class="desc-text"></div>
            </div>

          </div>

        </div>

      </div>

      <!-- FOOTER -->
      <div class="modal-footer clean-footer">
        <button class="btn btn-primary" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>

<style>
    :root {
  --modal-max-width: 1500px;
  --modal-padding: 20px;
  --image-radius: 7px;
}

/* MODAL WIDTH */
.modal-dialog.modal-fullwidth {
  width: 85vw !important;
  max-width: 1000px !important;
  margin: auto;
}

/* MODAL */
.modern-modal {
  border-radius: 14px;
  height: 88vh;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  background: #fff;
}

/* HEADER */
.clean-header {
  padding: 16px var(--modal-padding);
  border-bottom: 1px solid #eee;
}

/* BODY */
.clean-body {
  flex: 1;
  padding: var(--modal-padding);
  overflow: hidden;
}

/* LAYOUT */
.layout-wrap {
  display: flex;
  gap: 40px;
  height: 100%;
}

/* LEFT */
.left-panel {
  flex: 1.3;
  display: flex;
  flex-direction: column;
}

/* RIGHT */
.right-panel {
  flex: 1;
  display: flex;
  flex-direction: column;
}

/* IMAGE */
.media-viewer {
  width: 100%;
  height: 100%;
  border-radius: var(--image-radius);
  overflow: hidden;
  position: relative;
  background: #f3f4f6;
}

/* 🔥 SLIDER FIX UTAMA */
.slider-track {
  display: flex;
  height: 100%;
  transition: transform 0.4s ease;
}

/* 🔥 INI YANG MENCEGAH SPLIT */
.slider-img {
  flex: 0 0 100%;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* NAV */
.nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0,0,0,0.35);
  color: white;
  border: none;
  padding: 6px 12px;
  border-radius: 6px;
  cursor: pointer;
  opacity: 0;
  transition: 0.2s;
}

.media-viewer:hover .nav {
  opacity: 1;
}

.prev { left: 10px; }
.next { right: 10px; }

/* TITLE */
.title-main {
  font-size: 24px;
  margin-bottom: 20px;
}

/* INFO */
.info-list div {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  border-bottom: 1px solid #eee;
  font-size: 14px;
}

/* DESC */
.desc-section {
  margin-top: 20px;
}

.desc-section .label {
  margin-bottom: 8px;
  font-size: 14px;
}

.desc-text {
  line-height: 1.7;
  color: #444;
}

/* 🔥 THUMBNAIL */
.slider-thumbs {
  display: flex;
  gap: 8px;
  margin-top: 12px;
  overflow-x: auto;
}

.slider-thumbs img {
  width: 60px;
  height: 60px;
  object-fit: cover;
  border-radius: 6px;
  opacity: 0.6;
  cursor: pointer;
  transition: 0.2s;
}

.slider-thumbs img.active {
  opacity: 1;
  border: 2px solid #4f46e5;
}

/* FOOTER */
.clean-footer {
  border-top: 1px solid #eee;
  padding: 14px var(--modal-padding);
}

/* MOBILE */
@media (max-width: 992px) {

  .modern-modal {
    height: auto;
  }

  .layout-wrap {
    flex-direction: column;
    gap: 20px;
  }

  .media-viewer {
    height: 240px;
  }

  .title-main {
    font-size: 18px;
  }
}
</style>
