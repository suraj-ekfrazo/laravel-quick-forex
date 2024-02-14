<script>

$(function () {
    var
        filters = {
        },
        columns = [
            {data: 'name', orderable: true},
            {data: 'mobile', orderable: true},
            /*{data: 'status', orderable: false},*/
            {data: 'id', orderable: false}
        ],
        columnDefs = [
            /*{
                "targets": [2],
                className: 'r-col-action',
                render: function (data, type, full, meta) {
                    var id = full.id;
                    var status = full.status ? 'checked':'';

                    return '<div class="d-flex gap-3 justify-content">' +
                        '<div class="form-check form-switch ml-3">' +
                        '  <input class="form-check-input" type="checkbox" '+status+' onclick="statusChangeSource(' + id + ','+ full.status +')">' +
                        '  <label class="form-check-label" for="flexSwitchCheckDefault"></label>'+
                        '</div>'+
                        '</div>';
                }
            },*/
            {
                "targets": [2],
                className: 'r-col-action',
                render: function (data, type, full, meta) {
                    var id = full.id;

                    return '<div class="d-flex gap-3 justify-content">' +
                        '<button class="text-white bg-success border-0 p-1 rounded-4" onclick="openCustomersModal(' + id + ')" title="Edit"> <i class="fa-solid fa-pen-to-square"></i> </button>' +
                        '<button class="text-white bg-danger border-0 p-1 rounded-4" onclick="removeCustomer(' + full.id + ')" title="Delete"><i class="fa-solid fa-trash"></i></button>' +
                        '</div>';
                }
            }
        ],
        dataTable = callDataTable('manage-customers-table', '{!! route('customers.data') !!}', filters, columns, '', '', columnDefs);
});

function openCustomersModal(id) {
    if(id){
        $.ajax({
            url: "settings/customers/edit/" + id,
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
            url: "{!! route('customers.add') !!}",
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

//removeCustomer modal
function removeCustomer(id) {
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
                    url: '{!! route('customers.delete')  !!}',
                    type: 'POST',
                    data:  JSON.stringify({id: id}),
                    contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        if (result.type === 'SUCCESS') {
                            toastr.success(result.message);
                            $('#manage-customers-table').DataTable().ajax.reload(null, false);
                        }
                    }
                });
            }
        });
}

</script>
