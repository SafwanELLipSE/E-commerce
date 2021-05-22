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
                toastr.success('SUCCESS!!', response, { timeOut: 5000 })
            },
            error: function(response) {
                toastr.error('ERROR!!', response, { timeOut: 5000 })
            }
        });
    });
});