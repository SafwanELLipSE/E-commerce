$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_discounts() {
        dataTable = $('#discount_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/customize/discount/list",
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
    populate_discounts();

    $("#discount_table").on("click", '#delete-discount', function() {
        var discount_id = $(this).attr("data-discount-id");
        $.ajax({
            url: ssl + window.location.hostname + "/customize/discount/delete",
            type: "POST",
            data: {
                'id': discount_id,
                _token
            },
            success: function(response) {
                $('#discount_table').DataTable().destroy();
                populate_discounts();
                toastr.success('SUCCESS!!', response, { timeOut: 5000 })
            },
            error: function(response) {
                toastr.error('ERROR!!', response, { timeOut: 5000 })
            }
        });
    });

    $(document).on('click', '#bulk_delete', function() {
        var id = [];
        toastr.warning("<br /><button type='button' value='yes'>Yes</button><button type='button' value='no' >No</button>", 'Are you sure you want to delete this Discounts?', {
            allowHtml: true,
            timeOut: 1500,
            "positionClass": "toast-top-center",
            onclick: function(toast) {
                value = toast.target.value
                if (value == 'yes') {
                    $('.discount_checkbox:checked').each(function() {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: ssl + window.location.hostname + "/customize/discount/delete-selected",
                            method: "POST",
                            data: {
                                id: id,
                                _token
                            },
                            success: function(data) {
                                $('#discount_table').DataTable().destroy();
                                populate_discounts();
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
        toastr.warning("<br /><button type='button' value='yes'>Yes</button><button type='button' value='no' >No</button>", 'Are you sure you want to delete All Discounts?', {
            allowHtml: true,
            timeOut: 1500,
            "positionClass": "toast-top-center",
            onclick: function(toast) {
                value = toast.target.value
                if (value == 'yes') {
                    $.ajax({
                        url: ssl + window.location.hostname + "/customize/discount/delete-all",
                        method: "POST",
                        data: {
                            _token
                        },
                        success: function(data) {
                            $('#discount_table').DataTable().destroy();
                            populate_discounts();
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