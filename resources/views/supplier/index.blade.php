@extends('layouts.app')

@include('supplier.create')
@include('supplier.edit')

@section('content')
    <div class="section-header">
        <h1>Data Supplier</h1>
        <div class="ml-auto">
            <a href="javascript:void(0)" class="btn btn-primary" id="button_tambah_supplier"><i class="fa fa-plus"></i>
                Supplier</a>
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
<th>Nama Perusahaan</th>
<th>Alamat</th>
<th>Deskripsi</th> <!-- ✅ TAMBAH -->
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
            $('#table_id').DataTable();

            $.ajax({
                url: "/supplier/get-data",
                type: "GET",
                dataType: 'JSON',
                success: function(response) {
                    let counter = 1;
                    if ($.fn.DataTable.isDataTable('#table_id')) {
                        $('#table_id').DataTable().destroy();
                    }

                    $('#table_id').DataTable().clear();
                    $.each(response.data, function(key, value) {
                        let supplier = `
                <tr class="barang-row" id="index_${value.id}">
                    <td>${counter++}</td>
                    <td>${value.supplier}</td>
                    <td>${value.alamat}</td>
                    <td>${value.deskripsi ?? '-'}</td>
                    <td>
                        <a href="javascript:void(0)" id="button_edit_supplier" data-id="${value.id}" class="btn btn-icon btn-warning btn-lg mb-2"><i class="far fa-edit"></i> </a>
                        <a href="javascript:void(0)" id="button_hapus_supplier" data-id="${value.id}" class="btn btn-icon btn-danger btn-lg mb-2"><i class="fas fa-trash"></i> </a>
                    </td>
                </tr>
            `;
                        $('#table_id').DataTable().row.add($(supplier)).draw(false);
                    });
                }
            });
        });
    </script>

    <!-- Show Modal Tambah Jenis Barang -->
    <script>
        $('body').on('click', '#button_tambah_supplier', function() {
            $('#modal_tambah_supplier').modal('show');
        });

        $(document).off('click', '#store_supplier').on('click', '#store_supplier', function(e) {
    e.preventDefault();

    let formData = new FormData();
    formData.append('supplier', $('#supplier').val());
    formData.append('alamat', $('#alamat').val());
    formData.append('deskripsi', $('#deskripsi').val());
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
        url: '/supplier',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,

        beforeSend: function () {
            $('.alert').addClass('d-none');
            $('#store_supplier').prop('disabled', true).text('Menyimpan...');
        },

        success: function (res) {

            Swal.fire({
                icon: 'success',
                title: res.message
            });

            $('#modal_tambah_supplier').modal('hide');
            $('#store_supplier').prop('disabled', false).text('Tambah');

            // reset form
            $('#supplier').val('');
            $('#alamat').val('');
            $('#deskripsi').val('');

            loadSupplier();
        },

        error: function (xhr) {

            $('#store_supplier').prop('disabled', false).text('Tambah');

            if (xhr.status === 422) {

                let errors = xhr.responseJSON;

                if (errors.supplier)
                    $('#alert-supplier').removeClass('d-none').text(errors.supplier[0]);

                if (errors.alamat)
                    $('#alert-alamat').removeClass('d-none').text(errors.alamat[0]);

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
function loadSupplier() {

    let table = $('#table_id').DataTable();
    table.clear();

    $.ajax({
        url: "/supplier/get-data",
        type: "GET",
        success: function(response) {

            let counter = 1;

            $.each(response.data, function(key, value) {

                let row = `
                    <tr id="index_${value.id}">
                        <td>${counter++}</td>
                        <td>${value.supplier}</td>
                        <td>${value.alamat}</td>
                        <td>${value.deskripsi ?? '-'}</td>
                        <td>
                            <a href="javascript:void(0)" data-id="${value.id}" class="btn btn-warning btn-sm" id="button_edit_supplier">Edit</a>
                            <a href="javascript:void(0)" data-id="${value.id}" class="btn btn-danger btn-sm" id="button_hapus_supplier">Hapus</a>
                        </td>
                    </tr>
                `;

                table.row.add($(row)).draw(false);

            });

        }
    });
}
    </script>

    <!-- Edit Data Jenis Barang -->
 <script>
    // ================= SHOW MODAL EDIT =================
$(document).on('click', '#button_edit_supplier', function () {

    let supplier_id = $(this).data('id');

    $.ajax({
        url: `/supplier/${supplier_id}/edit`,
        type: "GET",

        success: function (response) {

            let data = response.data;

            $('#supplier_id').val(data.id);
            $('#edit_supplier').val(data.supplier);
            $('#edit_alamat').val(data.alamat);
            $('#edit_deskripsi').val(data.deskripsi);

            $('#modal_edit_supplier').modal('show');
        },

        error: function (xhr) {
            console.log("ERROR EDIT:", xhr.responseText);
        }
    });

});


// ================= UPDATE DATA =================
$(document).off('click', '#update_supplier').on('click', '#update_supplier', function (e) {

    e.preventDefault();

    let supplier_id = $('#supplier_id').val();

    if (!supplier_id) {
        alert('ID tidak ditemukan');
        return;
    }

    let formData = new FormData();

    formData.append('supplier', $('#edit_supplier').val());
    formData.append('alamat', $('#edit_alamat').val());
    formData.append('deskripsi', $('#edit_deskripsi').val());
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append('_method', 'PUT');

    $.ajax({
        url: `/supplier/${supplier_id}`,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,

        beforeSend: function () {
            $('#update_supplier')
                .prop('disabled', true)
                .text('Menyimpan...');
        },

        success: function (res) {

            console.log("UPDATE SUCCESS:", res);

            Swal.fire({
                icon: 'success',
                title: res.message
            });

            $('#modal_edit_supplier').modal('hide');

            $('#update_supplier')
                .prop('disabled', false)
                .text('Update');

            // 🔥 reload data biar konsisten
            loadSupplier();

        },

        error: function (xhr) {

            console.log("UPDATE ERROR:", xhr.responseText);

            $('#update_supplier')
                .prop('disabled', false)
                .text('Update');

            if (xhr.status === 422) {

                let errors = xhr.responseJSON;

                if (errors.supplier)
                    $('#alert-edit-supplier').removeClass('d-none').text(errors.supplier[0]);

                if (errors.alamat)
                    $('#alert-edit-alamat').removeClass('d-none').text(errors.alamat[0]);

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
 </script>

    <!-- Hapus Data Barang -->
    <script>
        $('body').on('click', '#button_hapus_supplier', function() {
            let supplier_id = $(this).data('id');
            let token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "ingin menghapus data ini !",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'TIDAK',
                confirmButtonText: 'YA, HAPUS!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/supplier/${supplier_id}`,
                        type: "DELETE",
                        cache: false,
                        data: {
                            "_token": token
                        },
                        success: function(response) {
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: true,
                                timer: 3000
                            });
                            $(`#index_${supplier_id}`).remove();

                            $.ajax({
                                url: "/supplier/get-data",
                                type: "GET",
                                dataType: 'JSON',
                                success: function(response) {
                                    let counter = 1;
                                    if ($.fn.DataTable.isDataTable('#table_id')) {
                                        $('#table_id').DataTable().destroy();
                                    }

                                    $('#table_id').DataTable().clear();
                                    $.each(response.data, function(key, value) {
                                        let supplier = `
                                        <tr class="barang-row" id="index_${value.id}">
                                            <td>${counter++}</td>
                                            <td>${value.supplier}</td>
                                            <td>${value.alamat}</td>
                                            <td>${value.deskripsi ?? '-'}</td>
                                            <td>
                                                <a href="javascript:void(0)" id="button_edit_supplier" data-id="${value.id}" class="btn btn-icon btn-warning btn-lg mb-2"><i class="far fa-edit"></i> </a>
                                                <a href="javascript:void(0)" id="button_hapus_supplier" data-id="${value.id}" class="btn btn-icon btn-danger btn-lg mb-2"><i class="fas fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    `;
                                        $('#table_id').DataTable().row.add(
                                            $(supplier)).draw(false);
                                    });
                                }
                            });
                        }
                    })
                }
            });
        });
    </script>
@endsection
