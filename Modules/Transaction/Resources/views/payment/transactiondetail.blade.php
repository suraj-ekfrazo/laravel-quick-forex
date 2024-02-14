<style>
    .pdfViewer {
        padding-bottom: var(--pdfViewer-padding-bottom);
    }
    .shrinkToFit {
        cursor: zoom-in;
    }
</style>
{{--Single Transaction Detail Show--}}
<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="ps-1 fw-bold">Transaction Details</div>
                <div class="ml-auto">
                    {{--<button class="btn-print  ">  <img src="./assets/img/dashboard/svg/ic-print.svg" class="mb-1 me-1" alt=""> Print</button>
                    <button class="btn-download  "> <img src="./assets/img/dashboard/svg/ic-download.svg" class="mb-1 me-1" alt=""> Download</button>--}}
                </div>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <div class=" bgc-model m-2">
                    <div class="row ">
                        <div class="col-md-3 col-sm-6  ">
                            <p  class="text-color">Customer Name</p>
                            <div>
                                <p>{{$data['customerData']['name']}}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                            <p  class="text-color">Mobile Number</p>
                            <div>
                                <p>
                                    {{$data['customerData']['mobile']}}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                            <p  class="text-color">Transaction type</p>
                            <div>
                                <p>
                                    {{$data['txn_type']==1 ? 'Remittance' : 'Card' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6  ">
                            <p  class="text-color">Purpose</p>
                            <div>
                                <p>
                                    {{$data['purposeData']['purpose_name']}}
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-6  ">
                            <p  class="text-color">Source Of Fund</p>
                            <div>
                                <p>
                                    {{$data['sourceData']['source_name']}}
                                </p>
                            </div>

                        </div>
                        <div class="col-md-3 col-sm-6  ">
                            <p  class="text-color">Remitter PAN</p>
                            <div>
                                <p>
                                    {{$data['pancard_no']}}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="d-flex gap-3 justify-content-center m-2">
                    <div class="d-flex badge-1     ">
                        <div class="border-incdent"></div>
                        <p class="badge-c ps-1 fw-bold lh-lg small">*TCS Applicable @ 5%</p>
                    </div>
                    <div class="d-flex badge-1   ">
                        <div class="border-incdent"></div>
                        <p class="ps-1 badge-c fw-bold lh-lg small">*Previous Remittance in AY with QFX: 0.00</p>
                    </div>
                </div>

                <div class="table-responsive-sm pt-4   ps-0 pe-0">
                    <table class="table roundedTable text-center "  >
                        <tr class="bgc-table row-font1">
                            <th scope="col" class="fw-bold" >Sr.No</th>
                            <th scope="col" class="fw-bold">FX Currency</th>
                            <th scope="col" class="fw-bold">FX Amount</th>
                            <th scope="col" class="fw-bold">Booking Rate</th>
                           {{-- <th scope="col" class="fw-bold">Remit Fees</th>--}}
                            <th scope="col" class="fw-bold">Value INR</th>

                        </tr>
                        <tbody class="">
                        @if(count($data['txnCurrency'])>0)
                            @foreach($data['txnCurrency'] as $key => $val)
                                <tr class="  ">
                                    <th scope="row">1</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            {{--<img src="./assets/img/dashboard/usd_t.png" style="width: 25px; height: 18px" class="rounded-1"/>--}}
                                            <div class="ms-2"><p class=" mb-0">{{$val->txn_currency_type}}</p></div>
                                        </div>
                                    </td>
                                    <td>{{$val->txn_frgn_curr_amount}}</td>
                                    <td>{{$val->txn_booking_rate}}</td>
                                    {{--<td>₹4,49,269</td>--}}
                                    <td class="text-start">{{$val->txn_inr_amount}}</td>

                                </tr>
                            @endforeach
                        @endif

                        <tr class="bgc">
                            <th></th>
                            <td></td>
                            <td></td>
                            <td class="text-end ">
                                <div>Net Amount  :</div>
                                {{--<div>TCS  :</div>--}}
                                <div>Amount for TCS :</div>
                                <div>Remit Fees :</div>
                                <div>Swift Charge :</div>

                            </td>
                            <td class="text-start">
                                <div>  {{$data['net_amount']}} </div>
                                {{--<div>  {{$data['tcs']}} </div>--}}
                                <div>  {{$data['amount_for_tcs']}} </div>
                                <div>  {{$data['remit_fees']}} </div>
                                <div>  {{$data['swift_charges']}} </div>
                            </td>
                        </tr>

                        <tr class="bgc-model">
                            <th></th>
                            <td></td>
                            <td></td>
                            <td class="fw-bold text-end ">Gross Payable :</td>
                            <td class="row-font1 fw-bold text-start">{{$data['gross_payable']}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="modal-footer text-center">
              <button type="button" class="btn btn-primary">Submit</button>
            </div> -->
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
                    console.log(result);
                    /*$(this).attr("disabled", false);*/
                    if (result.type === 'SUCCESS') {
                        toastr.success(result.message);
                        $("#upload-kyc-model").modal('hide');
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
</script>
