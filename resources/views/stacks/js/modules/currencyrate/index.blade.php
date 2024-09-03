<script>

$(function () {
    var
        filters = {
        },
        columns = [
            {data: 'currency_name', orderable: true},
            {data: 'status', orderable: false},
            {data: 'cur_id', orderable: false}
        ],
        columnDefs = [
            {
                "targets": [1],
                className: 'r-col-action',
                render: function (data, type, full, meta) {
                    if (full.status == 1) {
                        return 'Active';
                    }else{
                        return 'In-Active';
                    }
                }
            },
            {
                "targets": [2],
                className: 'r-col-action',
                render: function (data, type, full, meta) {
                    var id = full.cur_id;
                    return `
                        <div class="btn-group action-btn-grp">
                            <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <div class="action-btn-wrap">
                                    <button class="action-btn edit-btn" onclick="openCurrencyRateModal(${id})" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>
                                    <button class="action-btn delete-btn" onclick="removeCurrencyRate(${full.cur_id})" title="Delete">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                }
            }
        ],
        dataTable = callDataTable('manage-currencyrate-table', '{!! route('currencyrate.data') !!}', filters, columns, '', '', columnDefs);
});

function openCurrencyRateModal(id) {
    if(id){
        $.ajax({
            url: "currencyrate/edit/" + id,
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
            url: "{!! route('currencyrate.add') !!}",
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

//removeCurrencyRate modal
function removeCurrencyRate(id) {
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
                url: '{!! route('currencyrate.delete')  !!}',
                type: 'POST',
                data:  JSON.stringify({id: id}),
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if (result.type === 'SUCCESS') {
                        toastr.success(result.message);
                        $('#manage-currencyrate-table').DataTable().ajax.reload(null, false);
                    }
                }
            });
        }
    });
}

</script>
