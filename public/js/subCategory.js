$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_categories() {

        dataTable = $('#subCategory_table').DataTable({
            "serverSide": false,
            "processing": true,
            "pageLength": 10,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/customize/subCategory/list",
                type: "POST",
                data: {
                    'status': $("#status").val(),
                    'category': $("#category").val(),
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
    populate_categories();

    $("#status").on("change", function() {
        dataTable.destroy();
        populate_categories();
    });

    $("#category").on("change", function() {
        dataTable.destroy();
        populate_categories();
    });

    $("#subCategory_table").on("click", '#delete-subCategory', function() {
        var subCategory_id = $(this).attr("data-subCategory-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/subCategory/delete",
            type: "POST",
            data: {
                'id': subCategory_id,
                _token
            },
            success: function(response) {
                $('#subCategory_table').DataTable().destroy();
                populate_categories();
                toastr.success('SUCCESS!!', response, { timeOut: 5000 })
            },
            error: function(response) {
                toastr.error('ERROR!!', response, { timeOut: 5000 })
            }
        });
    });
});