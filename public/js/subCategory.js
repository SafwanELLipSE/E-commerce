$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_categories() {

        dataTable = $('#subCategory_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "ordering": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/customize/subCategory/list",
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
    populate_categories();

    $("#status").on("change", function() {
        dataTable.destroy();
        populate_categories();
    });

    $("#subCategory_table").on("click", '#delete-subCategory', function() {
        var category_id = $(this).attr("data-subCategory-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/subCategory/delete",
            type: "POST",
            data: {
                'id': category_id,
                _token
            },
            success: function(response) {
                $('#subCategory_table').DataTable().destroy();
                populate_categories();
                Swal.fire({
                    title: "SUCCESS!!",
                    text: response,
                    type: "success",
                });

            },
            error: function(response) {
                Swal.fire({
                    title: "ERROR!",
                    text: response,
                    type: "error",
                });
            }
        });
    });
});