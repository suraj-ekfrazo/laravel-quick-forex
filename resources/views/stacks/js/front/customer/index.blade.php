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

    $("#customer_mobile").keyup(function() {
        var mobileNo = $(this).val();
        $("#optionList").html("");
        $("#customer_name").val('');
        $("#customer_id").val('');
        $('#customer_name').prop('readonly', false);
        if (mobileNo == "") {
           $("#optionList").html("");
        }else {
            if (mobileNo.length > 3) {
                $.ajax({
                    url: "{!! route('customers.getMatch') !!}",
                    type: 'GET',
                    contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { mobileNo: mobileNo },
                    success: function(result) {
                        // console.log(result.data);
                        $("#optionList").html("");
                        var data = [result.data];
                        $.each(result.data, function (key, value) {
                            $("#optionList").append("<li value='" + value.id + "' data-custname='" + value.name + "' data-mobileNo = '" + value.mobile + "'>" + value.mobile + "</li>");
                        });
                    }
                });
            }else{
                $('#customer_name').prop('readonly', false);
            }
        }
    });

    $("#pancard_no").change(function() {
        var inputvalues = $(this).val();      
        $(".invalid-feedback.ajax-error.pancard_no").html('');
        var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;    
        if(!regex.test(inputvalues) && inputvalues.length > 0){       
            $(".invalid-feedback.ajax-error.pancard_no").html('<strong>Please Enter valid Pan Card No.</strong>');
            return regex.test(inputvalues);    
        }
    });

    $(document).on('click', '#optionList li', function(e){
        var customer_name = $(this).attr('data-custname');
        var customer_mobile = $(this).attr('data-mobileNo');
        $("#customer_name").val(customer_name);
        $("#customer_mobile").val(customer_mobile);
        $("#customer_id").val($(this).val());
        $('#customer_name').prop('readonly', true);
        $("#optionList").html("");
    });

</script>
