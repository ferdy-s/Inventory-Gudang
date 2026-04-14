@extends('layouts.app')

@include('customer.create')
@include('customer.edit')

@section('content')
    <div class="section-header">
        <h1>Data Customer</h1>
        <div class="ml-auto">
            <a href="javascript:void(0)" class="btn btn-primary" id="button_tambah_customer"><i class="fa fa-plus"></i>
                Customer</a>
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
                                    <th>Nama Customer</th>
                                    <th>Alamat</th>
                                    <th>Deskripsi</th>
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
            url: "/customer/get-data",
            type: "GET",
            dataType: 'JSON',
            success: function(response) {

                table.clear().draw();

                let counter = 1;
                $.each(response.data, function(key, value) {

                    let row = `
                    <tr id="index_${value.id}">
                        <td>${counter++}</td>
                        <td>${value.customer}</td>
                        <td>${value.alamat}</td>
                        <td>${value.deskripsi ?? '-'}</td>
                        <td>
                            <a href="javascript:void(0)" data-id="${value.id}" class="btn btn-warning btn-sm button_edit_customer">Edit</a>
                            <a href="javascript:void(0)" data-id="${value.id}" class="btn btn-danger btn-sm button_hapus_customer">Hapus</a>
                        </td>
                    </tr>
                    `;

                    table.row.add($(row)).draw(false);
                });
            }
        });
    }

    // load awal
    loadData();

    // ================= MODAL TAMBAH =================
// ================= MODAL TAMBAH =================
$('body').on('click', '#button_tambah_customer', function() {
    $('#modal_tambah_customer').modal('show');
});
    // ================= STORE =================
// ================= STORE =================
$('body').on('click', '#store_customer', function(e) {

    e.preventDefault();

    $.ajax({
        url: '/customer',
        type: 'POST',
        data: {
            customer: $('#customer').val(),
            alamat: $('#alamat').val(),
            deskripsi: $('#deskripsi').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        },

        success: function(res) {

            Swal.fire({
                icon: 'success',
                title: res.message,
                timer: 2000,
                showConfirmButton: false
            });

            $('#modal_tambah_customer').modal('hide');

            $('#customer').val('');
            $('#alamat').val('');
            $('#deskripsi').val('');

            $('#alert-customer').addClass('d-none');
            $('#alert-alamat').addClass('d-none');

            loadData();
        },
error: function(err) {

    console.log(err); // 🔥 LIHAT ERROR ASLI DI CONSOLE

    Swal.fire({
        icon: 'error',
        title: 'ERROR',
        text: err.responseText // 🔥 tampilkan error Laravel
    });

}
    });

});
    // ================= EDIT =================
    $('body').on('click', '.button_edit_customer', function() {

        let id = $(this).data('id');

        $.get(`/customer/${id}/edit`, function(response) {

            $('#customer_id').val(response.data.id);
            $('#edit_customer').val(response.data.customer);
            $('#edit_alamat').val(response.data.alamat);
            $('#edit_deskripsi').val(response.data.deskripsi);

            $('#modal_edit_customer').modal('show');
        });
    });

    // ================= UPDATE =================
    $('body').on('click', '#update', function(e) {
        e.preventDefault();

        let id = $('#customer_id').val();

        let formData = new FormData();
        formData.append('customer', $('#edit_customer').val());
        formData.append('alamat', $('#edit_alamat').val());
        formData.append('deskripsi', $('#edit_deskripsi').val());
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('_method', 'PUT');

        $.ajax({
            url: `/customer/${id}`,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function(response) {

                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                $('#modal_edit_customer').modal('hide');
                loadData();
            }
        });
    });

    // ================= DELETE =================
    $('body').on('click', '.button_hapus_customer', function() {

        let id = $(this).data('id');

        Swal.fire({
            title: 'Yakin?',
            text: "Data akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: `/customer/${id}`,
                    type: "DELETE",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {

                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        loadData();
                    }
                });
            }
        });
    });

});
</script>
@endsection
