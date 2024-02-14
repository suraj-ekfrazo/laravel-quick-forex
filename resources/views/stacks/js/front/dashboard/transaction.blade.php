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
							return 'Razor Pay';
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
                            '<button class="new_btn_view btn-sm rounded-4 btn-block border-0" onclick="transactionDetail(' + full.id + ')"> <img src="./assets/img/dashboard/icon_view.png" alt="view"> View</button>' +
                            '</div>';
                    }
                },
            ],
            dataTable = callDataTable('transaction-status-table', '{!! route('transaction-all.data') !!}', filters, columns, '', '', columnDefs);

        // setInterval(function () {
        //     $('#users-table').DataTable().ajax.reload();
        // }, 10000);

        $('#filter-users-form').submit(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            filters['page'] = $('#page').val();
            $('#transaction-status-table').DataTable().ajax.reload();
        });


        $('#page').change(function (event) {
            event.preventDefault();
            $('#transaction-status-table').DataTable().page.len($(this).val()).draw();
        });

    });
	
	

    //remove modal
    function removeTransaction(id) {
        swal({
            title: "Are you sure you want to delete?",
            text: "",
            icon: "error",
            buttons: true,
            dangerMode: true,
            buttons: ["Cancel","Confirm"],
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '{!! route('transactionStatus.delete')  !!}',
                        type: 'POST',
                        data:  JSON.stringify({id: id}),
                        contentType: "application/json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            if (result.type === 'SUCCESS') {
                                toastr.success(result.message);
                                $('#transaction-status-table').DataTable().ajax.reload(null, false);
                            }
                        }
                    });
                }
            });
    }

    //Change Active Inactive
    function isActiveNotChange(id,isActive) {
        $.ajax({
            url: "transaction/changeActDeAct/" + id,
            type: 'POST',
            data:  JSON.stringify({is_active: isActive}),
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                if (result.type === 'SUCCESS') {
                    toastr.success(result.message);
                    $('#transaction-status-table').DataTable().ajax.reload(null, false);
                }
            }
        });
    }

$('.save-incidents-form').submit(function(event) {
        checkValidation();
        var status = document.activeElement.innerHTML;
        event.preventDefault();

        var currentDate = new Date();
        var currentHour = currentDate.getHours();
        var currentMinute = currentDate.getMinutes();
        if (currentHour >= 10 && currentHour < 18) {
            swal({
                title: "Please conform selected beneficiary county",
                text: "",
                icon: "success",
                buttons: true,
                dangerMode: true,
                buttons: ["Cancel", "Confirm"],
            })
            .then((result) => {

                if (result) {
                    if (status) {
                        $('.ajax-error').html('');
                        var data = new FormData(this);


                        $.ajax({
                            url: $(this).attr("action"),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST',
                            data: data,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                //console.log(result);
                                /*$(this).attr("disabled", false);*/
                                if (result.type === 'SUCCESS') {
                                    swal({
                                        title: "Success",
                                        text: result.message,
                                        icon: "success",
                                        button: "okay",
                                    }).then(function() {
                                        location.reload();
                                    });
                                } else {
                                    toastr.error(result.message);
                                }
                            },
                            error: function(error) {
                                $(this).attr("disabled", false);
                                let errors = error.responseJSON.errors,
                                    errorsHtml = '';
                                $.each(errors, function(key, value) {
                                    errorsHtml = '<strong>' + value[0] +
                                        '</strong>';
                                    $('.' + key).html(errorsHtml);
                                });
                            }
                        });
                    }
                }
            });
        } else {
            swal({
                title: "You can rate block between 10.00 AM to 05:00 PM time",
                text: "",
                icon: "error",
                buttons: true,
                dangerMode: true,
                buttons:"OK",
                })
                .then((result) => {});
        }
    });

    function isSpecialKey(evt) {
        var txt = String.fromCharCode(evt.which);
        if (!txt.match(/[A-Za-z0-9&. ]/)) {
            return false;
        }
    }

    function calculateInr(){
        var amount = $("#amount").val();
        var bookingRate = $("#bookingRate").val();
        var currencyType = $("#currencyType").val();
        /*var selectedCurrencyTypeName = $("#selected-currency-type option:selected").html();*/
        var inrAmount = $("#inrAmount").val();
        if ($.isNumeric(amount) && $.isNumeric(bookingRate) && currencyType !== '') {
            validate = true;
            $("#addCurrency").prop('disabled', false);
        } else {
            $("#addCurrency").prop('disabled', true);
        }
    }

    function checkValidation(){
        var amount = $("#amount").val();
        /*var bookingRate = $("#bookingRate").val();*/
        var currencyType = $("#currencyType").val(),fundSourceId = $("#fund_source_id").val();
        var validate = false;
		var currencyLen = $("#selected-currency tbody tr").length;
        /*var inrAmount = $("#inrAmount").val();*/
        if ($.isNumeric(amount) && currencyType !== '' && fundSourceId !=='') {
            validate = true;
            /*$("#addCurrency").prop('disabled', false);*/
            $("#selectDealRateBtn").prop('disabled', false);
            $('#currencyError').html('');
            $('.fund-source-selected').html('');
        } else if(currencyLen === 0) {
            /*$("#addCurrency").prop('disabled', true);*/
            $("#selectDealRateBtn").prop('disabled', true);
            $('#currencyError').html('Add min one currency.');
            $('.fund-source-selected').html('The source field is required.');
        }
        return validate;
    }

    function resetCurrencyRete(){
        $("#amount").val('');
        $("#bookingRate").val('');
        $("#currencyType").val('');
        $("#addCurrency").prop('disabled', true);
        $("#selectDealRateBtn").prop('disabled', true);
    }

    let rowCount = $("#selected-currency tbody tr").length, tcsExempt = 0;

    function amountCalculation(){
        var tcsRate = $("#fund_source_id").find(':selected').attr('tcs-rate'),
            tcsExempt = $("#fund_source_id").find(':selected').attr('tcs-exempt'), remitFees = $("#remit_fees").val(), nostroCharge = $("#nostro_charge").val(),
            swiftCharges = $("#swift_charges").val(),totalNetAmount = 0,netAmount = 0,tcsAmount = 0,gst_cal=0, gst_val = 0;
        /*console.log("length ----",$('.txn_inr_amount').length);*/
        $('.txn_inr_amount').each(function () {
            netAmount += parseInt($(this).val());
            console.log("val---", $(this).val());
        })
        /*console.log("netAmount ++++++ ",netAmount);*/
        if(netAmount > tcsExempt){
            console.log("inrCalculation > tcsExempt",netAmount > tcsExempt);
            tcsAmount = ((netAmount - tcsExempt) * tcsRate) / 100
            console.log("tcsAmount",tcsAmount);
        }
        /*console.log("#####################################");
        console.log("netAmount ========= ",netAmount);
        console.log("netAmount - tcsExempt ====== ",(netAmount - tcsExempt));
        console.log("tcsAmount ==== ",tcsAmount);*/
		
		var sum_nostro_swift = Number(swiftCharges) + Number(nostroCharge);
        if(sum_nostro_swift>0)
        {
            gst_cal = Math.round(((sum_nostro_swift)*18)/100);
        }
        $("#gst_amount").text('₹'+gst_cal);
		
        $("#total_inr_value").text('₹'+Math.round(netAmount,2));
        $("#net_amount_text_box").val(Math.round(netAmount,2));
        totalNetAmount = parseFloat(netAmount) + parseFloat(tcsAmount) + Number(remitFees) + Number(swiftCharges) + Number(nostroCharge) + gst_cal;
        $("#tcs_amount").text('₹'+Math.round(tcsAmount,2));
        $("#tcs_amount_text_box").val(Math.round(tcsAmount,2));
        /*console.log("totalNetAmount === ",totalNetAmount);*/
        var inrCalRound = Math.round(totalNetAmount,2);
        $("#total_payable_amount").text('₹'+Math.round(inrCalRound,2));
        $("#gross_payable_text_box").val(Math.round(inrCalRound,2));
		$("#gst").val(Math.round(gst_cal,2));
    }
	
    function addCurrency(data){
        var rowCount = $("#selected-currency tbody tr").length;
        var validate = checkValidation();

        if (validate) {
            var amount = $("#amount").val();
            /*var bookingRate = $("#bookingRate").val();*/
            var fxRate = parseFloat(data.fx_rate) + parseFloat(data.branch_margin) + parseFloat(data.agent_commission === null ? 0 : data.agent_commission);
            var currencyType = $("#currencyType").val();
            var currencyTypeText = $("#currencyType option:selected").text();
            var inrCalculation = ((parseFloat(fxRate)) * amount);
            var inrCalRound = Math.round(inrCalculation,2);
            $("#currencyType option[value='"+currencyType+"']").remove();
            var html = '';

            html += '<tr id="row-' + rowCount + '">'+
                /*'<th scope="row">' + rowCount + '</th>'+*/
                '<td>'+
                    '<div class="d-flex align-items-center">'+
                        '<img src="./assets/img/dashboard/currency/'+ currencyTypeText.toLowerCase() +'.png" style="width: 25px; height: 18px" class="rounded-1"/>'+
                        '<div class="ms-2"><p class=" mb-0">'+ currencyTypeText +'</p></div>'+
                        '<input type="hidden" class="txn_currency_type" name="currency[' + rowCount + '][txn_currency_type]" value="' + currencyType + '" />'+
                    '</div>'+
                '</td>'+
                '<td>' + amount +
                '<input type="hidden" class="txn_frgn_curr_amount" name="currency[' + rowCount + '][txn_frgn_curr_amount]" value="' + amount + '" />'+
                '</td>'+
                '<td>' + fxRate.toFixed(2) +
                '<input type="hidden" class="txn_booking_rate" name="currency[' + rowCount + '][txn_booking_rate]" value="' + fxRate + '" />'+
                '<input type="hidden" class="txn_branch_margin" name="currency[' + rowCount + '][txn_branch_margin]" value="' + data.branch_margin + '" />'+
                '<input type="hidden" class="txn_agent_commission" name="currency[' + rowCount + '][txn_agent_commission]" value="' + data.agent_commission + '" />'+
                '<input type="hidden" class="txn_rate_block_id" name="currency[' + rowCount + '][txn_rate_block_id]" value="' + data.select_deal_rate + '" />'+
                '</td>'+
                '<td>₹' + inrCalRound +
                '<input type="hidden" class="txn_inr_amount" name="currency[' + rowCount + '][txn_inr_amount]" value="' + inrCalRound + '" />'+
                '</td>'+
                '<td>'+
                    '<a href="javascript:void(0)" class="btn-remove remove-currency" currencyText="' + currencyTypeText + '" data-row="' + rowCount + '"><i class="fa-solid fa-trash"></i></a>'+
                '</td>'+
            '</tr>';
            $(".currencyTable").append(html);
            $(".currency").text('');
            resetCurrencyRete();
            amountCalculation();
            rowCount++;
        }
    }

    $("#selected-currency tbody").delegate(".remove-currency", "click", function () {
        var row = $(this).attr('data-row');
        var currencyText = $(this).attr('currencyText');
        var currencyValue = currencyText+"/INR";
        $("#currencyType").append("<option value="+currencyValue+">" + currencyText +"</option>");
        $('#row-' + row).remove();
		resetCurrencyRete();
        amountCalculation();
    });

    $( "#amount,#currencyType" ).on( "keyup", function() {
        checkValidation();
    } );
	
	$("#fund_source_id" ).on( "change", function() {
        checkValidation();
    });
	
	$('#remit_fees,#swift_charges,#nostro_charge').on("keyup", function () {
        amountCalculation();
    });
	
	function selectDealRate(currencyType,bookingPurpose,transactionType){
        $.ajax({
            url: "{!! route('deal-rate.edit') !!}",
            type: 'POST',
            data:JSON.stringify({currencyType:currencyType,bookingPurpose:bookingPurpose,transactionType:transactionType}),
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                $('.addModals').html(result);
                $('#create-dealrate-model').modal('show');
            }
        });
    }

    let rowCountrb = $("#selected-currencyrb tbody tr").length;
    $('#addCurrencyrb').click(function () {
        $('#currencyerror').html('');
        $('#amountErrorrb').html('');
        if($('#currencyTyperb').val()=='')
        {
            $('#currencyerror').html('FX currency field is required!');
            return false;
        }

        if($('#amountrb').val()=='')
        {
            $('#amountErrorrb').html('Fx value field is required!');
            return false;
        }
		
		if($('#purpose_id').val()=='')
        {
            $('#purpose_idErrorrb').html('Booking purpose field is required!');
            return false;
        }
		
		if($('#txn_type').val()=='')
        {
            $('#txn_typeErrorrb').html('Transaction type field is required!');
            return false;
        }

        var rowCountrb = $("#selected-currencyrb tbody tr").length;
        var validaterb = checkValidationrb();



        if (validaterb) {

            var amountrb = $("#amountrb").val();
			var transactionTypeText = $( "#txn_type option:selected" ).text();
            var transactionTypeval = $("#txn_type").val();
			var bookingpurposeText = $('#purpose_id option:selected').attr("data-value");
            var bookingpurposeval = $("#purpose_id").val();
            var currencyType = $("#currencyTyperb").val();
            var currencyTypeText = $("#currencyTyperb option:selected").text();
            $("#currencyTyperb option[value='"+currencyType+"']").remove();
            resetCurrencyReterb();
            var html = '';

            html += '<tr id="row-' + rowCountrb + '">'+
                '<td>'+
                '<div>'+
                '<img src="./assets/img/dashboard/currency/'+ currencyTypeText.toLowerCase() +'.png" style="width: 25px; height: 18px" class="rounded-1"/>'+
                currencyTypeText +
                '<input type="hidden" class="txn_currency_typerb" name="currency[' + rowCountrb + '][txn_currency_typerb]" value="' + currencyType + '" />'+
                '</div>'+
                '</td>'+
                '<td>' + amountrb +
                '<input type="hidden" class="txn_frgn_curr_amountrb" name="currency[' + rowCountrb + '][txn_frgn_curr_amountrb]" value="' + amountrb + '" />'+
                '</td>'+
				'<td>' + bookingpurposeText +
                '<input type="hidden" class="txn_booking_purpose" name="currency[' + rowCountrb + '][txn_booking_purpose]" value="' + bookingpurposeval + '" />'+
                '</td>'+
				'<td>' + transactionTypeText +
                '<input type="hidden" class="txn_type" name="currency[' + rowCountrb + '][txn_type]" value="' + transactionTypeval + '" />'+
                '</td>'+
                '<td>'+
                '<a href="javascript:void(0)" class="btn-remove remove-currencyrb new_btn_remove" currencyText="' + currencyTypeText + '" data-row="' + rowCountrb + '"><img src="./assets/img/dashboard/icon_remove.png" alt="remove"> Remove</a>'+
                '</td>'+
                '</tr>';
            $(".currencyTablerb").append(html);
            $(".currency").text('');
            $('#currencyErrorrb').html('');
			$('#txn_typeErrorrb').html('');
			$('#purpose_id').val('');
			$('#txn_type').val('');
            rowCountrb++;
        }
    });

    function checkValidationrb(){
        var amount = $("#amountrb").val();
        var currencyType = $("#currencyTyperb").val();
        var validate = false;
        /*var inrAmount = $("#inrAmount").val();*/
        if ($.isNumeric(amount) && currencyType !== '') {
            validate = true;
            $("#addCurrency").prop('disabled', false);
            $('#currencyError').html('');
        } else {
            $("#addCurrency").prop('disabled', true);
            $('#currencyError').html('Add min one currency.');
        }
        return validate;
    }

    $("#selected-currencyrb tbody").delegate(".remove-currencyrb", "click", function () {
        var row = $(this).attr('data-row');
        var currencyText = $(this).attr('currencyText');
        var currencyValue = currencyText+"/INR";
        $("#currencyTyperb").append("<option value="+currencyValue+">" + currencyText +"</option>");
        $('#row-' + row).remove();
    });

    function resetCurrencyReterb(){
        $("#amountrb").val('');
        $("#currencyTyperb").val('');
        $("#addCurrency").prop('disabled', true);
    }

    $('.save-currency-form').submit(function(event) {
        $('#currencyError').html('');
        var selectedcurrencycount = $('.currencyTablerb tr').length;
        event.preventDefault();
        var currentDate = new Date();
        var currentHour = currentDate.getHours();
        var currentMinute = currentDate.getMinutes();
		
		console.log(currentHour);
         if (currentHour => 10 && (currentHour < 15 || (currentHour === 15 && currentMinute < 15))) {
            if (selectedcurrencycount > 0) {
                $('.ajax-error').html('');
                var data = new FormData(this);
                $.ajax({
                    url: $(this).attr("action"),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        console.log(result);
                        /*$(this).attr("disabled", false);*/
                        if (result.type === 'SUCCESS') {
                            swal({
                                title: "Success",
                                text: result.message,
                                icon: "success",
                                button: "okay",
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            toastr.error(result.message);
                        }
                    },
                    error: function(error) {
                        $(this).attr("disabled", false);
                        let errors = error.responseJSON.errors,
                            errorsHtml = '';
                        $.each(errors, function(key, value) {
                            errorsHtml = '<strong>' + value[0] + '</strong>';
                            $('.' + key).html(errorsHtml);
                        });
                    }
                });
            } else {
                $('#currencyErrorrb').html('<strong>Please add Min one Currency</strong>');
            }
       } else {
            swal({
                title: "You can rate block between 10.00 AM to 3:15 PM time",
                text: "",
                icon: "error",
                buttons: true,
                dangerMode: true,
                buttons:"OK",
                })
                .then((result) => {});
        } 

    });

</script>
