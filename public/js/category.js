$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_category() {

        dataTable = $('#category_table').DataTable({
            "serverSide": false,
            "processing": false,
            "pageLength": 10,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
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
    populate_category();

    $("#status").on("change", function() {
        dataTable.destroy();
        populate_category();
    });

    $("#category_table").on("click", '#delete-category', function() {
        var category_id = $(this).attr("data-category-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/category/delete",
            type: "POST",
            data: {
                'id': category_id,
                _token
            },
            success: function(response) {
                $('#category_table').DataTable().destroy();
                populate_category();
                toastr.success('SUCCESS!!', response, { timeOut: 5000 })
            },
            error: function(response) {
                toastr.error('ERROR!!', response, { timeOut: 5000 })
            }
        });
    });

    $(document).on('click', '#bulk_delete', function() {
        var id = [];
        toastr.warning("<br /><button type='button' value='yes'>Yes</button><button type='button' value='no' >No</button>", 'Are you sure you want to delete this Categories?', {
            allowHtml: true,
            timeOut: 7000,
            "positionClass": "toast-top-center",
            onclick: function(toast) {
                value = toast.target.value
                if (value == 'yes') {
                    $('.category_checkbox:checked').each(function() {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: ssl + window.location.hostname + "/customize/category/delete-selected",
                            method: "POST",
                            data: {
                                id: id,
                                _token
                            },
                            success: function(data) {
                                $('#category_table').DataTable().destroy();
                                populate_category();
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
    $(document).on('click', '#delete_all', function() {
        toastr.warning("<br /><button type='button' value='yes'>Yes</button><button type='button' value='no' >No</button>", 'Are you sure you want to delete All Categories?', {
            allowHtml: true,
            timeOut: 1500,
            "positionClass": "toast-top-center",
            onclick: function(toast) {
                value = toast.target.value
                if (value == 'yes') {
                    $.ajax({
                        url: ssl + window.location.hostname + "/customize/category/delete-all",
                        method: "POST",
                        data: {
                            _token
                        },
                        success: function(data) {
                            $('#category_table').DataTable().destroy();
                            populate_category();
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