<script>

$(function () {
    var
        filters = {
        },
        columns = [
            {data: 'purpose_name', orderable: true},
            {data: 'purpose_code', orderable: true},
            {data: 'status', orderable: false},
            {data: 'id', orderable: false}
        ],
        columnDefs = [{
            "targets": [0],
            render: function (data, type, full, meta) {
                return full.purpose_name;
            }
        },
            {
                "targets": [2],
                className: 'r-col-action',
                render: function (data, type, full, meta) {
                    var id = full.id;
                    var status = full.status ? 'checked':'';

                    return '<div class="d-flex gap-3 justify-content">' +
                                '<label class="switch">\n' +
                                    '<input type="checkbox" class="switch-input" ' + status +' onclick="statusChangePurpose(' + id + ','+ full.status +')">' +
                                    '                                <!--<i class="icon-play"></i>-->\n' +
                                    '<span class="switch-label" data-on="Active" data-off="Deactive"></span>\n' +
                                    '<span class="switch-handle"></span>\n' +
                                '</label>'+
                            '</div>';
                }
            },
            {
                "targets": [3],
                className: 'r-col-action',
                render: function (data, type, full, meta) {
                    var id = full.id;
                    // return '<div class="d-flex gap-3 justify-content">' +
                    //             '<button class="text-white bg-success border-0 p-1 rounded-4" onclick="openManagePurposeModal(' + id + ')" title="Edit"> <i class="fa-solid fa-pen-to-square"></i> Edit </button>' +
                    //             '<button class="text-white bg-danger border-0 p-1 rounded-4" onclick="removePurpose(' + full.id + ')" title="Delete"> <i class="fa-solid fa-trash"></i> Delete</button>' +
                    //         '</div>';
                    return `
                    <div class="btn-group action-btn-grp">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu">
                          <div class="action-btn-wrap">
                          <button class="action-btn edit-btn" onclick="openManagePurposeModal(${id})" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i> Edit</button>
                            <button class="action-btn delete-btn" onclick="removePurpose(${full.id})" title="Delete">
                            <i class="fa-solid fa-trash"></i> Delete</button>
                          </div>
                        </div>
                    </div>
                    `
                }
            }
        ],
        dataTable = callDataTable('manage-purpose-table', '{!! route('purpose.data') !!}', filters, columns, '', '', columnDefs);
});

function openManagePurposeModal(id) {
    if(id){
        $.ajax({
            url: "purpose/edit/" + id,
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
            url: "{!! route('purpose.add') !!}",
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

function viewManagePurposeModal(id) {
    $.ajax({
        url: "purpose/view/" + id,
        type: 'GET',
        contentType: "application/json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {

            $('.addModals').html(result);
            $('#ViewModalData').modal('show');
        }
    });
}

//removePurpose modal
function removePurpose(id) {
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
                    url: '{!! route('purpose.delete')  !!}',
                    type: 'POST',
                    data:  JSON.stringify({id: id}),
                    contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        if (result.type === 'SUCCESS') {
                            toastr.success(result.message);
                            $('#manage-purpose-table').DataTable().ajax.reload(null, false);
                        }
                    }
                });
            }
        });
}

//Change Status
function statusChangePurpose(id,status) {
    $.ajax({
        url: "purpose/status/" + id,
        type: 'POST',
        data:  JSON.stringify({status: status}),
        contentType: "application/json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            if (result.type === 'SUCCESS') {
                toastr.success(result.message);
                $('#manage-purpose-table').DataTable().ajax.reload(null, false);
            }
        }
    });
}

</script>
