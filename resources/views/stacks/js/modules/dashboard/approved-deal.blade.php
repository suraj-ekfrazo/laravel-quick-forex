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
                            'DD-MM-YYYY h:mm:ss A');
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
</script>
