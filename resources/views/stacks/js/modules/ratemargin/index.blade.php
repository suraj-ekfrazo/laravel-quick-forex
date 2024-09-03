<script>

$(function () {
    var
        filters = {
        },
        columns = [
            {data: 'currency_name', orderable: true},
            {data: 'xe_rate', orderable: false},
            {data: 'sell_margin_10_12', orderable: false},
            {data: 'sell_margin_12_2', orderable: false},
            {data: 'sell_margin_2_3_30', orderable: false},
            {data: 'sell_margin_3_30_end', orderable: false},
            {data: 'holiday_margin', orderable: false},
            {data: 'datetime', orderable: false},
            {data: 'id', orderable: false}
        ],
        columnDefs = [
            {
                "targets": [8],
                className: 'r-col-action',
                render: function (data, type, full, meta) {
                    var id = full.id;
                    // return `
                    //     <div class="btn-group action-btn-grp">
                    //         <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    //             <i class="fa fa-ellipsis-v"></i>
                    //         </button>
                    //         <div class="dropdown-menu">
                    //             <div class="action-btn-wrap">
                    //                 <button class="action-btn edit-btn" onclick="openRateMarginModal(${id})" title="Edit">
                    //                     <i class="fa-solid fa-pen-to-square"></i> Edit
                    //                 </button>
                    //                 <button class="action-btn delete-btn" onclick="removeRateMargin(${full.id})" title="Delete">
                    //                     <i class="fa-solid fa-trash"></i> Delete
                    //                 </button>
                    //             </div>
                    //         </div>
                    //     </div>
                    // `;

                    return `
                        <div class="btn-group action-btn-grp">
                            <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <div class="action-btn-wrap">
                                    <button class="action-btn edit-btn" onclick="openRateMarginModal(${id})" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                }
            }
        ],
        dataTable = callDataTable('manage-ratemargin-table', '{!! route('ratemargin.data') !!}', filters, columns, '', '', columnDefs);
});

function openRateMarginModal(id) {
    if(id){
        $.ajax({
            url: "ratemargin/edit/" + id,
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
            url: "{!! route('ratemargin.add') !!}",
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

//removeRateMargin modal
function removeRateMargin(id) {
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
                url: '{!! route('ratemargin.delete')  !!}',
                type: 'POST',
                data:  JSON.stringify({id: id}),
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if (result.type === 'SUCCESS') {
                        toastr.success(result.message);
                        $('#manage-ratemargin-table').DataTable().ajax.reload(null, false);
                    }
                }
            });
        }
    });
}

</script>
