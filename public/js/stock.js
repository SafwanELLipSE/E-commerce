$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_stocks() {
        dataTable = $('#stock_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "order": [],
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
                Swal.fire({
                    title: "SUCCESS!!",
                    text: response,
                    type: "success",
                });
            },
            error: function(response) {
                Swal.fire({
                    title: "ERROR!",
                    text: response.responseJSON,
                    type: "error",
                });
            }
        });
    });

    $(document).on('click', '#bulk_delete', function() {
        var id = [];
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete the Selected!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('.stack_checkbox:checked').each(function() {
                    id.push($(this).val());
                });
                if (id.length > 0) {
                    $.ajax({
                        url: ssl + window.location.hostname + "/utilize/stock/delete-selected",
                        method: "POST",
                        data: {
                            id: id,
                            _token
                        },
                        success: function(data) {
                            $('#stock_table').DataTable().destroy();
                            populate_stocks();
                            Swal.fire({
                                title: "SUCCESS!!",
                                text: data,
                                type: "success",
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                title: "ERROR!",
                                text: response.responseJSON,
                                type: "error",
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: "ERROR!",
                        text: "Please select at least one checkbox",
                        type: "error",
                    });
                }
            }
        })
    });
    $(document).on('click', '#delete_all', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete All Stocks!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: ssl + window.location.hostname + "/utilize/stock/delete-all",
                    method: "POST",
                    data: {
                        _token
                    },
                    success: function(data) {
                        $('#stock_table').DataTable().destroy();
                        populate_stocks();
                        Swal.fire(
                            'Deleted!',
                            data,
                            'success'
                        )
                    }
                });
            }
        })
    });
});