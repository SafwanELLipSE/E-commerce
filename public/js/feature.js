$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_features() {

        dataTable = $('#feature_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "ordering": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/customize/feature/list",
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
    populate_features();

    $("#feature_table").on("click", '#delete-feature', function() {
        var feature_id = $(this).attr("data-feature-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/feature/delete",
            type: "POST",
            data: {
                'id': feature_id,
                _token
            },
            success: function(response) {
                $('#feature_table').DataTable().destroy();
                populate_features();
                toastr.success('SUCCESS!!', response, { timeOut: 5000 })
            },
            error: function(response) {
                toastr.error('ERROR!!', response, { timeOut: 5000 })
            }
        });
    });
});