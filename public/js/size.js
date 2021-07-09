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

    $(document).on('click', '#bulk_delete_size', function() {
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
    $(document).on('click', '#delete_all_size', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete All Sizes!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: ssl + window.location.hostname + "/customize/size/delete-all",
                    method: "POST",
                    data: {
                        _token
                    },
                    success: function(data) {
                        $('#size_table').DataTable().destroy();
                        populate_sizes();
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