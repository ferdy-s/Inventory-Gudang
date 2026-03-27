@extends('layouts.app')

@section('content')

<div class="section-header">
    <h1>Laporan Barang Masuk</h1>
    <div class="ml-auto">
        <a href="javascript:void(0)" class="btn btn-danger" id="print-barang-masuk"><i class="fa fa-sharp fa-light fa-print"></i> Print PDF</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form id="filter_form">
  <div class="row">
    <div class="col-md-3">
      <label>Tanggal Mulai</label>
      <input type="date" class="form-control" id="tanggal_mulai">
    </div>

    <div class="col-md-3">
      <label>Tanggal Selesai</label>
      <input type="date" class="form-control" id="tanggal_selesai">
    </div>

    <div class="col-md-3">
      <label>Nama Barang</label>
      <input type="text" class="form-control" id="nama_barang" placeholder="Cari nama barang">
    </div>

    <div class="col-md-3">
      <label>Kode Transaksi</label>
      <input type="text" class="form-control" id="kode_transaksi" placeholder="TRX-xxx">
    </div>

   <div class="col-md-3">
    <label>Supplier</label>
    <select class="form-control" id="supplier_id" name="supplier_id">
        <option value="">-- Semua Supplier --</option>
        @foreach ($suppliers as $s)
            <option value="{{ $s->id }}">{{ $s->supplier }}</option>
        @endforeach
    </select>
</div>


    <div class="col-md-3 mt-2">
      <label>Jumlah Min</label>
      <input type="number" class="form-control" id="jumlah_min">
    </div>

    <div class="col-md-3 mt-2">
      <label>Jumlah Max</label>
      <input type="number" class="form-control" id="jumlah_max">
    </div>

    <div class="col-md-3 d-flex align-items-end mt-2">
      <button type="submit" class="btn btn-primary mr-2">Filter</button>
      <button type="button" class="btn btn-danger" id="refresh_btn">Reset</button>
    </div>
  </div>
</form>

            </div>
        </div>
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
                                <th>Jumlah Masuk</th>
                                <th>Supplier</th>
                            </tr>
                        </thead>
                        <tbody id="tabel-laporan-barang-masuk">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    // ===============================
    // INIT DATATABLE
    // ===============================
    let table = $('#table_id').DataTable({
        paging: true,
        ordering: true,
        searching: false,
        autoWidth: false,
        language: {
            emptyTable: "Tidak ada data barang masuk"
        }
    });

    // ===============================
    // LOAD DATA
    // ===============================
    function loadData() {
        $.ajax({
            url: '/laporan-barang-masuk/get-data',
            type: 'GET',
            dataType: 'json',
            data: {
                tanggal_mulai   : $('#tanggal_mulai').val(),
                tanggal_selesai : $('#tanggal_selesai').val(),
                nama_barang     : $('#nama_barang').val(),      // siap kalau mau dipakai
                kode_transaksi  : $('#kode_transaksi').val(),   // siap
                supplier_id     : $('#supplier_id').val(),      // siap
                jumlah_min      : $('#jumlah_min').val(),       // siap
                jumlah_max      : $('#jumlah_max').val()        // siap
            },
            success: function (response) {
                table.clear();

                if (!response.length) {
                    table.row.add([
                        '',
                        'Tidak ada data yang tersedia',
                        '',
                        '',
                        '',
                        ''
                    ]).draw(false);
                    return;
                }

                $.each(response, function (index, item) {
                    table.row.add([
                        index + 1,
                        item.kode_transaksi,
                        item.tanggal_masuk,
                        item.nama_barang,
                        item.jumlah_masuk,
                        item.supplier ? item.supplier.supplier : '-'
                    ]);
                });

                table.draw(false);
            },
            error: function (xhr) {
                console.error('AJAX ERROR:', xhr.responseText);
            }
        });
    }

    // ===============================
    // FILTER SUBMIT
    // ===============================
    $('#filter_form').on('submit', function (e) {
        e.preventDefault();
        loadData();
    });

    // ===============================
    // RESET FILTER
    // ===============================
    $('#refresh_btn').on('click', function () {
        $('#filter_form')[0].reset();
        loadData();
    });

    // ===============================
    // PRINT PDF
    // ===============================
  $('#print-barang-masuk').on('click', function () {

    let params = $.param({
        tanggal_mulai   : $('#tanggal_mulai').val(),
        tanggal_selesai : $('#tanggal_selesai').val(),
        nama_barang     : $('#nama_barang').val(),
        supplier_id     : $('#supplier_id').val()
    });

    window.open(
        '/laporan-barang-masuk/print-barang-masuk?' + params,
        '_blank'
    );
});


    // ===============================
    // LOAD AWAL
    // ===============================
    loadData();
});
</script>

@endsection
