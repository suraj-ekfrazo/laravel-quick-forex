<script>

    $("#accordion div .collapse").css("display", "none");

    $("#accordion .agent-detail-card .collapse").css("display", "block");

    $(".initiate-transaction-btn").prop('disabled', true);
  
    // $("#accordion .card").click(function(event) {
    //     event.preventDefault();
    //     // if ($(this).find('.collapse').css("display") == "none") {
    //     if($("#pancard_no").val() == "" && $("#pancard_name").val() == ""){
    //         swal({
    //             title: "Please verify pan details",
    //             text: "",
    //             icon: "error",
    //             buttons: true,
    //             dangerMode: true,
    //             buttons:"OK",
    //         }).then((swalresult) => {
    //         });
    //     }
    // });

    $("#pan_card_name").on("keyup", function (evt) {
        $(this).val($(this).val().toUpperCase());
    });

    $("#valid_pancard_no").keyup(function() {
        var inputvalues = $(this).val();      
        $(".invalid-feedback.ajax-error.valid_pancard_no").html('');
        var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;    
        if(!regex.test(inputvalues) && inputvalues.length > 0){       
            $(".invalid-feedback.ajax-error.valid_pancard_no").html('<strong>Please Enter valid Pan Card Number.</strong>');
            return regex.test(inputvalues);    
        }
    });

    $("#validate-pan-details").click(function(event) {
        event.preventDefault();

        $("#pancard_no").val('');
        $("#pancard_name").val('');
        $("#passport_holder_name").val('');

        if($("#valid_pancard_no").val() != "" && $("#pan_card_name").val() != ""){
            var panRegex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;  

            if (panRegex.test($("#valid_pancard_no").val())) {
                $.ajax({
                    url: "{!! route('verify.pancard') !!}",
                    type: 'POST',
                    data:  JSON.stringify({customer_name : $("#pan_card_name").val(), pancard_no : $("#valid_pancard_no").val()}),
                    contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#fullPageLoader').show(); // Show the loader before sending the request
                    },
                    success: function (response) {
                        if (response.type === 'SUCCESS') {
                            if (response.data.result) {
                                if (response.data.result.upstreamName == $("#pan_card_name").val()) {
                                    if (response.data.result.panStatus == "VALID") {
                                        $("#accordion div .collapse").css("display", "");
                                        $("#pancard_no").val($("#valid_pancard_no").val());
                                        $("#pancard_name").val(response.data.result.upstreamName);
                                        $("#passport_holder_name").val(response.data.result.upstreamName);
                                        $("#pancard_no").prop("readonly",true);
                                        $("#pancard_name").prop("readonly",true);
                                        $("#valid_pancard_no").prop("readonly",true);
                                        $("#pan_card_name").prop("readonly",true);
                                        $("#validate-pan-details").prop('disabled', true);
                                        $(".validate-pan-restriction").css("display", "none");
                                        $(".verified-pan-success").show();
                                        showSwalPopup("Pan details verified successfully", "", "success");
                                    }else{
                                        showSwalPopup(response.data.result.message, "valid_pancard_no", "error");
                                    }
                                }else{
                                    showSwalPopup("Pan card name doesn't match with pan number", "pan_card_name", "error");
                                }
                            }else if(response.data.error){
                                showSwalPopup(response.data.error.message, "valid_pancard_no", "error");
                            }else{
                                showSwalPopup("Something went wrong try later", "valid_pancard_no", "error");
                            }
                        }else{
                            showSwalPopup("Something went wrong try later", "valid_pancard_no", "error");
                        }
                    },
                    complete: function() {
                        $('#fullPageLoader').hide(); // Hide the loader once the request is complete
                    }
                });
            }else{
                showSwalPopup("Please enter valid pan card number", "valid_pancard_no", "error");
            }
            
        }else{

            swal({
                title: "Please enter valid pan card name and pan card number",
                text: "",
                icon: "error",
                buttons: true,
                dangerMode: true,
                buttons:"OK",
            }).then((swalresult) => {
                if ($("#pan_card_name").val() == "") {
                    $(".invalid-feedback.ajax-error.pan_card_name").html('<strong>Please Enter valid Pan Card Name.</strong>');
                }
                if ($("#pan_card_name").val() == "") {
                    $(".invalid-feedback.ajax-error.valid_pancard_no").html('<strong>Please Enter valid Pan Card Number.</strong>');
                }
            });
        }
    });

    $("#aadhaarcard_no").change(function() {
        var inputvalues = $(this).val();      
        $(".invalid-feedback.ajax-error.aadhaarcard_no").html('');

        if (inputvalues != "") {
            var regex = /^([0-9]{4}[0-9]{4}[0-9]{4}$)|([0-9]{4}\s[0-9]{4}\s[0-9]{4}$)|([0-9]{4}-[0-9]{4}-[0-9]{4}$)/;
            if(!regex.test(inputvalues) && inputvalues.length > 0){       
                $(".invalid-feedback.ajax-error.aadhaarcard_no").html('<strong>Please Enter valid Aadhar Card Number.</strong>');
                return regex.test(inputvalues);    
            }else{
                $.ajax({
                    url: "{!! route('verify.aadhaarcard') !!}",
                    type: 'POST',
                    data:  JSON.stringify({aadhaarcard_no : inputvalues}),
                    contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#fullPageLoader').show(); // Show the loader before sending the request
                    },
                    success: function (response) {
                        if (response.type === 'SUCCESS') {
                            if (response.data.result) {
                                if (response.data.result.verified == true) {

                                    getPanAadhaarLinkStatus($("#aadhaarcard_no").val(), $("#pancard_no").val());

                                }else{
                                    showSwalPopup(response.data.error.message, "aadhaarcard_no", "error");
                                }
                            }else if(response.data.error){
                                showSwalPopup(response.data.error.message, "aadhaarcard_no", "error");
                            }else{
                                showSwalPopup("Something went wrong try later", "aadhaarcard_no", "error");
                            }
                        }else{
                            showSwalPopup("Something went wrong try later", "aadhaarcard_no", "error");
                        }
                    },
                    complete: function() {
                        $('#fullPageLoader').hide(); // Hide the loader once the request is complete
                    }
                });
            }    
        }else{
            $(".invalid-feedback.ajax-error.aadhaarcard_no").html('<strong>This is required field.</strong>');
        }
    });

    function getPanAadhaarLinkStatus(aadhaarcard_no, pancard_no){
        $("#pan_aadhaar_link_status").prop('checked', false);
        $("#pan_aadhaar_link_status").val('');
        $.ajax({
            url: "{!! route('verify.panadharlinkstatus') !!}",
            type: 'POST',
            data:  JSON.stringify({aadhaarcard_no : aadhaarcard_no, pancard_no: pancard_no}),
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#fullPageLoader').show(); // Show the loader before sending the request
            },
            success: function (response) {
                if (response.type === 'SUCCESS') {
                    if (response.data.result) {
                        if (response.data.result.linked == true) {
                            $("#pan_aadhaar_link_status").prop('checked', true);
                            $("#pan_aadhaar_link_status").val("1");
                            $(".initiate-transaction-btn").prop('disabled', false);
                        }else{
                            showSwalPopup("Something went wrong try later", "aadhaarcard_no", "error");
                        }
                    }else if(response.data.error){
                        showSwalPopup(response.data.error.message, "aadhaarcard_no", "error");
                    }else{
                        showSwalPopup("Something went wrong try later", "aadhaarcard_no", "error");
                    }
                }else{
                    showSwalPopup("Something went wrong try later", "aadhaarcard_no", "error");
                }
            },
            // error: function(xhr, status, error) {
            //     showSwalPopup("An error occurred: " + error, "aadhaarcard_no", "error"); 
            //     setTimeout(function() {
            //         $('#fullPageLoader').hide();
            //     }, 5000);
            // },
            complete: function() {
                $('#fullPageLoader').hide(); // Hide the loader once the request is complete
            }
        });
    }

    $("#verify-passport-no").click(function(event) {
        event.preventDefault();
        if($("#passport_file_number").val() != "" && $("#passport_holder_name").val() != "" && $("#passport_holder_dob").val() != ""){
            $.ajax({
                url: "{!! route('verify.passportno') !!}",
                type: 'POST',
                data:  JSON.stringify({passport_file_number : $("#passport_file_number").val(), passport_holder_name : $("#passport_holder_name").val(), passport_holder_dob : $("#passport_holder_dob").val()}),
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#fullPageLoader').show(); // Show the loader before sending the request
                },
                success: function (response) {
                    if (response.type === 'SUCCESS') {
                        if (response.data.result) {
                            if (response.data.result.verified === "true") {
                                $("#passport_file_number").prop("readonly",true);
                                $("#passport_holder_name").prop("readonly",true);
                                $("#passport_holder_dob").prop("readonly",true);
                                $("#verify-passport-no").prop('disabled', true);
                                $("#passport_detail_verification").val('1');
                            }else{
                                showSwalPopup(response.data.result.message, "passport_file_number", "error");
                            }
                        }else if(response.data.error){
                            showSwalPopup(response.data.error.message, "", "error");
                        }else{
                            showSwalPopup("Something went wrong try later", "", "error");
                        }
                    }else{
                        showSwalPopup("Something went wrong try later", "", "error");
                    }
                },
                complete: function() {
                    $('#fullPageLoader').hide(); // Hide the loader once the request is complete
                }
            });
        }else{
            swal({
                title: "Please enter valid passport details",
                text: "",
                icon: "error",
                buttons: true,
                dangerMode: true,
                buttons:"OK",
            }).then((swalresult) => {
                if ($("#passport_file_number").val() == "") {
                    $(".invalid-feedback.ajax-error.passport_file_number").html('<strong>Please Enter Passport File Number.</strong>');
                }
                if($("#passport_holder_name").val() == ""){
                    $(".invalid-feedback.ajax-error.passport_holder_name").html('<strong>Please Enter Passport Holder Name.</strong>');
                }
                if($("#passport_holder_dob").val() == ""){
                    $(".invalid-feedback.ajax-error.passport_holder_dob").html('<strong>Please Enter Passport Holder DOB.</strong>');
                }
            });

        }
    });

    function showSwalPopup(message, element, icon_type = "error"){
        swal({
            title: message,
            text: "",
            icon: icon_type,
            buttons: true,
            dangerMode: true,
            buttons:"OK",
        }).then((swalresult) => {
            if (element != "") {
                $("#" + element + "").val('');
            }
        });
    }
 
    function isOnlyAlphaKey(evt) {
        var txt = String.fromCharCode(evt.which);
        if (!txt.match(/[A-Za-z&. ]/)) {
            return false;
        }
    }

</script>
