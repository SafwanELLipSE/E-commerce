$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_products() {

        dataTable = $('#product_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/customize/product/list",
                type: "POST",
                data: {
                    'brand': $("#brand").val(),
                    'category': $("#category").val(),
                    'subCategory': $("#subCategory").val(),
                    'status': $("#status").val(),
                    'status_discount': $("#status_discount").val(),
                    _token
                },
            },
            "language": {
                "paginate": {
                    "previous": "&#706",
                    "next": "&#707"
                }
            }
        });

    }
    populate_products();

    $("#status_discount").on("change", function() {
        dataTable.destroy();
        populate_products();
    });

    $("#status").on("change", function() {
        dataTable.destroy();
        populate_products();
    });

    $("#brand").on("change", function() {
        dataTable.destroy();
        populate_products();
    });

    $("#category").on("change", function() {
        dataTable.destroy();
        populate_products();
    });

    $("#subCategory").on("change", function() {
        dataTable.destroy();
        populate_products();
    });

    $("#product_table").on("click", '#delete-product', function() {
        var product_id = $(this).attr("data-product-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/product/delete",
            type: "POST",
            data: {
                'id': product_id,
                _token
            },
            success: function(response) {
                $('#product_table').DataTable().destroy();
                populate_products();
                Swal.fire({
                    title: "SUCCESS!!",
                    text: response,
                    type: "success",
                });
            },
            error: function(response) {
                Swal.fire({
                    title: "ERROR!",
                    text: response.responseJSON,
                    type: "error",
                });
            }
        });
    });

    $(document).on('click', '#bulk_delete', function() {
        var id = [];
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete the Selected!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('.product_checkbox:checked').each(function() {
                    id.push($(this).val());
                });
                if (id.length > 0) {
                    $.ajax({
                        url: ssl + window.location.hostname + "/customize/product/delete-selected",
                        method: "POST",
                        data: {
                            id: id,
                            _token
                        },
                        success: function(data) {
                            $('#product_table').DataTable().destroy();
                            populate_products();
                            Swal.fire({
                                title: "SUCCESS!!",
                                text: data,
                                type: "success",
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                title: "ERROR!",
                                text: response.responseJSON,
                                type: "error",
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: "ERROR!",
                        text: "Please select at least one checkbox",
                        type: "error",
                    });
                }
            }
        })
    });
    $(document).on('click', '#delete_all', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete All Products!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: ssl + window.location.hostname + "/customize/product/delete-all",
                    method: "POST",
                    data: {
                        _token
                    },
                    success: function(data) {
                        $('#product_table').DataTable().destroy();
                        populate_products();
                        Swal.fire(
                            'Deleted!',
                            data,
                            'success'
                        )
                    }
                });
            }
        })
    });
});