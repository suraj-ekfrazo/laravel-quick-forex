<script>

$(function () {
    var
        filters = {
        },
        columns = [
            {data: 'name', orderable: true},
            {data: 'email', orderable: true},
            {data: 'user_name', orderable: true},
            {data: 'mobile_no', orderable: true},
            /*{data: 'status', orderable: false},*/
            {data: 'id', orderable: false},
            {data: 'id', orderable: false}
        ],
        columnDefs = [
            {
                "targets": [4],
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
                "targets": [5],
                className: 'r-col-action',
                render: function (data, type, full, meta) {
                    var id = full.id;

                    // return '<div class="d-flex gap-3 justify-content">' +
                    //     '<button class="text-white bg-success border-0 p-1 rounded-4" onclick="openCustomersModal(' + id + ')" title="Edit"> <i class="fa-solid fa-pen-to-square"></i> Edit</button>' +
                    //     '<button class="text-white bg-danger border-0 p-1 rounded-4" onclick="removeAdminUser(' + full.id + ')" title="Delete"><i class="fa-solid fa-trash"></i> Delete</button>' +
                    //     '</div>';
                    return `
                    <div class="btn-group action-btn-grp">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu">
                          <div class="action-btn-wrap">
                          <button class="action-btn edit-btn" onclick="openCustomersModal(${id})" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i> Edit</button>
                            <button class="action-btn delete-btn" onclick="removeAdminUser(${full.id})" title="Delete">
                            <i class="fa-solid fa-trash"></i> Delete</button>
                          </div>
                        </div>
                    </div>
                    `
                }
            }
        ],
        dataTable = callDataTable('admin-users-table', '{!! route('admin-user.data') !!}', filters, columns, '', '', columnDefs);
});

function openCustomersModal(id) {
    if(id){
        $.ajax({
            url: "admin/edit/" + id,
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
            url: "{!! route('admin-user.add') !!}",
            type: 'GET',
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                $('.addModals').html(result);
                $('#addModalData').modal('show');
            }
        });
    }
}

//removeAdminUser modal
function removeAdminUser(id) {
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
                    url: '{!! route('admin-user.delete')  !!}',
                    type: 'POST',
                    data:  JSON.stringify({id: id}),
                    contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        if (result.type === 'SUCCESS') {
                            toastr.success(result.message);
                            $('#admin-users-table').DataTable().ajax.reload(null, false);
                        }
                    }
                });
            }
        });
}

//Change Status
function statusChange(id,status) {
    $.ajax({
        url: "admin/status/" + id,
        type: 'POST',
        data:  JSON.stringify({status: status}),
        contentType: "application/json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            if (result.type === 'SUCCESS') {
                toastr.success(result.message);
                $('#admin-users-table').DataTable().ajax.reload(null, false);
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
