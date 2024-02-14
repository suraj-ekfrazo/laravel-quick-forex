<style>
    .pdfViewer {
        padding-bottom: var(--pdfViewer-padding-bottom);
    }
    .shrinkToFit {
        cursor: zoom-in;
    }
</style>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<div class="modal fade" id="update-payment-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title fw-bold  r " id="exampleModalLabel1" style="color: #2565ab;">Payment Update
                </h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <form action="{{route('payment.update')}}" method="post" class="form form-vertical save-payment-form" id="save-upload-form" enctype="multipart/form-data" files="true">
                <div class="modal-body">
                    <div class=" bgc-model m-2">
                        <div class="row ">


                            <div class="col-md-3 col-sm-6  ">
                                <p  class="text-color">Transaction Number
                                </p>
                                <div>
                                    <p>{{$data->txn_number}}</p>
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
                                <p  class="text-color">Transaction Type
                                </p>
                                <div>
                                    <p>
                                        {{ $data->txn_type=='1' ? 'Remittance': 'card' }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6  ">
                                <p  class="text-color">Payment Type
                                </p>
                                <div>
                                    <p>
                                        {{ $data->payment_type=='1' ? 'Bank Transfer': 'Online Payment' }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row mt-4 m-2">
                        <div style="color:red;">
                        {{$data->payment_upload_document=="" ? "Payment Proff not Uploaded yet!" : "" }}
                        </div>
                        <div class="col-md-12">
                            <a href="{{ $data->payment_upload_document!="" ? asset('upload/allDocuments/').'/'.date('Y-m-d',strtotime($data->created_at)).'/'.$data->txn_number. '/'.$data->payment_upload_document : "javascript:void(0)"  }}"   target="_blank" class="btn btn-secondary px-5 fw-bold text-capitalize" style="pointer-events: {{$data->payment_upload_document=="" ? 'none;' : 'all;'}}"  ><i class="fa fa-eye" aria-hidden="true"></i> View Payment Proof</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="">Payment Type</label>
                        <div class="input-group">
                            <div class="col-md-6">
                                <label class="radio-inline">
                                    <input type="radio" class="form-check-input" name="payment_status" value="1" checked>&nbsp; Approved
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="radio-inline">
                                    <input type="radio" class="form-check-input" name="payment_status" value="2">&nbsp; Reject
                                </label>
                            </div>
                            @component('components.ajax-error',['field'=>'payment_status'])@endcomponent
                        </div>

                        <div >
                            <label class="">Payment Comment</label>
                            <div class="mb-3">
                                <textarea class="form-control p-2" name="payment_comment" rows="3" id="payment_comment">{{ $data->payment_comment }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" value="{{ $data->id }}" name="id">
                    <button type="submit" class="btn btn-secondary px-5 fw-bold text-capitalize" {{$data->payment_upload_document=="" ? "disabled" : "" }}>Update</button>
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

    $('.save-payment-form').submit(function (event) {
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
                    /*$(this).attr("disabled", false);*/
                    if (result.type === 'SUCCESS') {
                        toastr.success(result.message);
                        $("#update-payment-model").modal('hide');
                        $('#admin-payment-table').DataTable().ajax.reload();
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
