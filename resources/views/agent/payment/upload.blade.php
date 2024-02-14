<style>
    .pdfViewer {
        padding-bottom: var(--pdfViewer-padding-bottom);
    }
    .shrinkToFit {
        cursor: zoom-in;
    }
	.grid-container {
		display: grid;
		grid-template-columns: 1fr 1fr;
		grid-gap: 20px;
	}
</style>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<div class="modal fade" id="upload-kyc-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title fw-bold  r " id="exampleModalLabel1" style="color: #2565ab;">Payment Upload
                </h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <form action="{{route('payment.upload')}}" method="post" class="form form-vertical save-form" id="save-upload-form" enctype="multipart/form-data" files="true">
                <div class="modal-body">
                    <div class=" bgc-model m-2">
                        <div class="row ">


                            <div class="col-md-3 col-sm-6 ">
                                <p  class="text-color">Transaction Number
                                </p>
                                <div>
                                    <p id="txn_number">{{$data->txn_number}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 ">
                                <p  class="text-color">Customer Name
                                </p>
                                <div>
                                    <p>
                                        {{$data->customer_name}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 ">
                                <p  class="text-color">Mobile
                                </p>
                                <div>
                                    <p>
                                        {{$data['customerData']['mobile']}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6  ">
                                <p  class="text-color">Gross Amount
                                </p>
                                <div>
                                    <p style="font-weight:bold;">
                                        {{ "&#8377; ".$data->gross_payable ? $data->gross_payable : '0.00' }}
										<input type="hidden" name="amount_payable" id="amount_payable" value="{{ $data->gross_payable ? $data->gross_payable : '0.00' }}">
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-4" style="padding: 13px;">
                        <div class="col-md-12">
                            <label class="">Payment Type</label>
                            <div class="input-group">
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio" class="form-check-input" name="payment_type" value="1" checked>&nbsp; Bank Transfer
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio" class="form-check-input" name="payment_type" value="2">&nbsp; Online Payment
                                    </label>
                                </div>
                                {{--@component('components.ajax-error',['field'=>'kyc_status'])@endcomponent--}}
                            </div>
							<div class="col-12" style="margin-top:10px;" id="bank_detail">
								<div class="grid-container">

									<div class="grid-child" style="border: 2px #dddddd dashed;border-radius: 10px;padding: 15px;">
										<div style="font-weight:bold">INDUSIND BANK LTD</div>
										<div>
											<span style="font-weight:bold;font-size:15px;">ACCOUNT NAME: </span><span style="font-size:18px;">QUICK FOREX LTD</span><br/>
											<span style="font-weight:bold;font-size:15px;">ACCOUNT NO: </span><span style="font-size:18px;">259899999499</span><br/>
											<span style="font-weight:bold;font-size:15px;">IFSC CODE: </span><span style="font-size:18px;">INDB0000031</span><br/>
											<span style="font-weight:bold;font-size:15px;">MICR CODE: </span><span style="font-size:18px;">110234005</span><br/>
											<span style="font-weight:bold;font-size:15px;">BRANCH: </span><span style="font-size:18px;">C-61, PREET VIHAR, VIKAS MARG, NEW DELHI-110092</span>
										</div>
									</div>

									<div class="grid-child" style="border: 2px #dddddd dashed;border-radius: 10px;padding: 15px;">
										<div style="font-weight:bold">HDFC BANK LTD</div>
										<div>
											<span style="font-weight:bold;font-size:15px;">ACCOUNT NAME: </span><span style="font-size:18px;">QUICK FOREX LTD</span><br/>
											<span style="font-weight:bold;font-size:15px;">ACCOUNT NO: </span><span style="font-size:18px;">50200006639111</span><br/>
											<span style="font-weight:bold;font-size:15px;">IFSC CODE: </span><span style="font-size:18px;">HDFC0001317</span><br/>
											<span style="font-weight:bold;font-size:15px;">MICR CODE: </span><span style="font-size:18px;">110240147</span><br/>
											<span style="font-weight:bold;font-size:15px;">BRANCH: </span><span style="font-size:18px;">PROPERTY NO.16/10164, PADAM SINGH ROAD KAROL BAGH, NEW DELHI -110005</span>
										</div>
									</div>

								</div>
                                <div class="grid-container mt-1">
                                    <div >
                                        <label class="">Payment Image</label>
                                        <div class="input-group mb-3">
                                            <input class="form-control p-2 w-100" type="file" name="payment_upload_document" id="payment_upload_document">
                                            @component('components.ajax-error',['field'=>'payment_upload_document'])@endcomponent
                                        </div>
                                    </div>
                                    <div >
                                        <label class="">Payment Comment</label>
                                        <div class="mb-3">
                                            <textarea class="form-control p-2" name="payment_comment" rows="3" id="payment_comment"></textarea>
                                            @component('components.ajax-error',['field'=>'payment_comment'])@endcomponent
                                        </div>
                                    </div>
							    </div>
                            </div>
							<div id="online_payment" class="col-12" style="margin-top:10px;display: none;">
                                <div class="grid-container">
                                    <div class="grid-child" style="border: 1px black solid;border-radius: 10px;padding: 7px;">
                                        <img src="{{asset('assets/img/razorpay.png')}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="id" id="id" value="{{$data->id}}">
                    <button type="submit" class="btn btn-secondary px-5 fw-bold text-capitalize buy_now" id="rzp-button1">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="viewModal" tabindex="-1">
    <div class="modal-dialog  modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Documents</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <iframe src="" id="iframe" title="W3Schools Free Online Web Tutorials" class="w-100"
                        style="height: 500px"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        onclick="$('#viewModal').modal('hide');">Close
                </button>
            </div>
        </div>
    </div>
</div>
<iframe id="displayIframe"></iframe>
<script>

    $('.save-form').submit(function (event) {
        var status = document.activeElement.innerHTML;
        event.preventDefault();
        if (status) {
            $('.ajax-error').html('');
            var data = new FormData(this);
			var formurl="";
            if($("input[name='payment_type']:checked").val()==1){
                $.ajax({
                    url: $(this).attr("action"),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (result) {
                        if (result.type === 'SUCCESS') {
                            toastr.success(result.message);
                            $("#upload-kyc-model").modal('hide');
                            $('#agent-payment-table').DataTable().ajax.reload();
                        } else {
                            toastr.error(result.message);
                        }
                    },
                    error: function (error) {
                        $(this).attr("disabled", false);
                        let errors = error.responseJSON.errors, errorsHtml = '';
                        $.each(errors, function (key, value) {
                            errorsHtml = '<strong>' + value[0] + '</strong>';
                            $('.' + key).html(errorsHtml);
                        });
                    }
                });
			}
            else{
                var username = "{{Auth::guard('agent_users')->user()->first_name." ".Auth::guard('agent_users')->user()->last_name}}";
                var email = "{{Auth::guard('agent_users')->user()->email}}";
                var mobile = "{{Auth::guard('agent_users')->user()->mobile}}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('payment.process') }}",
                    type: "POST",
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({ amount: $('#amount_payable').val() }),
                    success: function (result) {
                        //console.log('result', result);
                        var options = {
                            "key": "{{ env('RAZORPAY_KEY_ID') }}",
                            "amount": result.amount,
                            "currency": result.currency,
                            "name": "Quick Forex",
                            "description": '#'+$('#txn_number').text(),
                            "image": "{{asset('assets/img/login/logo.png')}}",
                            "order_id": result.order_id,
                            "handler": function (response){
                                if(response.razorpay_payment_id!=""){
                                   $.ajax({
                                        url: "{{ route('changepayment.status') }}",
                                        type: "POST",
                                        dataType: "json",
                                        contentType: "application/json; charset=utf-8",
                                        data: JSON.stringify({'id': $('#id').val(),'data': response }),
                                        success: function (result) {
                                            swal({
                                                title: "Success",
                                                text: result.transactionid+" Payment Done!",
                                                icon: "success",
                                                button: "okay",
                                            }).then(function(){
                                                    location.reload();
                                                }
                                            );

                                        }
                                    });
                                }
                                $('#upload-kyc-model').modal('hide');
                            },
                            "prefill": {
                                "name": username,
                                "email": email,
                                "contact": mobile
                            }
                        };
                        var rzp1 = new Razorpay(options);

                        rzp1.on('payment.captured', function(response) {
                            console.log('Done');
                        });
                        rzp1.on('payment.failed', function (response){
                            // Handle failed payment
                            alert(response.error.description);

                        });
                        rzp1.open();
                    },
                    error: function (err) {
                        // check the err for error details
                    }
                });
            }
        }
    });

    $(".btn-close").click(function(){
        $('.modal').modal('hide');
    });

    function readFile(fileName) {
        var input = $('#' + fileName)[0];
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                /*var data = e.target.result;
                let w = window.open(data, "Window Title", "width=300,height=400,left=100,top=200");
                let image = new Image();
                image.src = data;
                setTimeout(function(){
                    w.document.write(image.outerHTML);
                }, 0);*/
                $('#iframe').attr("src", e.target.result);
                $('#viewModal').modal("show");
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
	
	$('input[type=radio][name=payment_type]').change(function() {

		$('#bank_detail').show();
		$('#online_payment').hide();

		if (this.value == 2) {
			$('#bank_detail').hide();
            $('#online_payment').show();
		}
		else{
            $('#bank_detail').show();
            $('#online_payment').hide();
        }


	});
</script>
