<script>
    $(function () {
        var
            filters = {
            },
            columns = [
				{data: 'txn_number', orderable: false},
                {data: 'customer_name', orderable: false},
                {data: 'txn_frgn_curr_amount', orderable: false},
                {data: 'txn_type', orderable: false},
                {data: 'pancard_no', orderable: false},
                {data: 'id', orderable: false},
                {data: 'id', orderable: false},
                {data: 'id', orderable: false},
                {data: 'id', orderable: false},
                {data: 'id', orderable: false},
            ],
            columnDefs = [
                {
                    "targets": [2],
                    className: 'r-col-action',
					render: function (data, type, full, meta) {
                        var fx_values = "";
                        
                        if (full.txn_currency != null) {
                            $.each(full.txn_currency, function (key, value) {
                                var fx_values_str = value.txn_currency_type + " " +value.txn_frgn_curr_amount + " ";    
                                fx_values += fx_values_str;
                            });

                            return fx_values;
                        }else{
                            return '';
                        }
                    }
                },
                {
                    "targets": [3],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return full.txn_type=='1' ? 'Remittance': 'Card';
                    }
                },
                {
                    "targets": [5],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;

                        if(full.kyc_status == 1){
                            return '<div class="text-white comn-status-btn status-success p-1 rounded-4 text-center">Approved</span></div>';
                        }else if(full.kyc_status == 2){
                            return '<div class="text-white comn-status-btn status-danger p-1 rounded-4 text-center">Rejected</span></div>';
                        }else{
                            return '<div class="text-white comn-status-btn status-secondary p-1 rounded-4 text-center">Pending</span></div>';
                        }
                    }
                },
                {
                    "targets": [6],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return '<button class="new_btn_view btn-sm rounded-4 btn-block border-0" onclick="uploadPayment(' + full.id + ')"> View </button>';
                    }
                },
                {
                    "targets": [7],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;

                        if(full.payment_status == 1){
                            return '<div class="text-white comn-status-btn status-success p-1 rounded-4 text-center">Completed</span></div>';
                        }else if(full.payment_status == 2){
                            return '<div class="text-white comn-status-btn status-danger p-1 rounded-4 text-center">Rejected</span></div>';
                        }else{
                            return '<div class="text-white comn-status-btn status-secondary p-1 rounded-4 text-center">Pending</span></div>';
                        }
                    }
                },
                {
                    "targets": [8],
                    render: function (data, type, full, meta) {
                        return full.created_at === null ? "": moment(full.created_at).format('DD-MM-YYYY');
                    }
                },
                {
                    "targets": [9],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
						var upload_btn="";
                        return '<div class="d-flex gap-2">'+
                            '<button class="new_btn_view btn-sm rounded-4 btn-block border-0" onclick="transactionDetail(' + full.id + ')""> View </button>'+
                            '</div>';
                    }
                }
            ],
            dataTable = callDataTable('admin-payment-table', '{!! route('admin-payment.data') !!}', filters, columns, '', '', columnDefs);

        $('#filter-users-form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            $('#admin-payment-table').DataTable().ajax.reload();
        });


        $('#page').change(function (event) {
            event.preventDefault();
            $('#admin-payment-table').DataTable().page.len($(this).val()).draw();
        });

    });

    function uploadPayment(id){
        $.ajax({
            url: "payment/editPayment/" + id,
            type: 'GET',
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                console.log(result);
                $('.addModals').html(result);
                $('#update-payment-model').modal('show');
            }
        });
    }

    function transactionDetail(id){
        $.ajax({
            url: "payment/get-transaction-detail/" + id,
            type: 'GET',
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                //console.log(result);
                $('.addModals').html(result);
                $('#transactionModal').modal('show');
            }
        });
    }
</script>
