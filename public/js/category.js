$(document).ready(function () {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');
    function populate_categories() {

        dataTable = $('#category_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "ordering": false,
            "ajax":
            {
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
    populate_categories();

    $("#status").on("change", function () {
        dataTable.destroy();
        populate_categories();
    });

    $("#category_table").on("click", '#delete-category', function () {
        var category_id = $(this).attr("data-category-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/category/delete",
            type: "POST",
            data: {
                'id': category_id,
                _token
            },
            success: function (response) {
                $('#category_table').DataTable().destroy();
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
        $('#category_table').listview("refresh");

        return false;
    });
});