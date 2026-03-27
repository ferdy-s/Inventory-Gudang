@extends('layouts.app')

@section('content')

<div class="section-header">
    <h1>Laporan Barang Keluar</h1>
    <div class="ml-auto">
        <a href="javascript:void(0)" class="btn btn-danger" id="print-barang-keluar">
            <i class="fa fa-print"></i> Print PDF
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        <!-- FILTER -->
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
                            <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang">
                        </div>

                        <div class="col-md-3">
                            <label>Customer</label>
                            <select id="customer_id" class="form-control">
                                <option value="">-- Semua Customer --</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->customer }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mt-3 text-right">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <button type="button" id="refresh_btn" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- TABLE -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_id" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal Keluar</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Keluar</th>
                                <th>Customer</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- SCRIPT -->
<script>
$(document).ready(function () {

    const table = $('#table_id').DataTable({
        paging: true,
        ordering: true,
        searching: false
    });

    loadData();

    $('#filter_form').on('submit', function (e) {
        e.preventDefault();
        loadData();
    });

    $('#refresh_btn').on('click', function () {
        $('#filter_form')[0].reset();
        loadData();
    });

    function loadData() {
        $.ajax({
            url: '/laporan-barang-keluar/get-data',
            type: 'GET',
            data: {
                tanggal_mulai: $('#tanggal_mulai').val(),
                tanggal_selesai: $('#tanggal_selesai').val(),
                nama_barang: $('#nama_barang').val(),
                customer_id: $('#customer_id').val()
            },
            success: function (response) {
                table.clear();

                if (response.length === 0) {
                    table.row.add([
                        '', 'Tidak ada data', '', '', '', ''
                    ]).draw();
                    return;
                }

                $.each(response, function (index, item) {
                    table.row.add([
                        index + 1,
                        item.kode_transaksi,
                        item.tanggal_keluar,
                        item.nama_barang,
                        item.jumlah_keluar,
                        item.customer ? item.customer.customer : '-'
                    ]);
                });

                table.draw();
            }
        });
    }

    $('#print-barang-keluar').on('click', function () {
        let url = '/laporan-barang-keluar/print-barang-keluar' +
            '?tanggal_mulai=' + $('#tanggal_mulai').val() +
            '&tanggal_selesai=' + $('#tanggal_selesai').val() +
            '&nama_barang=' + $('#nama_barang').val() +
            '&customer_id=' + $('#customer_id').val();

        window.location.href = url;
    });

});
</script>

@endsection
