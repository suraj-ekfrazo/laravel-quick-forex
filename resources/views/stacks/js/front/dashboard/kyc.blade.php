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
                {data: 'booking_purpose_id', orderable: false},
                {data: 'fund_source_id', orderable: false},
                {data: 'pancard_no', orderable: false},
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
                    "targets": [4],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return full.purpose_data.purpose_name;
                    }
                },
                {
                    "targets": [5],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return full.source_data.source_name;
                    }
                },
                {
                    "targets": [7],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        if(full.kyc_status==1)
                        {
                            return '<div class="d-flex gap-2"><span class="kyc-approved-btn comn-status-btn" >Approved</span></div>';
                        }
                        else if(full.kyc_status==2){
                            return '<div class="d-flex gap-2"><span class="kyc-rejected-btn comn-status-btn" >Rejected</span></div>';
                        }else{
                            return '<div class="d-flex gap-2"><span class="kyc-pending-btn comn-status-btn" >Pending</span></div>';
                        }

                    }
                },
                {
                    "targets": [8],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
						var upload_btn="";
						if(full.kyc_status != 1){ 
                            upload_btn = '<button class="new_btn_upload" onclick="uploadKYC(' + full.id + ')"> <img src="./assets/img/dashboard/icon_upload.png" alt="upload">  Upload</button>';
                        }else{
                            upload_btn = '<button class="new_btn_upload" onclick="uploadKYC(' + full.id + ')"> <img src="./assets/img/dashboard/icon_view.png" alt="upload">  View Docs</button>';
                        }
                        return '<div class="d-flex gap-2">'+
                                '<button class="border-0 text-white bg-secondary p-1 rounded-4 new_btn_view" onclick="transactionDetail(' + full.id + ')"> View</button>'+ upload_btn +
                              '</div>';
                    }
                } 
            ],
            dataTable = callDataTable('transaction-kyc-table', '{!! route('transaction-kyc.data') !!}', filters, columns, '', '', columnDefs);

        $('#filter-users-form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            $('#transaction-kyc-table').DataTable().ajax.reload();
        });


        $('#page').change(function (event) {
            event.preventDefault();
            $('#transaction-kyc-table').DataTable().page.len($(this).val()).draw();
        });

    });

    function uploadKYC(id){
        $.ajax({
            url: "transaction/editKyc/" + id,
            type: 'GET',
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {

                $('.addModals').html(result);
                $('#upload-kyc-model').modal('show');
            }
        });
    }

	function transactionDetail(id){
        $.ajax({
            url: "transaction/get-transaction-detail/" + id,
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
