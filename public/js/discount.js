$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_discounts() {
        dataTable = $('#discount_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/customize/discount/list",
                type: "POST",
                data: {
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
    populate_discounts();

    $("#discount_table").on("click", '#delete-discount', function() {
        var discount_id = $(this).attr("data-discount-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/discount/delete",
            type: "POST",
            data: {
                'id': discount_id,
                _token
            },
            success: function(response) {
                $('#discount_table').DataTable().destroy();
                populate_discounts();
                toastr.success('SUCCESS!!', response, { timeOut: 5000 })
            },
            error: function(response) {
                toastr.error('ERROR!!', response, { timeOut: 5000 })
            }
        });
    });
});