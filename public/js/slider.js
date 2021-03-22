$(document).ready(function () {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');
    function populate_sliders() {

        dataTable = $('#slider_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "ordering": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax":
            {
                url: ssl + window.location.hostname + "/customize/slider/list",
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
    populate_sliders();

    $("#status").on("change", function () {
        dataTable.destroy();
        populate_sliders();
    });

    $("#slider_table").on("click", '#delete-slider', function () {
        var category_id = $(this).attr("data-slider-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/slider/delete",
            type: "POST",
            data: {
                'id': category_id,
                _token
            },
            success: function (response) {
                $('#slider_table').DataTable().destroy();
                populate_sliders();
                Swal.fire({
                    title: "SUCCESS!!",
                    text: response,
                    type: "success",
                });

            },
            error: function (response) {
                Swal.fire({
                    title: "ERROR!",
                    text: response,
                    type: "error",
                });
            }
        });
    });
});