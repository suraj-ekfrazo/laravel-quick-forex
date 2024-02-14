<script>
    $(function () {
        var
            filters = {
            },
            columns = [
				{data: 'reference_number', orderable: false},
                {data: 'branch_id', orderable: false},
                {data: 'fx_currency', orderable: false},
                {data: 'fx_value', orderable: false},
                {data: 'fx_rate', orderable: false},
                {data: 'deal_id', orderable: false},
                {data: 'id', orderable: false},

            ],
            columnDefs = [
				{
                    "targets": [0],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return full.reference_number ? '#'+full.reference_number : '';
                    }
                },
                {
                    "targets": [1],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return full.branch_id ? full.get_agent['branch_name'] : '';
                    }
                },
				{
                    "targets": [4],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return full.get_purpose ?  full.get_purpose['purpose_name'] : "";
                    }
                },
				{
                    "targets": [5],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        if(full.transaction_type=='1'){
                            return "Remittance";
                        }
                        else if(full.transaction_type=='2'){
                            return "Card";
                        }
                        else if(full.transaction_type=='3'){
                            return "Currency";
                        }
                        else{
                            return "";
                        }
                        return full.transaction_type ?  full.get_purpose['purpose_name'] : "";
                    }
                },
                {
                    "targets": [6],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var deal_rate = full.deal_rate === null ? '': full.deal_rate;
                        return '<input type="number" step="0.01" id="deal_rate" name="deal_rate" class="form-control-sm border p-0 trackDealRateBooking rounded-pill" value = ' + deal_rate + '>';
                    }
                },
                {
                    "targets": [7],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var deal_id = full.deal_id === null ? '': full.deal_id;
                        return '<input type="text" id="deal_id" name="deal_id" class="form-control-sm border p-0 trackDealIdBooking rounded-pill" value = ' + deal_id + '>';
                    }
                },

                {
                    "targets": [8],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return moment(full.created_at).format('DD-MM-YYYY H:mm:ss');
                        return full.created_at;
                    }
                },
                {
                    "targets": [9],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return '<button class="btn-secondary btn-sm rounded-4 btn-block border-0 btn-confirm">Confirm</button>';
                    }
                }
            ],
            dataTable = callDataTable('ratebooking', '{!! route('rate-booking.data') !!}', filters, columns, '', '', columnDefs);

        $('#filter-users-form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            $('#ratebooking').DataTable().ajax.reload();
        });


        $('#page').change(function (event) {
            event.preventDefault();
            $('#ratebooking').DataTable().page.len($(this).val()).draw();
        });

        $("#ratebooking tbody").on("click", ".btn-confirm", function () {
            var $row = $(this).parents("tr");
            var rowData = dataTable.row($row).data();
            console.log(rowData);

            if(rowData.deal_id === null || rowData.deal_rate === null || rowData.deal_id === '' || rowData.deal_rate === ''){
                toastr.error("please enter deal value");
                return
            }else if(rowData.deal_id !== '' || rowData.deal_rate !== '' || rowData.deal_id !== null || rowData.deal_rate !== null){
                $.ajax({
                    url: "dashboard/rateblocked/update/" + rowData.id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: JSON.stringify({deal_id:rowData.deal_id,fx_rate:rowData.deal_rate}),
                    contentType: "application/json",
                    success: function (result) {
                        console.log(result);
                        if (result.type === 'SUCCESS') {
                            toastr.success(result.message);
                            $('#ratebooking').DataTable().ajax.reload(null, false);
                        } else {
                            toastr.error(result.message);
                        }
                    }
                });
            }
        });

        $(document).on('input','.trackDealRateBooking',function () {
            var $row = $(this).parents("tr");
            var rowData = dataTable.row($row).data();
            rowData.deal_rate = $(this).val().trim();
        });

        $(document).on('input','.trackDealIdBooking',function () {
            var $row = $(this).parents("tr");
            var rowData = dataTable.row($row).data();
            rowData.deal_id = $(this).val();
        });

    });

    setInterval(function () {
        $('.sorting_desc').removeClass('sorting_desc');
    }, 1000);
</script>
