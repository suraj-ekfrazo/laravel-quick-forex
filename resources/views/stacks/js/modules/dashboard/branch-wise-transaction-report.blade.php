<script>

    $(function () {
        var
            filters = {
            },
            columns = [
                {data: 'agent_name', orderable: true},
                {data: 'branch_name', orderable: false},
                {data: 'total', orderable: false},
                {data: 'approved', orderable: false},
                {data: 'kyc_rejected', orderable: false},
                {data: 'payment_rejected', orderable: false},
                {data: 'kyc_pending', orderable: false},
                {data: 'payment_pending', orderable: false},
			    {data: 'swift_pending', orderable: false},
            ],
            columnDefs = [
                
            ],
            dataTable = callDataTable('admin-transaction-branch-user-wise-report', '{!! route('admin-transaction.branchUserwisetabledata') !!}', filters, columns, '', '', columnDefs);

        $('#branchuserwise-report-form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            filters['datefilter'] =  $('input[name=daterange]').val();
            filters['branch_user_id'] =  $('select[name=branch_user_id] option:selected').val();
            $('#admin-transaction-branch-user-wise-report').DataTable().ajax.reload();
        });


        $('#page').change(function (event) {
            event.preventDefault();
            $('#admin-transaction-branch-user-wise-report').DataTable().page.len($(this).val()).draw();
        });

    });

</script>
