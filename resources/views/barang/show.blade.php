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

            <h3 id="detail_nama_barang" class="title-main">-</h3>

            <div class="info-list">
         <a href="#" id="btnCetakPdf" class="btn btn-danger">
  <i class="fas fa-file-pdf"></i> Cetak PDF
</a>

  <div>

    <span>
      <i class="fas fa-tags icon-info"></i>
      Jenis :
    </span>
    <span id="detail_jenis"></span>
  </div>

  <div>
    <span>
      <i class="fas fa-balance-scale icon-info"></i>
      Satuan :
    </span>
    <span id="detail_satuan"></span>
  </div>

  <div>
    <span>
      <i class="fas fa-boxes icon-info"></i>
      Stok :
    </span>
    <span id="detail_stok"></span>
  </div>

  <div>
    <span>
      <i class="fas fa-exclamation-triangle icon-info"></i>
      Min Stok :
    </span>
    <span id="detail_stok_minimum"></span>
  </div>

</div>
<br>
           <div class="desc-section">

  <div class="label" style="font-size: 17px">
    <i class="fas fa-align-left icon-label"></i>
    Deskripsi :
  </div>

  <div id="detail_deskripsi" class="desc-text collapsed" style="margin-top: 10px"></div>

  <button id="btn_readmore" class="btn-readmore" style="display:none;">
    Read More
  </button>

</div>

          </div>

        </div>

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
  font-size: 17px;
}

/* DESC */
.desc-text {
  line-height: 1.7;
  color: #444;
  margin-bottom: 8px;

  white-space: pre-line; /* 🔥 KUNCI UTAMA */
}

/* MODE COLLAPSED */
.desc-text.collapsed {
  display: -webkit-box;
  -webkit-line-clamp: 4;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* MODE EXPANDED (🔥 kunci utama) */
.desc-text.expanded {
  max-height: 255px; /* batas tinggi setelah expand */
  overflow-y: auto;
  padding-right: 6px;
}

/* OPTIONAL: scrollbar lebih halus */
.desc-text.expanded::-webkit-scrollbar {
  width: 6px;
}
.desc-text.expanded::-webkit-scrollbar-thumb {
  background: #ccc;
  border-radius: 10px;
}

.btn-readmore {
  margin-top: 12px;
  padding: 8px 14px;
  font-size: 13px;
  font-weight: 500;
  border-radius: 8px;
  border: 1px solid #e5e7eb;
  background: #4f46e5;
  color: white;
  cursor: pointer;
  transition: all 0.2s ease;
}

/* hover */
.btn-readmore:hover {
  background: #4f46e5;
  color:  #111827;
  border-color: #4f46e5;
}

/* active click */
.btn-readmore:active {
  transform: scale(0.97);
}

/* optional: full width */
.btn-readmore.full {
  width: 100%;
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
