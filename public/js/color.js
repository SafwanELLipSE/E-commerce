$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_colors() {

        dataTable = $('#color_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "ordering": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/customize/color/list",
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
    populate_colors();

    $("#color_table").on("click", '#delete-color', function() {
        var color_id = $(this).attr("data-color-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/color/delete",
            type: "POST",
            data: {
                'id': color_id,
                _token
            },
            success: function(response) {
                $('#color_table').DataTable().destroy();
                populate_colors();
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