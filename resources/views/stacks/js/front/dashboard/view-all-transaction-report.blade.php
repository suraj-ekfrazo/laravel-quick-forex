<script>

    $(function () {
        var
            filters = {
            },
           columns = [
                {data: 'txn_number', orderable: true},
                {data: 'customer_name', orderable: false},
                {data: 'txn_frgn_curr_amount', orderable: false},
                {data: 'txn_type', orderable: false},
                {data: 'pancard_no', orderable: false},
                {data: 'id', orderable: false},
                {data: 'id', orderable: false},
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
                            return '<div class="text-white comn-status-btn status-success p-1 rounded-4 text-center">Completed</span></div>';
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
                    "targets": [7],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;

                        if (full.kyc_status == 1 && full.payment_status == 1 && full.swift_upload_document != null) {
                            if(full.transaction_status == 1){
                                return '<div class="text-white comn-status-btn status-success p-1 rounded-4 text-center">Completed</span></div>';
                            }else if(full.transaction_status == 2){
                                return '<div class="text-white comn-status-btn status-danger p-1 rounded-4 text-center">Rejected</span></div>';
                            }else{
                                return '<div class="text-white comn-status-btn status-secondary p-1 rounded-4 text-center">Pending</span></div>';
                            }
                        }else{
                            return '<div class="text-white comn-status-btn status-secondary p-1 rounded-4 text-center">Pending</span></div>';
                        }
                    }
                },
				{
                    "targets": [8],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.razorpay_paymentid;
						if(id != null){
							return 'Razor Pay';
						}else{
							return 'Self';
						}
                    }
                },
                {
                    "targets": [9],
                    render: function (data, type, full, meta) {
                        if (full.lrs_sheet_document != null && full.transaction_status == 1) {
                            return '<div class="d-flex gap-2">'+
                                    '<button class="new_btn_upload" onclick="transactionLRSDownload(' + full.id + ')"> <img src="{{asset('assets/img/dashboard/icon_download.png')}}" alt="Download"> Download</button>' +
                                '</div>';
                        }else{
                            return '';
                        }
                    }
                },
                {
                    "targets": [10],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
						if(full.swift_upload_document != null && full.transaction_status == 1){
                            return '<button class="new_btn_upload" onclick="swiftDownload(' + full.id + ')"> <img src={{asset('assets/img/dashboard/icon_download.png')}} alt="Download">  Download</button>';
                        }else{
                            return '<div class="text-white comn-status-btn status-secondary p-1 rounded-4 text-center">Pending</span></div>';
                        }
                    } 
                },
                {
                    "targets": [11],
                    render: function (data, type, full, meta) {
                        return full.expired_date === null ? "": moment(full.expired_date).format('DD-MM-YYYY');
                    }
                },
                {
                    "targets": [12],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        return '<div class="d-flex gap-2">'+
                            '<button class="new_btn_view btn-sm rounded-4 btn-block border-0" onclick="transactionDetail(' + full.id + ')"> View</button>' +
                            '</div>';
                    }
                },
            ],
            dataTable = callDataTable('agent-view-all-transaction-report-table', '{!! route('agent-transaction.viewAllTransactionData') !!}', filters, columns, '', '', columnDefs);


        $('#view_all_transaction_filter_form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            filters['datefilter'] =  $('input[name=dateRangefilter]').val();
            filters['panCardNo'] =  $('input[name=pan_card_no]').val();
            filters['customerName'] =  $('select[name=customer_name] option:selected').val();
            $('#agent-view-all-transaction-report-table').DataTable().ajax.reload();
        });

        $('#page').change(function (event) {
            event.preventDefault();
            $('#agent-view-all-transaction-report-table').DataTable().page.len($(this).val()).draw();
        });

    });

    function transactionLRSDownload(id) {
        var data = {};
        data['id'] = id;
        $.ajax({
            url: "{!! route('getCustomerLrs.data') !!}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                // console.log(result);
                window.location.href = result.data.path;
            }
        });
    }

    function swiftDownload(id) {
        var data = {};
        data['id'] = id;
        $.ajax({
            url: "{!! route('getCustomerSwift.data') !!}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                // console.log(result);
                window.location.href = result.data.path;
            }
        });
    }

    function transactionDetail(id){
        $.ajax({
            url: "/transaction/get-transaction-detail/" + id,
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
