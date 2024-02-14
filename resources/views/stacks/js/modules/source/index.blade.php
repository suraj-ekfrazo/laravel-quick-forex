<script>

$(function () {
    var
        filters = {
        },
        columns = [
            {data: 'source_name', orderable: true},
            {data: 'tcs_rate', orderable: true},
            {data: 'exempt', orderable: false},
            {data: 'id', orderable: false},
            {data: 'status', orderable: false}
        ],
        columnDefs = [
            {
                "targets": [1],
                render: function (data, type, full, meta) {
                    return full.tcs_rate+"%";
                }
            },
            {
                "targets": [2],
                className: 'dt-body-right',
                render: function (data, type, full, meta) {
                    return "&#8377;"+full.exempt;
                }
            },
            {
                "targets": [3],
                className: 'r-col-action',
                render: function (data, type, full, meta) {
                    var id = full.id;
                    var status = full.status ? 'checked':'';

                    return '<div class="d-flex gap-3 justify-content">' +
                        '<label class="switch">\n' +
                        '<input type="checkbox" class="switch-input" ' + status +' onclick="statusChangeSource(' + id + ','+ full.status +')">' +
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

                    return `
                    <div class="btn-group action-btn-grp">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu">
                          <div class="action-btn-wrap">
                          <button class="action-btn edit-btn" onclick="openManageSourceModal(${id})" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i> Edit</button>
                            <button class="action-btn delete-btn" onclick="removeSource(${full.id})" title="Delete">
                            <i class="fa-solid fa-trash"></i> Delete</button>
                          </div>
                        </div>
                    </div>
                    `;
                }
            }
        ],
        dataTable = callDataTable('manage-sources-table', '{!! route('source.data') !!}', filters, columns, '', '', columnDefs);
});

function openManageSourceModal(id) {
    if(id){
        $.ajax({
            url: "source/edit/" + id,
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
            url: "{!! route('source.add') !!}",
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

function viewManageSourceModal(id) {
    $.ajax({
        url: "source/view/" + id,
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

//removeSource modal
function removeSource(id) {
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
                    url: '{!! route('source.delete')  !!}',
                    type: 'POST',
                    data:  JSON.stringify({id: id}),
                    contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        if (result.type === 'SUCCESS') {
                            toastr.success(result.message);
                            $('#manage-sources-table').DataTable().ajax.reload(null, false);
                        }
                    }
                });
            }
        });
}

//Change Status
function statusChangeSource(id,status) {
    $.ajax({
        url: "source/status/" + id,
        type: 'POST',
        data:  JSON.stringify({status: status}),
        contentType: "application/json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            if (result.type === 'SUCCESS') {
                toastr.success(result.message);
                $('#manage-sources-table').DataTable().ajax.reload(null, false);
            }
        }
    });
}

</script>
