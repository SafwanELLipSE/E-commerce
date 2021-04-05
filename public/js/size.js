$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_sizes() {

        dataTable = $('#size_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "ordering": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/customize/size/list",
                type: "POST",
                data: {
                    'status': $("#status").val(),
                    'subCategory': $("#subCategorySelect").val(),
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
    populate_sizes();

    $("#status").on("change", function() {
        dataTable.destroy();
        populate_sizes();
    });

    $("#subCategorySelect").on("change", function() {
        dataTable.destroy();
        populate_sizes();
    });

    $("#size_table").on("click", '#delete-size', function() {
        var size_id = $(this).attr("data-size-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/size/delete",
            type: "POST",
            data: {
                'id': size_id,
                _token
            },
            success: function(response) {
                $('#size_table').DataTable().destroy();
                populate_sizes();
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