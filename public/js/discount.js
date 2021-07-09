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
            confirmButtonText: 'Yes, delete All Discounts!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: ssl + window.location.hostname + "/customize/discount/delete-all",
                    method: "POST",
                    data: {
                        _token
                    },
                    success: function(data) {
                        $('#discount_table').DataTable().destroy();
                        populate_discounts();
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