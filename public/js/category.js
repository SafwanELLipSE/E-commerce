$(document).ready(function () {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');
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
                // $(el).closest("tr").remove();
                // location.reload();
                // $("#category_table").refresh();
                $("#category_table").reload();
                Swal.fire({
                    title: "SUCCESS!",
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