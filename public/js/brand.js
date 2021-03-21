$(document).ready(function () {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');
    function populate_brands() {

        dataTable = $('#brand_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "ordering": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print' , 'colvis'
            ],
            "ajax":
            {
                url: ssl + window.location.hostname + "/customize/brand/list",
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
    populate_brands();

    $("#status").on("change", function () {
        dataTable.destroy();
        populate_brands();
    });

    $("#brand_table").on("click", '#delete-brand', function () {
        var brand_id = $(this).attr("data-brand-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/brand/delete",
            type: "POST",
            data: {
                'id': brand_id,
                _token
            }, 
            success: function (response) {
                $('#brand_table').DataTable().destroy();
                populate_brands();
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