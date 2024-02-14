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

                    return '<div class="d-flex gap-3 justify-content">' +
                        '<button class="text-white bg-success border-0 p-1 rounded-4" onclick="openManageSourceModal(' + id + ')" title="Edit"> <i class="fa-solid fa-pen-to-square"></i> </button>' +
                        '                                <button class="text-white bg-danger border-0 p-1 rounded-4" onclick="removeSource(' + full.id + ')" title="Delete"> <i class="fa-solid fa-trash"></i> </button>' +
                        '                              </div>';
                }
            }
        ],
        dataTable = callDataTable('manage-sources-table', '{!! route('sources.data') !!}', filters, columns, '', '', columnDefs);
});

function openManageSourceModal(id) {
    if(id){
        $.ajax({
            url: "settings/sources/edit/" + id,
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
            url: "{!! route('sources.add') !!}",
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
        url: "settings/sources/view/" + id,
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
                    url: '{!! route('sources.delete')  !!}',
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
        url: "settings/sources/status/" + id,
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
