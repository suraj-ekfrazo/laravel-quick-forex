<script>
    $(function () {
        var
            filters = {
            },
            columns = [
                {data: 'txn_id', orderable: false},
                {data: 'deal_id', orderable: false},
                {data: 'transaction_data.customer_name', orderable: false},
                {data: 'txn_currency_type', orderable: false},
                {data: 'txn_inr_amount', orderable: false},
                {data: 'deal_rate', orderable: false},
                {data: 'id', orderable: false},
                {data: 'id', orderable: false},
                {data: 'transaction_data.created_at', orderable: false},
                {data: 'id', orderable: false},
                {data: 'id', orderable: false},
            ],
            columnDefs = [
                {
                    "targets": [8],
                    render: function (data, type, full, meta) {
                        return moment(full.transaction_data.created_at).format('DD-MM-YYYY h:mm:ss A');
                    }
                },
                {
                    "targets": [9],
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        var kycStatus = (full.transaction_data.kyc_status === 0) ? 'Pending' : (full.transaction_data.kyc_status === 1) ? 'Completed' : 'Rejected';
                        var btnClass = (full.transaction_data.kyc_status === 0) ? 'secondary' : (full.transaction_data.kyc_status === 1) ? 'success' : 'danger';
                        return '<div class="text-white bg-'+btnClass+' p-1 rounded-4 text-center"> '+ kycStatus +' </div>';
                    }
                },
                {
                    "targets": [10],
                    render: function (data, type, full, meta) {
                        var id = full.id;
                        var paymentStatus = (full.transaction_data.payment_status === 0) ? 'Pending' : (full.transaction_data.payment_status === 1) ? 'Completed' : 'Rejected';
                        var btnClass = (full.transaction_data.payment_status === 0) ? 'secondary' : (full.transaction_data.payment_status === 1) ? 'success' : 'danger';
                        return '<div class="text-white bg-'+btnClass+' p-1 rounded-4 text-center"> '+ paymentStatus +' </div>';
                    }
                },
            ],
            dataTable = callDataTable('rate-blocked-table', '{!! route('rateBlocked.data') !!}', filters, columns, '', '', columnDefs);

        $('#filter-users-form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            $('#rate-blocked-table').DataTable().ajax.reload();
        });


        $('#page').change(function (event) {
            event.preventDefault();
            $('#rate-blocked-table').DataTable().page.len($(this).val()).draw();
        });

    });

    setInterval(function () {
        $('.sorting_desc').removeClass('sorting_desc');
    }, 1000);
</script>
