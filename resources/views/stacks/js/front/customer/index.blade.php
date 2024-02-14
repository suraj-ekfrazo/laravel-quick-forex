<script>

    function openCustomerModel() {
        $.ajax({
            url: "{!! route('agent-customer.add') !!}",
            type: 'GET',
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                $('.addModals').html(result);
                $('#create-customer-model').modal('show');
            }
        });
    }

    function openRateBlockModel() {
        $.ajax({
            url: "{!! route('rate-block.add') !!}",
            type: 'GET',
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                $('.addModals').html(result);
                $('#create-ratebooking-model').modal('show');
            }
        });
    }

    $('#single-select-field').on('select2:select', function (e) {
        var data = e.params.data;
        var custname = $(this).find(':selected').attr('data-custname');
        $("#customer_name").val(custname);
    })

</script>
