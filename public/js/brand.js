$(document).ready(function () {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');
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
                // $(el).closest("tr").remove();
                location.reload();
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
        $('#brand_table').listview("refresh");

        return false;
    });
});