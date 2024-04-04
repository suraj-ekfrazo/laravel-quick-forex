<script>
    $(function () {
        var
            filters = {
            },
            columns = [
				{data: 'reference_number', orderable: false},
                {data: 'customer_name', orderable: false},
                {data: 'fx_currency', orderable: false},
                {data: 'fx_value', orderable: false},
                {data: 'purpose_name', orderable: false},
                {data: 'transaction', orderable: false},
                {data: 'fx_rate', orderable: false},
                {data: 'deal_id', orderable: false},
                {data: 'expiry_date', orderable: false},
                {data: 'created_at', orderable: false},
                {data: 'updated_at', orderable: false},
            ],
            columnDefs = [
                {
                    "targets": [4],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return full.get_purpose ? full.get_purpose.purpose_name : 'N/A';
                    }
                },
                {
                    "targets": [0],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return full.reference_number ?? 'N/A';
                    }
                },
                {
                    "targets": [1],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return full.get_agent ? full.get_agent.first_name : 'N/A';
                    }
                },

                {
                    "targets": [5],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return 'Remittance';
                    }
                },
                {
                    "targets": [7],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return full.deal_id ?? 'N/A';
                    }
                },
                {
                    "targets": [8],
                    render: function(data, type, full, meta) {
                        return full.expired_date === null ? "" : moment(full.expired_date).format(
                            'DD-MM-YYYY');
                    }
                },
                {
                    "targets": [9],
                    render: function(data, type, full, meta) {
                        return full.created_at === null ? "" : moment(full.created_at).format(
                            'DD-MM-YYYY h:mm:ss A');
                    }
                },
                {
                    "targets": [10],
                    render: function(data, type, full, meta) {
                        return full.updated_at === null ? "" : moment(full.updated_at).format(
                            'DD-MM-YYYY h:mm:ss A');
                    }
                },
                {
                    "targets": [11],
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
                                <button class="action-btn edit-btn" onclick="openAddModal(${id})" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                    <button class="action-btn delete-btn" onclick="removeDeal(${full.id})" title="Delete">
                                    <i class="fa-solid fa-trash"></i> Delete</button>
                                </div>
                                </div>
                            </div>
                        `;
                    }
                },
            ],
            dataTable = callDataTable('approved-deal-table', '{!! route('approvedDeal.data') !!}', filters, columns, '', '', columnDefs);

        $('#filter-users-form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            $('#approved-deal-table').DataTable().ajax.reload();
        });


        $('#page').change(function (event) {
            event.preventDefault();
            $('#approved-deal-table').DataTable().page.len($(this).val()).draw();
        });

    });

    function openAddModal(id) {
        if(id){
            $.ajax({
                url:  "{!! route('approvedDeal.edit') !!}",
                type: 'POST',
                data : JSON.stringify({id: id}),
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {

                    $('.addModals').html(result);
                    $('#edit-approved-deal-model').modal('show');
                }
            });
        }
    }

    function removeDeal(id) {
        if(id){
            swal({
                title: "Are you sure you want to delete?",
                text: "",
                icon: "error",
                buttons: true,
                dangerMode: true,
                buttons: ["Cancel","Confirm"],
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{!! route('approvedDeal.delete')  !!}",
                        type: 'POST',
                        data:  JSON.stringify({id: id}),
                        contentType: "application/json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            if (result.type === 'SUCCESS') {
                                toastr.success(result.message);
                                $('#approved-deal-table').DataTable().ajax.reload(null, false);
                            }
                        }
                    });
                }
            });
        }
    }
</script>
