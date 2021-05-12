$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_stocks() {
        dataTable = $('#stock_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "ordering": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/utilize/stock/list",
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
    populate_stocks();

    $("#stock_table").on("click", '#delete-stock', function() {
        var stock_id = $(this).attr("data-stock-id");
        $.ajax({
            url: ssl + window.location.hostname + "/utilize/stock/delete",
            type: "POST",
            data: {
                'id': stock_id,
                _token
            },
            success: function(response) {
                $('#stock_table').DataTable().destroy();
                populate_stocks();
                toastr.success('SUCCESS!!', response, { timeOut: 5000 })
            },
            error: function(response) {
                toastr.error('ERROR!!', response, { timeOut: 5000 })
            }
        });
    });
});