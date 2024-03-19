<script>
    $(function () {
        var
            filters = {
            },
            columns = [
				{data: 'txn_number', orderable: false},
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
                    "targets": [5],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        return '<button class="btn-danger new_btn_upload btn-sm rounded-4 btn-block  border-0" onclick="uploadPayment(' + full.id + ')"> <img src="./assets/img/dashboard/icon_upload.png" alt="upload"> Upload </button>';
                    }
                },
                {
                    "targets": [6],
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
                        var id = full.id;

                        if(full.payment_status == 1){
                            return '<div class="text-white comn-status-btn new_payment_status status-success">Completed</span></div>';
                        }else if(full.payment_status == 2){
                            return '<div class="text-white comn-status-btn new_payment_status status-danger">Rejected</span></div>';
                        }else{
                            return '<div class="text-white comn-status-btn new_payment_status status-secondary">Pending</span></div>';
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
                    className: 'r-col-action',
                    render: function (data, type, full, meta) {
						var upload_btn="";
                        return '<div class="d-flex gap-2">'+
                            '<button class="new_btn_view btn-sm rounded-4 btn-block  border-0" onclick="transactionDetail(' + full.id + ')"">  View </button>'+
                            '</div>';
                    }
                }
            ],
            dataTable = callDataTable('agent-payment-table', '{!! route('agent-payment.data') !!}', filters, columns, '', '', columnDefs);

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

    function uploadPayment(id){
        $.ajax({
            url: "transaction/payment/editPayment/" + id,
            type: 'GET',
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                console.log(result);
                $('.addModals').html(result);
                $('#upload-kyc-model').modal('show');
            }
        });
    }
</script>
