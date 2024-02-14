<script>

    $(function () {
        var
            filters = {
            },
            columns = [
                {data: 'fx_currency', orderable: true},
                {data: 'fx_value', orderable: true},
                {data: 'fx_rate', orderable: true},
                {data: 'expiry_date', orderable: true},
            ],
            columnDefs = [
                {
                    "targets": [3],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return moment(full.expiry_date).format('DD-MM-YYYY');
                    }
                },
            ],
            dataTable = callDataTable('rate-blocked-table', '{!! route('rate-block.list') !!}', filters, columns, '', '', columnDefs);

        // setInterval(function () {
        //     $('#users-table').DataTable().ajax.reload();
        // }, 10000);

        $('#filter-users-form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            $('#transaction-status-table').DataTable().ajax.reload();
        });


        $('#page').change(function (event) {
            event.preventDefault();
            $('#transaction-status-table').DataTable().page.len($(this).val()).draw();
        });

    });

    //remove modal
    function removeTransaction(id) {
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
                        url: '{!! route('transactionStatus.delete')  !!}',
                        type: 'POST',
                        data:  JSON.stringify({id: id}),
                        contentType: "application/json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            if (result.type === 'SUCCESS') {
                                toastr.success(result.message);
                                $('#transaction-status-table').DataTable().ajax.reload(null, false);
                            }
                        }
                    });
                }
            });
    }

    //Change Active Inactive
    function isActiveNotChange(id,isActive) {
        $.ajax({
            url: "transaction/changeActDeAct/" + id,
            type: 'POST',
            data:  JSON.stringify({is_active: isActive}),
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                if (result.type === 'SUCCESS') {
                    toastr.success(result.message);
                    $('#transaction-status-table').DataTable().ajax.reload(null, false);
                }
            }
        });
    }

    function selectDealRate(currencyType){
        $.ajax({
            url: "{!! route('deal-rate.edit') !!}",
            type: 'POST',
            data:JSON.stringify({currencyType:currencyType}),
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                $('.addModals').html(result);
                $('#create-dealrate-model').modal('show');
            }
        });
    }

</script>
