<script>
    $(function () {
        var
            filters = {
            },
            columns = [
                {data: 'txn_number', orderable: true},
                {data: 'customer_name', orderable: false},
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
                        return full.txn_type=='1' ? 'Remittance': 'Card';
                    }
                },
                {
                    "targets": [4],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        var kycStatus = '';
						 var btnClass = '';
						if(full.kyc_status === 0){
							kycStatus = 'Pending';
							btnClass = 'warning';
							
						}else if(full.kyc_status === 1){
							kycStatus = 'Completed';
							btnClass = 'success';
						}else{
							kycStatus = 'Rejected';
							btnClass = 'danger1';
						}
						

                        return '<div class="text-white bg-'+btnClass+' p-1 rounded-4 text-center"> '+ kycStatus +' </div>';
                    }
                },
                {
                    "targets": [5],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        var kycStatus = (full.payment_status === 0) ? 'Pending' : (full.payment_status === 1) ? 'Completed' : 'Rejected';
                        var btnClass = (full.payment_status === 0) ? 'warning' : (full.payment_status === 1) ? 'success' : 'danger1';
                        return '<div class="text-white bg-'+btnClass+' p-1 rounded-4 text-center"> '+ kycStatus +' </div>';
                    }
                },
                {
                    "targets": [6],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        var kycStatus = (full.transaction_status === 0) ? 'Pending' : (full.transaction_status === 1) ? 'Completed' : 'Rejected';
                        var btnClass = (full.transaction_status === 0) ? 'warning' : (full.transaction_status === 1) ? 'success' : 'danger';
                        return '<div class="text-white bg-'+btnClass+' p-1 rounded-4 text-center"> '+ kycStatus +' </div>';
                    }
                },
				
                {
                    "targets": [7],
                    render: function (data, type, full, meta) {
                        return full.expired_date === null ? "": moment(full.expired_date).format('DD-MM-YYYY h:mm:ss A');
                    }
                },
                {
                    "targets": [8],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        return '<div class="d-flex gap-2">'+
                            '<button class="btn-success btn-sm rounded-4 btn-block border-0" onclick="transactionDetail(' + full.id + ')"> View</button>' +
                            '</div>';
                    }
                },
            ],
            dataTable = callDataTable('admin-transaction-table', '{!! route('transactionstatus.data') !!}', filters, columns, '', '', columnDefs);

        $('#filter_form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            filters['agent_id'] =   $('select[name=agent_id] option:selected').val();
            filters['customer_id'] =  $('select[name=customer_id] option:selected').val();
            filters['datefilter']    =  $('input[name=booking_datefilter]').val();
            $('#admin-transaction-table').DataTable().ajax.reload();
        });

        $('#page').change(function (event) {
            event.preventDefault();
            $('#admin-transaction-table').DataTable().page.len($(this).val()).draw();
        });

    });
	
	//For completed transaction tab
    $(function () {
        var
            filters = {
            },
            columns = [
                {data: 'txn_number', orderable: true},
                {data: 'customer_name', orderable: false},
                {data: 'txn_type', orderable: false},
                {data: 'pancard_no', orderable: false},
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
                        return full.txn_type=='1' ? 'Remittance': 'Card';
                    }
                },
                {
                    "targets": [4],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        var kycStatus = (full.kyc_status === 0) ? 'Pending' : (full.kyc_status === 1) ? 'Completed' : 'Rejected';
                        var btnClass = (full.kyc_status === 0) ? 'warning' : (full.kyc_status === 1) ? 'success' : 'danger';
                        return '<div class="text-white bg-'+btnClass+' p-1 rounded-4 text-center"> '+ kycStatus +' </div>';
                    }
                },
                {
                    "targets": [5],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        var kycStatus = (full.payment_status === 0) ? 'Pending' : (full.payment_status === 1) ? 'Completed' : 'Rejected';
                        var btnClass = (full.payment_status === 0) ? 'warning' : (full.payment_status === 1) ? 'success' : 'danger';
                        return '<div class="text-white bg-'+btnClass+' p-1 rounded-4 text-center"> '+ kycStatus +' </div>';
                    }
                },
                {
                    "targets": [6],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        var kycStatus = (full.transaction_status === 0) ? 'Pending' : (full.transaction_status === 1) ? 'Completed' : 'Rejected';
                        var btnClass = (full.transaction_status === 0) ? 'warning' : (full.transaction_status === 1) ? 'success' : 'danger';
                        return '<div class="text-white bg-'+btnClass+' p-1 rounded-4 text-center"> '+ kycStatus +' </div>';
                    }
                },
				 {
                    "targets": [7],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.razorpay_paymentid;
                       if(id != null){
					   return 'RazorPay';
					    }else{
					    return 'Self';
					   }
					}
                },
                {
                    "targets": [8],
                    render: function (data, type, full, meta) {
                        return full.expired_date === null ? "": moment(full.expired_date).format('DD-MM-YYYY h:mm:ss A');
                    }
                },
                {
                    "targets": [9],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        return '<div class="d-flex gap-2">'+
                            '<button class="new_btn_view btn-sm rounded-4 btn-block border-0" onclick="transactionDetail(' + full.id + ')"> <img src="{{asset('assets/img/dashboard/icon_view.png')}}" alt="view"> View</button>' +
								'<button class="new_btn_view btn-sm rounded-4 btn-block border-0" onclick="transactionDownload(' + full.id + ')"> <img src="{{asset('assets/img/dashboard/icon_download.png')}}" alt="Download"> Download</button>' +
                            '</div>';
                    }
                },
            ],
            dataTable = callDataTable('agent-completed-transaction-table', '{!! route('completedTransaction.data') !!}', filters, columns, '', '', columnDefs);

        // setInterval(function () {
        //     $('#users-table').DataTable().ajax.reload();
        // }, 10000);

        $('#complete_filter_form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            filters['agent_id'] =   $('select[name=complete_agent_id] option:selected').val();
            filters['customer_id'] =  $('select[name=complete_customer_id] option:selected').val();
            filters['datefilter']    =  $('input[name=complete_datefilter]').val();
            $('#agent-completed-transaction-table').DataTable().ajax.reload();
        });


        $('#page').change(function (event) {
            event.preventDefault();
            $('#agent-completed-transaction-table').DataTable().page.len($(this).val()).draw();
        });

    });
	
	function transactionDownload(id) {

        var data = {};
        data['id'] = id;
        $.ajax({
            url: "{!! route('singleData.csv') !!}",
                type: 'POST',
                contentType: "application/json",
                data: JSON.stringify(data),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    //console.log(result);
                    window.location.href = result.data.path;
                }
            });
    }

    setInterval(function () {
        $('.sorting_desc').removeClass('sorting_desc');
    }, 1000);
</script>
