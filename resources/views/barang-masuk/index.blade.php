@extends('layouts.app')

@include('barang-masuk.create')

@section('content')
    <div class="section-header">
        <h1>Barang Masuk</h1>
        <div class="ml-auto">
            <a href="javascript:void(0)" class="btn btn-primary" id="button_tambah_barangMasuk"><i class="fa fa-plus"></i>
                Barang Masuk</a>
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
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Nama Barang</th>
                                    <th>Stok Masuk</th>
                                    <th>Supplier</th>
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


    <!-- Select2 Autocomplete -->
    <script>
       $(document).ready(function() {

    $('.js-example-basic-single').select2();

    $('#barang_id').on('change', function () {

        let barang_id = $(this).val();

        if (!barang_id) return;

        $.ajax({
            url: '/api/barang-detail', // ✅ endpoint baru
            type: 'GET',
            data: { barang_id: barang_id },

            success: function (response) {

                $('#stok').val(response.stok ?? 0);
                $('#satuan_id').val(response.satuan ?? '');

            }
        });

    });

});
    </script>

    <!-- Datatable -->
    <script>
       $(document).ready(function () {

    let table = $('#table_id').DataTable();

    function loadData() {
        $.ajax({
            url: "/barang-masuk/get-data",
            type: "GET",
            dataType: "JSON",
            success: function (response) {

                table.clear();

                let no = 1;

                $.each(response.data, function (i, item) {

                    let row = `
                        <tr>
                            <td>${no++}</td>
                            <td>${item.kode_transaksi}</td>
                            <td>${item.tanggal_masuk}</td>
                            <td>${item.nama_barang}</td>
                            <td>${item.jumlah_masuk}</td>
                            <td>${item.supplier?.supplier ?? '-'}</td>
                            <td>
                                <button data-id="${item.id}"
                                        class="btn btn-danger btn-sm delete-btn">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    `;

                    table.row.add($(row));
                });

                table.draw();
            }
        });
    }

   reloadTable();

});
function reloadTable() {
    let table = $('#table_id').DataTable();

    $.ajax({
        url: "/barang-masuk/get-data",
        type: "GET",
        success: function (response) {

            table.clear();

            let no = 1;

            $.each(response.data, function (i, item) {

                let row = `
                    <tr>
                        <td>${no++}</td>
                        <td>${item.kode_transaksi}</td>
                        <td>${item.tanggal_masuk}</td>
                        <td>${item.nama_barang}</td>
                        <td>${item.jumlah_masuk}</td>
                        <td>${item.supplier?.supplier ?? '-'}</td>
                        <td>
                            <button data-id="${item.id}"
                                    class="btn btn-danger btn-sm delete-btn">
                                Hapus
                            </button>
                        </td>
                    </tr>
                `;

                table.row.add($(row));
            });

            table.draw();
        }
    });
}

$(document).ready(function () {

    $('#table_id').DataTable();

    // 🔥 PANGGIL DI SINI
    reloadTable();

});
    </script>

    <!-- Generate Kode Transaksi Otomatis -->
    <script>
        function generateKodeTransaksi() {
            var tanggal = new Date().toLocaleDateString('id-ID').split('/').reverse().join('-');
            var randomNumber = Math.floor(Math.random() * 10000).toString().padStart(4, '0');
            var kodeTransaksi = 'TRX-IN-' + tanggal + '-' + randomNumber;

            $('#kode_transaksi').val(kodeTransaksi);
            return kodeTransaksi;
        }

        $(document).ready(function() {
            generateKodeTransaksi();
        });
    </script>

    <!-- Show Modal Tambah Jenis Barang -->
    <script>
        // ================= SHOW MODAL =================
$('body').on('click', '#button_tambah_barangMasuk', function () {
    $('#modal_tambah_barangMasuk').modal('show');
    $('#kode_transaksi').val(generateKodeTransaksi());
});


// ================= STORE DATA =================
$(document).off('click', '#store_barangMasuk').on('click', '#store_barangMasuk', function (e) {

    e.preventDefault();

    let formData = new FormData();

    formData.append('kode_transaksi', $('#kode_transaksi').val());
    formData.append('tanggal_masuk', $('#tanggal_masuk').val());
    formData.append('barang_id', $('#barang_id').val());
    formData.append('jumlah_masuk', $('#jumlah_masuk').val());
    formData.append('supplier_id', $('#supplier_id').val());
    formData.append('_token', $('meta[name="csrf-token"]').attr("content"));

    $.ajax({
        url: '/barang-masuk',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,

        beforeSend: function () {
            $('#store_barangMasuk').prop('disabled', true).text('Menyimpan...');
            $('.alert').addClass('d-none');
        },

        success: function (res) {

            Swal.fire({
                icon: 'success',
                title: res.message
            });

            $('#modal_tambah_barangMasuk').modal('hide');

            $('#store_barangMasuk').prop('disabled', false).text('Tambah');

            // reset
            $('#barang_id').val('').trigger('change');
            $('#jumlah_masuk').val('');
            $('#stok').val('');

            loadBarangMasuk(); // 🔥 reload sekali saja
        },

        error: function (xhr) {

            $('#store_barangMasuk').prop('disabled', false).text('Tambah');

            if (xhr.status === 422) {

                let errors = xhr.responseJSON;

                if (errors.tanggal_masuk)
                    $('#alert-tanggal_masuk').removeClass('d-none').text(errors.tanggal_masuk[0]);

                if (errors.barang_id)
                    $('#alert-barang_id').removeClass('d-none').text(errors.barang_id[0]);

                if (errors.jumlah_masuk)
                    $('#alert-jumlah_masuk').removeClass('d-none').text(errors.jumlah_masuk[0]);

                if (errors.supplier_id)
                    $('#alert-supplier_id').removeClass('d-none').text(errors.supplier_id[0]);

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

// ================= LOAD DATA =================
function loadBarangMasuk() {

    let table = $('#table_id').DataTable();
    table.clear();

    $.ajax({
        url: "/barang-masuk/get-data",
        type: "GET",

        success: function (response) {

            let counter = 1;

            $.each(response.data, function (key, value) {

                let supplier = response.supplier.find(s => s.id === value.supplier_id);

                let row = `
                    <tr id="index_${value.id}">
                        <td>${counter++}</td>
                        <td>${value.kode_transaksi}</td>
                        <td>${value.tanggal_masuk}</td>
                        <td>${value.barang?.nama_barang ?? '-'}</td>
                        <td>${value.jumlah_masuk}</td>
                        <td>${supplier ? supplier.supplier : ''}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" id="button_hapus_barangMasuk" data-id="${value.id}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                `;

                table.row.add($(row)).draw(false);

            });

        }
    });
}
    </script>


    <!-- Hapus Data Barang -->
    <script>
        $(document).on('click', '.delete-btn', function () {

    let id = $(this).data('id');
    let token = $("meta[name='csrf-token']").attr("content");

    Swal.fire({
        title: 'Apakah Kamu Yakin?',
        text: "Data akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'YA, HAPUS!',
        cancelButtonText: 'BATAL'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: `/barang-masuk/${id}`,
                type: "DELETE",
                data: {
                    _token: token
                },
                success: function (response) {

                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // 🔥 reload table (cara bersih)
                    reloadTable();
                }
            });

        }

    });

});
    </script>

    <script>
        // Mendapatkan tanggal hari ini
        var today = new Date();

        // Mendapatkan nilai tahun, bulan, dan tanggal
        var year = today.getFullYear();
        var month = (today.getMonth() + 1).toString().padStart(2, '0'); // Ditambahkan +1 karena indeks bulan dimulai dari 0
        var day = today.getDate().toString().padStart(2, '0');

        // Menggabungkan nilai tahun, bulan, dan tanggal menjadi format "YYYY-MM-DD"
        var formattedDate = year + '-' + month + '-' + day;

        // Mengisi nilai input field dengan tanggal hari ini
        document.getElementById('tanggal_masuk').value = formattedDate;
    </script>
@endsection
