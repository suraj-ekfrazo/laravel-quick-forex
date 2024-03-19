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
<div class="modal fade" id="upload-swift-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title fw-bold  r " id="exampleModalLabel1" style="color: #2565ab;">Swift Upload
                </h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <form action="{{route('swift.upload')}}" method="post" class="form form-vertical save-form" id="save-upload-form" enctype="multipart/form-data" files="true">
                <div class="modal-body">
                    <div class=" bgc-model m-2 p-3">
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
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="upload-kyc-each">
                            <div class="kyc_doc_card upload-kyc-inner">
                                <label class="form-label mt-3 qf-file-upload-title"
                                    for="Swift Image">Swift Image :
                                </label>
                                <div class="upload-wrapper">
                                    <div class="file-input-wrap">
                                        <input class="form-control imagechange1 qf-file-upload" type="file" name="swift_upload_document" id="swift_upload_document">
                                        @component('components.ajax-error',['field'=>'swift_upload_document'])@endcomponent
                                    </div>
                                    <div class="text-center">
                                        <button type="button qf-secondary-btn"
                                            class="btn fw-bold btn_view_kyc_doc text-capitalize"
                                            onclick="readFile('swift_upload_document'); return false;"><i
                                            class="fa-solid fa-eye "></i> View</button>
                                    </div>
                                    @php $existing_file = asset('upload/allDocuments/').'/'.date('Y-m-d',strtotime($data->created_at)).'/'.$data->txn_number. '/'.$data->swift_upload_document @endphp
                                    @if($existing_file)
                                        <div class="text-center">
                                            <button type="button qf-secondary-btn"
                                                class="btn fw-bold btn_view_kyc_doc text-capitalize"
                                                onclick="previewLastFile('{{ $existing_file }}')"><i
                                                class="fa-solid fa-eye "></i> Last Uploaded</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="id" id="id" value="{{$data->id}}">
                    <button type="submit" class="btn qf-secondary-btn px-5 fw-bold text-capitalize buy_now" id="rzp-button1">Submit</button>
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

<script>

    $('.save-form').submit(function (event) {
        var status = document.activeElement.innerHTML;
        event.preventDefault();
        if (status) {
            $('.ajax-error').html('');
            var data = new FormData(this);
			var formurl="";
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
                        $("#upload-swift-model").modal('hide');
                        $('#agent-completed-transaction-table').DataTable().ajax.reload();
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

    function previewLastFile(fileName) {
        if (fileName) {
            $('#iframe').attr("src", fileName);
            $('#viewModal').modal("show");
        }
    }

</script>
