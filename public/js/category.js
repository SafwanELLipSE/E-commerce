$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_category() {

        dataTable = $('#category_table').DataTable({
            "serverSide": false,
            "processing": true,
            "pageLength": 10,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/customize/category/list",
                type: "POST",
                data: {
                    'status': $("#status").val(),
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
    populate_category();

    $("#status").on("change", function() {
        dataTable.destroy();
        populate_category();
    });

    $("#category_table").on("click", '#delete-category', function() {
        var category_id = $(this).attr("data-category-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/category/delete",
            type: "POST",
            data: {
                'id': category_id,
                _token
            },
            success: function(response) {
                $('#category_table').DataTable().destroy();
                populate_category();
                toastr.success('SUCCESS!!', response, { timeOut: 5000 })
            },
            error: function(response) {
                toastr.error('ERROR!!', response, { timeOut: 5000 })
            }
        });
    });
});