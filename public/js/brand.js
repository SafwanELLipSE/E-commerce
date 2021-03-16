$(document).ready(function () {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');
    $("#brand_table").on("click", '#delete-brand', function () {
        var medicine_id = $(this).attr("data-brand-id");
        console.log(medicine_id, _token);
        $.ajax({
            url: ssl + window.location.hostname + "/customize/brand/deleteBrand",
            type: "POST",
            data: {
                'id': medicine_id,
                _token
            },
            success: function (response) {
                Swal.fire({
                    title: "SUCCESS!!",
                    text: response,
                    type: "success",
                });

            }
        });
    });
});