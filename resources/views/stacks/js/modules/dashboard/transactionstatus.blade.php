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

                        if(full.kyc_status == 1){
                            return '<div class="text-white comn-status-btn status-success p-1 rounded-4 text-center">Completed</span></div>';
                        }else if(full.kyc_status == 2){
                            return '<div class="text-white comn-status-btn status-danger1 p-1 rounded-4 text-center">Rejected</span></div>';
                        }else{
                            return '<div class="text-white comn-status-btn status-warning p-1 rounded-4 text-center">Pending</span></div>';
                        }
                    }
                },
                {
                    "targets": [5],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;

                        if(full.payment_status == 1){
                            return '<div class="text-white comn-status-btn status-success p-1 rounded-4 text-center">Completed</span></div>';
                        }else if(full.payment_status == 2){
                            return '<div class="text-white comn-status-btn status-danger1 p-1 rounded-4 text-center">Rejected</span></div>';
                        }else{
                            return '<div class="text-white comn-status-btn status-warning p-1 rounded-4 text-center">Pending</span></div>';
                        }
                    }
                },
                {
                    "targets": [6],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;

                        if(full.transaction_status == 1){
                            return '<div class="text-white comn-status-btn status-success p-1 rounded-4 text-center">Completed</span></div>';
                        }else if(full.transaction_status == 2){
                            return '<div class="text-white comn-status-btn status-danger p-1 rounded-4 text-center">Rejected</span></div>';
                        }else{
                            return '<div class="text-white comn-status-btn status-warning p-1 rounded-4 text-center">Pending</span></div>';
                        }
                    }
                }, 
                {
                    "targets": [7],
                    render: function (data, type, full, meta) {
                        return full.created_at === null ? "": moment(full.created_at).format('DD-MM-YYYY');
                    }
                },
                {
                    "targets": [8],
                    render: function (data, type, full, meta) {
                        return full.expired_date === null ? "": moment(full.expired_date).format('DD-MM-YYYY');
                    }
                },
                {
                    "targets": [9],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        return '<div class="d-flex gap-2">'+
                            '<button class="new_btn_view" onclick="transactionDetail(' + full.id + ')"> View</button>' +
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
            $("#admin-transaction-table-count").text($('#admin-transaction-table').DataTable().data().count());
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
                {data: 'id', orderable: false},
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
                    "targets": [0],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return '<input type="checkbox" class="downloadTransaction" name="downloadIdList" data-key="'+full.id+'" value="'+full.txt_number+'">';
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
                            return '<div class="text-white comn-status-btn status-warning p-1 rounded-4 text-center">Pending</span></div>';
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
                            return '<div class="text-white comn-status-btn status-warning p-1 rounded-4 text-center">Pending</span></div>';
                        }
                    }
                },
                {
                    "targets": [7],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;

                        if(full.transaction_status == 1){
                            return '<div class="text-white comn-status-btn status-success p-1 rounded-4 text-center">Completed</span></div>';
                        }else if(full.transaction_status == 2){
                            return '<div class="text-white comn-status-btn status-danger p-1 rounded-4 text-center">Rejected</span></div>';
                        }else{
                            return '<div class="text-white comn-status-btn status-warning p-1 rounded-4 text-center">Pending</span></div>';
                        }
                    }
                },
				 {
                    "targets": [8],
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
                    "targets": [9],
                    render: function (data, type, full, meta) {
                        if (full.lrs_sheet_document) {
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
                    render: function (data, type, full, meta) {
                        return full.created_at === null ? "": moment(full.created_at).format('DD-MM-YYYY'); //DD-MM-YYYY h:mm:ss A
                    }
                },
                {
                    "targets": [11],
                    render: function (data, type, full, meta) {
                        return full.created_at === null ? "": moment(full.created_at).format('h:mm:ss A'); //DD-MM-YYYY h:mm:ss A
                    }
                },
                {
                    "targets": [12],
                    render: function (data, type, full, meta) {
                        return full.expired_date === null ? "": moment(full.expired_date).format('DD-MM-YYYY'); //DD-MM-YYYY h:mm:ss A
                    }
                },
                {
                    "targets": [13],
                    render: function (data, type, full, meta) {
                        return full.updated_at === null ? "": moment(full.updated_at).format('DD-MM-YYYY'); //DD-MM-YYYY h:mm:ss A
                    }
                },
                {
                    "targets": [14],
                    render: function (data, type, full, meta) {
                        return full.updated_at === null ? "": moment(full.updated_at).format('h:mm:ss A'); //DD-MM-YYYY h:mm:ss A
                    }
                },
                {
                    "targets": [15],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        var upload_btn="";
						if(full.transaction_status == 1){
                            upload_btn = '<button class="new_btn_upload" onclick="uploadSWIFT(' + full.id + ')"> <img src={{asset('assets/img/dashboard/icon_upload.png')}} alt="upload">  Upload</button>';
                        }
                        return upload_btn;
                    } 
                },
                {
                    "targets": [16],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        return '<div class="d-flex gap-2">'+
                            '<button class="border-0 text-white bg-secondary p-1 rounded-4 new_btn_view" onclick="transactionDetail(' + full.id + ')">  View</button>' +
								'<button class="new_btn_upload" onclick="transactionDownload(' + full.id + ')"> <img src="{{asset('assets/img/dashboard/icon_download.png')}}" alt="Download"> Download</button>'+
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
            $("#agent-completed-transaction-table-count").text($('#aagent-completed-transaction-table').DataTable().data().count());
        });

        $('#downloadAll').click(function() {
            $('.downloadTransaction').not(this).prop('checked', this.checked);
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

    function transactionLRSDownload(id) {
        var data = {};
        data['id'] = id;
        $.ajax({
            url: "{!! route('getLrs.data') !!}",
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

    function uploadSWIFT(id){
        $.ajax({
            url: "{!! route('editSwiftUpload.data') !!}",
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify({'id': id}),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {

                $('.addModals').html(result);
                $('#upload-swift-model').modal('show');
            }
        });
    }

    setInterval(function () {
        $('.sorting_desc').removeClass('sorting_desc');
    }, 1000);
</script>
