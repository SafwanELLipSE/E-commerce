$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_sizes() {

        dataTable = $('#size_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/customize/size/list",
                type: "POST",
                data: {
                    'status': $("#status").val(),
                    'subCategory': $("#subCategorySelect").val(),
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
    populate_sizes();

    $("#status").on("change", function() {
        dataTable.destroy();
        populate_sizes();
    });

    $("#subCategorySelect").on("change", function() {
        dataTable.destroy();
        populate_sizes();
    });

    $("#size_table").on("click", '#delete-size', function() {
        var size_id = $(this).attr("data-size-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/size/delete",
            type: "POST",
            data: {
                'id': size_id,
                _token
            },
            success: function(response) {
                $('#size_table').DataTable().destroy();
                populate_sizes();
                toastr.success('SUCCESS!!', response, { timeOut: 5000 })
            },
            error: function(response) {
                toastr.error('ERROR!!', response, { timeOut: 5000 })
            }
        });
    });

    $(document).on('click', '#bulk_delete_size', function() {
        var id = [];
        toastr.warning("<br /><button type='button' value='yes'>Yes</button><button type='button' value='no' >No</button>", 'Are you sure you want to delete this item?', {
            allowHtml: true,
            timeOut: 1500,
            "positionClass": "toast-top-center",
            onclick: function(toast) {
                value = toast.target.value
                if (value == 'yes') {
                    $('.size_checkbox:checked').each(function() {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: ssl + window.location.hostname + "/customize/size/delete-selected",
                            method: "POST",
                            data: {
                                id: id,
                                _token
                            },
                            success: function(data) {
                                $('#size_table').DataTable().destroy();
                                populate_sizes();
                                toastr.success('SUCCESS!!', data, { timeOut: 5000 })
                            }
                        });
                    } else {
                        toastr.error("Please select at least one checkbox", { timeOut: 1500 });
                    }
                } else {
                    console.log('cancel');
                }
            }
        })
    });
    $(document).on('click', '#delete_all_size', function() {
        toastr.warning("<br /><button type='button' value='yes'>Yes</button><button type='button' value='no' >No</button>", 'Are you sure you want to delete All Stocks?', {
            allowHtml: true,
            timeOut: 1500,
            "positionClass": "toast-top-center",
            onclick: function(toast) {
                value = toast.target.value
                if (value == 'yes') {
                    $.ajax({
                        url: ssl + window.location.hostname + "/customize/size/delete-all",
                        method: "POST",
                        data: {
                            _token
                        },
                        success: function(data) {
                            $('#size_table').DataTable().destroy();
                            populate_sizes();
                            toastr.success('SUCCESS!!', data, { timeOut: 5000 })
                        }
                    });
                } else {
                    console.log('cancel');
                }
            }
        })
    });
});