$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_subCategory() {

        dataTable = $('#subCategory_table').DataTable({
            "serverSide": false,
            "processing": true,
            "pageLength": 10,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/customize/subCategory/list",
                type: "POST",
                data: {
                    'status': $("#status").val(),
                    'category': $("#category").val(),
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
    populate_subCategory();

    $("#status").on("change", function() {
        dataTable.destroy();
        populate_subCategory();
    });

    $("#category").on("change", function() {
        dataTable.destroy();
        populate_subCategory();
    });

    $("#subCategory_table").on("click", '#delete-subCategory', function() {
        var subCategory_id = $(this).attr("data-subCategory-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/subCategory/delete",
            type: "POST",
            data: {
                'id': subCategory_id,
                _token
            },
            success: function(response) {
                $('#subCategory_table').DataTable().destroy();
                populate_subCategory();
                toastr.success('SUCCESS!!', response, { timeOut: 5000 })
            },
            error: function(response) {
                toastr.error('ERROR!!', response, { timeOut: 5000 })
            }
        });
    });

    $(document).on('click', '#bulk_delete_subCategory', function() {
        var id = [];
        toastr.warning("<br /><button type='button' value='yes'>Yes</button><button type='button' value='no' >No</button>", 'Are you sure you want to delete this Sub-Categories?', {
            allowHtml: true,
            timeOut: 7000,
            "positionClass": "toast-top-center",
            onclick: function(toast) {
                value = toast.target.value
                if (value == 'yes') {
                    $('.subCategory_checkbox:checked').each(function() {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: ssl + window.location.hostname + "/customize/subCategory/delete-selected",
                            method: "POST",
                            data: {
                                id: id,
                                _token
                            },
                            success: function(data) {
                                $('#subCategory_table').DataTable().destroy();
                                populate_subCategory();
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
    $(document).on('click', '#delete_all_subCategory', function() {
        toastr.warning("<br /><button type='button' value='yes'>Yes</button><button type='button' value='no' >No</button>", 'Are you sure you want to delete All Sub-Categories?', {
            allowHtml: true,
            timeOut: 1500,
            "positionClass": "toast-top-center",
            onclick: function(toast) {
                value = toast.target.value
                if (value == 'yes') {
                    $.ajax({
                        url: ssl + window.location.hostname + "/customize/subCategory/delete-all",
                        method: "POST",
                        data: {
                            _token
                        },
                        success: function(data) {
                            $('#subCategory_table').DataTable().destroy();
                            populate_subCategory();
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