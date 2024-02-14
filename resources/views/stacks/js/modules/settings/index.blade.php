<script>

    $(function () {
        var
            filters = {
            },
            columns = [
                {data: 'first_name', orderable: true},
                {data: 'email', orderable: true},
                {data: 'mobile', orderable: true},
                {data: 'status', orderable: false},
                {data: 'id', orderable: false},
                {data: 'id', orderable: false},
            ],
            columnDefs = [				
                {
                    "targets": [3],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        var status = full.status ? 'checked':'';
                        return '<div class="d-flex gap-3 justify-content">' +
                                '<label class="switch">\n' +
                                '<input type="checkbox" class="switch-input" ' + status +' onclick="statusChange(' + id + ','+ full.status +')">' +
                                    '                                <!--<i class="icon-play"></i>-->\n' +
                                    '<span class="switch-label" data-on="Active" data-off="Deactive"></span>\n' +
                                    '<span class="switch-handle"></span>\n' +
                                '</label>'+
                            '</div>';
                    }
                },
                {
                    "targets": [4],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        var status = full.status ? 'checked':'';

                        return '<div class="d-flex gap-3 justify-content-center">'+
                                '<button class="text-white bg-success border-0 p-1 rounded-4" onclick="openAddModal(' + id + ')" title="Edit"> <i class="fa-solid fa-pen-to-square"></i> </button>'+
                                '<button class="text-white bg-danger border-0 p-1 rounded-4" onclick="remove(' + full.id + ')" title="Delete"> <i class="fa-solid fa-trash"></i> </button>'+
                                '</div>';
                    }
                },
                {
                    "targets": [5],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;

                        return '<button class="text-white bg-primary btn-block border-0 p-1 rounded-4 " onclick="resetPassword(' + id + ')"> Reset </button>';
                    }
                }
                ],
            dataTable = callDataTable('agent-table', '{!! route('admin-login.data') !!}', filters, columns, '', '', columnDefs);

        // setInterval(function () {
        //     $('#users-table').DataTable().ajax.reload();
        // }, 10000);

        $('#filter-users-form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            $('#agent-table').DataTable().ajax.reload();
        });


        $('#page').change(function (event) {
            event.preventDefault();
            $('#agent-table').DataTable().page.len($(this).val()).draw();
        });

    });

    function openAddModal(id) {
        if(id){
            $.ajax({
                url: "settings/edit/" + id,
                type: 'GET',
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {

                    $('.addModals').html(result);
                    $('#editModalData').modal('show');
                }
            });
        }else {
            $.ajax({
                url: "{!! route('settings.add') !!}",
                type: 'GET',
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    $('.addModals').html(result);
                    $('#addModalData').modal('show');
                },
                complete: function (xhr) {
                    /*alert(xhr.status);*/
                    if (xhr.status == 401) {
                        window.location = URL + "logout.php";
                    }
                }
            });
        }
    }

    //remove modal
    function remove(id) {
        swal({
            title: "Are you sure you want to delete?",
            text: "",
            icon: "error",
            buttons: true,
            dangerMode: true,
            buttons: ["Cancel","Confirm"],
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '{!! route('settings.delete')  !!}',
                        type: 'POST',
                        data:  JSON.stringify({id: id}),
                        contentType: "application/json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            if (result.type === 'SUCCESS') {
                                toastr.success(result.message);
                                $('#agent-table').DataTable().ajax.reload(null, false);
                            }
                        }
                    });
                }
            });
    }

    function resetPassword(id) {
        swal({
            title: "Are you sure you want to reset password?",
            text: "",
            icon: "error",
            buttons: true,
            dangerMode: true,
            buttons: ["Cancel","Confirm"],
        })
            .then((willReset) => {
                if (willReset) {
                    $.ajax({
                        url: "settings/reset/" + id,
                        type: 'POST',
                        data:  JSON.stringify({id: id}),
                        contentType: "application/json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            if (result.type === 'SUCCESS') {
                                toastr.success(result.message);
                                $('#agent-table').DataTable().ajax.reload(null, false);
                            }
                        }
                    });
                }
            });
    }

    //Change Status
    function statusChange(id,status) {
        $.ajax({
            url: "settings/status/" + id,
            type: 'POST',
            data:  JSON.stringify({status: status}),
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                if (result.type === 'SUCCESS') {
                    toastr.success(result.message);
                    $('#agent-table').DataTable().ajax.reload(null, false);
                }
            },
            error: function (data, textStatus, errorThrown,xhr) {
                if(data.status === 419){
                    location.reload();
                }
            },
        });
    }

</script>
