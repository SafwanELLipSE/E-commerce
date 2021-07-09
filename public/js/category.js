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
            confirmButtonText: 'Yes, delete All Categories!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: ssl + window.location.hostname + "/customize/category/delete-all",
                    method: "POST",
                    data: {
                        _token
                    },
                    success: function(data) {
                        $('#category_table').DataTable().destroy();
                        populate_category();
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