@extends('layouts.app')

@include('barang.create')
@include('barang.edit')
@include('barang.show')

@section('content')
    <div class="section-header">
        <h1>Data Barang</h1>
        <div class="ml-auto">
            <a href="javascript:void(0)" class="btn btn-primary" id="button_tambah_barang"><i class="fa fa-plus"></i> Tambah
                Barang</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Datatables Jquery -->
<script>
$(document).ready(function() {

    let table = $('#table_id').DataTable({
        paging: true
    });

    function loadData() {
        $.ajax({
            url: "/barang/get-data",
            type: "GET",
            dataType: 'JSON',
            success: function(response) {
                

                let counter = 1;
                table.clear();

                $.each(response.data, function(key, value) {

                    let stok = value.stok != null ? value.stok : "Stok Kosong";

                    // ===== FINAL FIX RENDER GAMBAR =====
                    function renderGambar(row) {
                        let images = [];

                        if (row.gambar) {
                            try {
                                images = typeof row.gambar === 'string'
                                    ? JSON.parse(row.gambar)
                                    : row.gambar;
                            } catch (e) {
                                images = [];
                            }
                        }

                        if (!images || images.length === 0) {
                            return `
                                <div style="width:80px;height:80px;background:#f1f1f1;border-radius:6px;
                                            display:flex;align-items:center;justify-content:center;font-size:11px;color:#999;">
                                    No Image
                                </div>
                            `;
                        }

                        let firstImage = images[0];

                        return `
                            <div style="position:relative; display:inline-block;">
                                <img src="/storage/${firstImage}" width="80"
                                     style="border-radius:6px; object-fit:cover; height:80px;">
                                
                                ${images.length > 1 ? `
                                    <span style="
                                        position:absolute;
                                        bottom:0;
                                        right:0;
                                        background:black;
                                        color:white;
                                        font-size:10px;
                                        padding:2px 5px;
                                        border-radius:5px;">
                                        +${images.length - 1}
                                    </span>
                                ` : ''}
                            </div>
                        `;
                    }

                    // 🔥 PENTING: PAKAI FUNCTION INI
                    let imageHtml = renderGambar(value);

                    let barang = `
                        <tr class="barang-row" id="index_${value.id}">
                            <td>${counter++}</td>
                            <td>${imageHtml}</td>
                            <td>${value.kode_barang}</td>
                            <td>${value.nama_barang}</td>
                            <td>${stok}</td>
                            <td>
                                <a href="javascript:void(0)" id="button_detail_barang" data-id="${value.id}" class="btn btn-icon btn-success btn-lg mb-2"><i class="far fa-eye"></i></a>
                                <a href="javascript:void(0)" id="button_edit_barang" data-id="${value.id}" class="btn btn-icon btn-warning btn-lg mb-2"><i class="far fa-edit"></i></a>
                                <a href="javascript:void(0)" id="button_hapus_barang" data-id="${value.id}" class="btn btn-icon btn-danger btn-lg mb-2"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    `;

                    table.row.add($(barang)).draw(false);

                });
            }
        });
    }

    // INIT
    loadData();

});
</script>
   <!-- Show Modal Tambah barang -->
<script>
    $(document).ready(function () {

    // ================= MODAL TAMBAH =================
    $('body').on('click', '#button_tambah_barang', function () {
        $('#modal_tambah_barang').modal('show');
    });

    // ================= STORE (FINAL FIX) =================
    $(document).off('click', '#store').on('click', '#store', function (e) {
        e.preventDefault();

        let files = $('#gambar')[0].files;

        // ================= VALIDASI =================
        if (files.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Gambar wajib diisi'
            });
            return;
        }

        if (files.length > 20) {
            Swal.fire({
                icon: 'warning',
                title: 'Maksimal 20 gambar'
            });
            return;
        }

        let formData = new FormData();

        // ================= FIX ARRAY IMAGE =================
        for (let i = 0; i < files.length; i++) {
            formData.append('gambar[' + i + ']', files[i]);
        }

        formData.append('nama_barang', $('#nama_barang').val());
        formData.append('stok_minimum', $('#stok_minimum').val());
        formData.append('jenis_id', $('#jenis_id').val());
        formData.append('satuan_id', $('#satuan_id').val());
        formData.append('deskripsi', $('#deskripsi').val());
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: '/barang',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            beforeSend: function () {
                $('.alert').addClass('d-none');

                $('#store')
                    .prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
            },

            success: function (res) {
                console.log("SUCCESS:", res);

                Swal.fire({
                    icon: 'success',
                    title: res.message
                });

                // ================= RESET =================
                $('#form_tambah_barang')[0].reset();
                $('#modal_tambah_barang').modal('hide');

                $('#store')
                    .prop('disabled', false)
                    .text('Tambah');

                // ================= RELOAD DATA =================
                if ($.fn.DataTable.isDataTable('#table_id')) {
                    $('#table_id').DataTable().ajax.reload(null, false);
                } else {
                    location.reload();
                }
            },

            error: function (xhr) {
                console.log("ERROR FULL:", xhr.responseText);

                $('#store')
                    .prop('disabled', false)
                    .text('Tambah');

                // ================= VALIDATION ERROR =================
                if (xhr.status === 422) {

                    let errors = xhr.responseJSON;

                    if (errors.nama_barang)
                        $('#alert-nama_barang').removeClass('d-none').text(errors.nama_barang[0]);

                    if (errors.stok_minimum)
                        $('#alert-stok_minimum').removeClass('d-none').text(errors.stok_minimum[0]);

                    if (errors.deskripsi)
                        $('#alert-deskripsi').removeClass('d-none').text(errors.deskripsi[0]);

                    if (errors.gambar)
                        $('#alert-gambar').removeClass('d-none').text(errors.gambar[0]);

                    if (errors.jenis_id)
                        $('#alert-jenis_id').removeClass('d-none').text(errors.jenis_id[0]);

                    if (errors.satuan_id)
                        $('#alert-satuan_id').removeClass('d-none').text(errors.satuan_id[0]);

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: xhr.responseText.substring(0, 200)
                    });

                }
            }
        });

    });

});
</script>

  <!-- Show Detail Data Barang -->
<script>
    let currentSlide = 0;
let totalSlide = 0;

// ================= CLICK DETAIL =================
$(document).on('click', '#button_detail_barang', function () {

    let barang_id = $(this).data('id');

    $.ajax({
        url: `/barang/${barang_id}`,
        type: "GET",

        success: function (response) {

            let data = response?.data ?? response;

            console.log("DETAIL DATA:", data);

             setCetakPdf(data.id);

            // ================= TEXT =================
            $('#detail_nama_barang').text(data.nama_barang || '-');
            $('#detail_stok').text(data.stok ?? 0);
            $('#detail_stok_minimum').text(data.stok_minimum ?? 0);

            let desc = data.deskripsi || '-';
            loadDeskripsi(desc);   // 🔥 pakai ini saja



            // ================= RELASI =================
            $('#detail_jenis').text(data.jenis?.jenis_barang ?? '-');
            $('#detail_satuan').text(data.satuan?.satuan ?? '-');

            // ================= IMAGE =================
            let images = [];

            if (Array.isArray(data.gambar)) {
                images = data.gambar;
            } else if (typeof data.gambar === 'string') {
                try {
                    images = JSON.parse(data.gambar);
                } catch {
                    images = [data.gambar];
                }
            }

            renderSlider(images);

            // ================= SHOW MODAL =================
            $('#modal_detail_barang').modal('show');
        },

        error: function (xhr) {

    console.log("ERROR:", xhr.responseText);

    Swal.fire({
        icon: 'error',
        title: 'ERROR',
        text: xhr.responseText.substring(0, 200)
    });
}
    });
});


// ================= RENDER SLIDER =================
function renderSlider(images) {

    let html = '';

    if (images.length > 0) {

        html = images.map(img => {

            let path = img
                .replace(/^\/+/, '')
                .replace(/^storage\//, '');

            return `
                <img src="/storage/${path}"
                     class="slider-img"
                     onerror="this.src='/no-image.png'">
            `;
        }).join('');

    } else {

        html = `
            <div class="d-flex justify-content-center align-items-center w-100 h-100">
                No Image
            </div>
        `;
    }

    $('#slider_images').html(html);

    currentSlide = 0;
    totalSlide = $('#slider_images img').length;

    // tunggu render DOM
    setTimeout(updateSlider, 100);
}


// ================= UPDATE SLIDER =================
function updateSlider() {

    let width = $('.media-viewer').outerWidth();

    if (!width) return;

    $('#slider_images').css(
        'transform',
        `translateX(-${currentSlide * width}px)`
    );
}


// ================= NAVIGATION =================
function slideRight() {

    if (currentSlide < totalSlide - 1) {
        currentSlide++;
        updateSlider();
    }
}

function slideLeft() {

    if (currentSlide > 0) {
        currentSlide--;
        updateSlider();
    }
}


// ================= RESPONSIVE =================
$(window).on('resize', function () {
    updateSlider();
});


// ================= RESET =================
$('#modal_detail_barang').on('hidden.bs.modal', function () {
    currentSlide = 0;
    $('#slider_images').css('transform', 'translateX(0)');
});

</script>

 <!-- Show Edit Data Barang -->
 <script>

// ================= EDIT =================
$(document).on('click', '#button_edit_barang', function() {

    let barang_id = $(this).data('id');

    $.ajax({
        url: `/barang/${barang_id}/edit`,
        type: "GET",

        success: function(response) {

            let data = response.data;

            $('#barang_id').val(data.id);
            $('#edit_gambar').val(null);
            $('#edit_nama_barang').val(data.nama_barang);
            $('#edit_stok_minimum').val(data.stok_minimum);
            $('#edit_jenis_id').val(data.jenis_id);
            $('#edit_satuan_id').val(data.satuan_id);
            $('#edit_deskripsi').val(data.deskripsi);

            // 🔥 SAFE IMAGE HANDLE
            let images = [];

            if (data.gambar) {
                if (Array.isArray(data.gambar)) {
                    images = data.gambar;
                } else {
                    try {
                        images = JSON.parse(data.gambar);
                    } catch {
                        images = [];
                    }
                }
            }

            let html = images.length
                ? images.map(img => `
                    <img src="/storage/${img}"
                         width="80"
                         style="margin:5px; border-radius:6px;">
                  `).join('')
                : `<span class="text-muted">No Image</span>`;

            $('#edit_gambar_preview').html(html);

            $('#modal_edit_barang').modal('show');
        },

        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });

});


// ================= UPDATE =================
$(document).on('click', '#update', function(e) {

    e.preventDefault();

    let barang_id = $('#barang_id').val();

    if (!barang_id) {
        alert('ID tidak ditemukan');
        return;
    }

    let formData = new FormData();

    // 🔥 FIX: HANDLE FILE OPTIONAL
    let files = $('#edit_gambar')[0].files;

    if (files.length > 0) {
        for (let i = 0; i < files.length; i++) {
            formData.append('gambar['+i+']', files[i]);
        }
    }

    // 🔥 DATA WAJIB
    formData.append('nama_barang', $('#edit_nama_barang').val());
    formData.append('stok_minimum', $('#edit_stok_minimum').val());
    formData.append('deskripsi', $('#edit_deskripsi').val());
    formData.append('jenis_id', $('#edit_jenis_id').val());
    formData.append('satuan_id', $('#edit_satuan_id').val());

    formData.append('_token', $("meta[name='csrf-token']").attr("content"));
    formData.append('_method', 'PUT');

    $.ajax({
        url: `/barang/${barang_id}`,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,

        beforeSend: function() {
            $('#update').prop('disabled', true).text('Menyimpan...');
        },

        success: function(response) {

            Swal.fire({
                icon: 'success',
                title: response.message,
                timer: 2000
            });

            $('#modal_edit_barang').modal('hide');

            $('#update').prop('disabled', false).text('Update');

            // 🔥 FINAL FIX (TIDAK PAKAI ajax.reload)
            if (typeof loadData === 'function') {
                loadData();
            }

        },

        error: function(xhr) {

            $('#update').prop('disabled', false).text('Update');

            console.error("SERVER ERROR:", xhr.responseText);

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan server'
            });
        }
    });

});

</script>

    <!-- Hapus Data Barang -->
   <script>
$('body').on('click', '#button_hapus_barang', function () {
    let barang_id = $(this).data('id');
    let token = $("meta[name='csrf-token']").attr("content");

    Swal.fire({
        title: 'Apakah Kamu Yakin?',
        text: "Data akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'TIDAK',
        confirmButtonText: 'YA, HAPUS!'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: `/barang/${barang_id}`,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function (response) {

                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // 🔥 Hapus row langsung dari DataTable (tanpa reload)
                    let table = $('#table_id').DataTable();
                    let row = $(`#index_${barang_id}`);

                    table
                        .row(row)
                        .remove()
                        .draw();

                },
                error: function (xhr) {
                    console.log(xhr.responseText);

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Data tidak bisa dihapus'
                    });
                }
            });

        }
    });
});
</script>


    <!-- Preview Image -->
    <script>
        function previewImage() {
    let preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
}
    </script>

    <script>
        function previewImageEdit() {
    let preview = document.getElementById('edit_gambar_preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
}
    </script>

    <script>
function setCetakPdf(id) {
    const btn = document.getElementById('btnCetakPdf');
    btn.href = `/barang/cetak-pdf/${id}`;
}
</script>

<!-- Read More -->
<script>
function loadDeskripsi(text) {

    const desc = document.getElementById("detail_deskripsi");
    const btn  = document.getElementById("btn_readmore");

    if (!desc || !btn) return;

    // isi + jaga line break
    desc.innerHTML = (text || '-').replace(/\n/g, '<br>');

    // reset
    desc.classList.remove("open");
    btn.innerText = "Read More";
    btn.style.display = "inline-block";

    // cek overflow (akurat)
    requestAnimationFrame(() => {
        const isOverflow = desc.scrollHeight > desc.clientHeight + 2;
        if (isOverflow) {
            btn.style.display = "inline-block";
        }
    });

    // toggle
    btn.onclick = function () {
        const open = desc.classList.toggle("open");
        btn.innerText = open ? "Read Less" : "Read More";
    };
}
</script>
@endsection
