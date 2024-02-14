<script>

    $(function () {
        var
            filters = {
            },
            columns = [
                {data: 'branch_name', orderable: true},
                {data: 'email', orderable: true},
                {data: 'mobile', orderable: true},
                {data: 'status', orderable: false},
                {data: 'id', orderable: false},
                {data: 'id', orderable: false},
            ],
            columnDefs = [
                /*{
                "targets": [0],
                render: function (data, type, full, meta) {
                    return full.first_name + ' ' + full.last_name;
                }
                },*/
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

                        // return '<div class="d-flex gap-3 justify-content-center">'+
                        //         '<button class="text-white bg-success border-0 p-1 rounded-4" onclick="openAddModal(' + id + ')" title="Edit"> <i class="fa-solid fa-pen-to-square"></i> Edit</button>'+
                        //         '<button class="text-white bg-danger border-0 p-1 rounded-4" onclick="remove(' + full.id + ')" title="Delete"> <i class="fa-solid fa-trash"></i> Delete</button>'+
                        //         '</div>';

                        return `
                            <div class="btn-group action-btn-grp">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                <div class="action-btn-wrap">
                                <button class="action-btn edit-btn" onclick="openAddModal(${id})" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                    <button class="action-btn delete-btn" onclick="remove(${full.id})" title="Delete">
                                    <i class="fa-solid fa-trash"></i> Delete</button>
                                </div>
                                </div>
                            </div>
                        `;
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
            dataTable = callDataTable('agent-table', '{!! route('branch.data') !!}', filters, columns, '', '', columnDefs);

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
                url: "branch/edit/" + id,
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
                url: "{!! route('branch.add') !!}",
                type: 'GET',
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result,data) {
                    /*console.log("result");
                    console.log(result);
                    console.log("data");
                    console.log(data);*/
                    $('.addModals').html(result);
                    $('#addModalData').modal('show');
                },
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
                        url: '{!! route('branch.delete')  !!}',
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
                        url: "branch/reset/" + id,
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
            url: "branch/status/" + id,
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
    /*$('#agent-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    });*/
    /*$('.buttons-print').addClass('hide');*/

</script>
