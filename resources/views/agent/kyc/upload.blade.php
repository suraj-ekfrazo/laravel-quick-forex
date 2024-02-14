<style>
    .pdfViewer {
        padding-bottom: var(--pdfViewer-padding-bottom);
    }

    .shrinkToFit {
        cursor: zoom-in;
    }
	#loader {
  display: none; /* Initially hidden */
  /* Add your styling for the loader */
}
</style>
<div class="modal fade" id="upload-kyc-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title fw-bold  r " id="exampleModalLabel1" style="color: #2565ab;">KYC Upload
                </h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <form action="{{route('transaction-kyc.upload')}}" method="post" class="form form-vertical save-form"
                id="save-upload-form" enctype="multipart/form-data" files="true">
                <div class="modal-body">
                    <div class=" bgc-model m-2 p-3">
                        <div class="row ">


                            <div class="col-md-3 col-sm-6  ">
                                <p class="text-color">Transaction Number
                                </p>
                                <div>
                                    <p>{{$data->txn_number}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 ">
                                <p class="text-color">Customer Name
                                </p>
                                <div>
                                    <p>
                                        {{$data->customer_name}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 ">
                                <p class="text-color">Mobile
                                </p>
                                <div>
                                    <p>
                                        {{$data['customerData']['mobile']}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6  ">
                                <p class="text-color">Transaction type
                                </p>
                                <div>
                                    <p>
                                        {{ $data->txn_type=='1' ? 'Remittance': 'card' }}
                                    </p>
                                </div>

                            </div>
                        </div>

                        {{-- <div class="row">--}}
                            {{-- <div class="col-md-3 col-sm-6  ">--}}
                                {{-- <p class="text-color">Purpose</p>--}}
                                {{-- <div>--}}
                                    {{-- <p>--}}
                                        {{-- Relative--}}
                                        {{-- </p>--}}
                                    {{-- </div>--}}
                                {{-- </div>--}}
                            {{-- </div>--}}
                    </div>
                    <input type="hidden" name="txn_link_no" value="{{$data->txn_number}}">
                    <div class="row mt-3">
                        @foreach ($kyc_documents as $doc)
                            @if ($kyc_data)
                                @if ($kyc_data[$doc->document_name . '_status'] != 1)
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="kyc_doc_card mb-3">
                                            <label class="form-label mt-3 fw-bold"
                                                for="{{ $doc->document_name }}">{{ $doc->document_value }} :
                                            </label>

                                            <input type="file" class="form-control imagechange1"
                                                data-key="{{ $doc->document_name }}" id="{{ $doc->document_name }}"
                                                name="{{ $doc->document_name }}" />
                                            @component('components.ajax-error', ['field' => "$doc->document_name"])
                                            @endcomponent
                                            <div class="text-center mt-3 ">
                                                <button type="button"
                                                    class="btn btn-secondary fw-bold btn_view_kyc_doc text-capitalize mt-2"
                                                    onclick="readFile('{{ $doc->document_name }}')"><i
                                                        class="fa-solid fa-eye"></i> View</button>
                                            </div>
                                        </div>

                                        @if ($kyc_data && $kyc_data[$doc->document_name . '_status'] == 2)
                                            <p class="text-danger">Rejected Reason :-
                                                {{ $kyc_data[$doc->document_name . '_comment'] }}</p>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="kyc_doc_card mb-3">
                                        <label class="form-label mt-3 fw-bold"
                                            for="{{ $doc->document_name }}">{{ $doc->document_value }} :
                                        </label>

                                        <input type="file" class="form-control imagechange1"
                                            data-key="{{ $doc->document_name }}" id="{{ $doc->document_name }}"
                                            name="{{ $doc->document_name }}" />
                                        @component('components.ajax-error', ['field' => "$doc->document_name"])
                                        @endcomponent
                                        <div class="text-center mt-3 ">
                                            <button type="button"
                                                class="btn btn-secondary fw-bold btn_view_kyc_doc text-capitalize mt-2"
                                                onclick="readFile('{{ $doc->document_name }}')"><i
                                                    class="fa-solid fa-eye"></i> View</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
				
				
				 <div id="blockDiv" class="hide">
					<div class="" style="padding: 0px; margin: 0px; text-align: center; color: rgb(0, 0, 0); border: 3px solid rgb(170, 170, 170); width: 100%; height: 100%; position: fixed; top: 0%; background: rgb(20, 14, 51) none repeat scroll 0% 0%; opacity: 0.5; z-index: 1004; cursor: wait; right: 0px;"></div>
					<div class="blockUI blockMsg blockPage " style="padding: 0px; margin: 0px; top: 33%; color: rgb(0, 0, 0);  font-weight: normal;  font-size: 20px; left: 35%; text-align: center; z-index: 999999 ! important; position: fixed; width: 30%;"><img src="{{ asset('assets/img/loader.gif')}}" style="height:200px;"></div>
				</div>

					
		
                <div class="modal-footer text-center">
                    <button type="submit" id="upload_document"
                        class="btn btn-secondary px-5 fw-bold text-capitalize">Upload Documents</button>
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
 $('#blockDiv').hide();
    var i = 0;

    $(document).on('change', '.imagechange', function (event) {
        $('#upload_document').prop('disabled', true);
 		$('#blockDiv').show();

		
        var key = $(this).attr('data-key');

        const imageInput = document.getElementById(key);

        const selectedFile = event.target.files[0];
        if (selectedFile) {

            sendImageToAPI(selectedFile, key);
        }

    });


    function sendImageToAPI(imageFile, key) {

	


        $('.' + key).html('');
        const apiUrl = "{{ route('image.verification')}}";
        const formData = new FormData();
        formData.append('image', imageFile);
        $.ajax({
            url: apiUrl,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status != true) {
                    i++;
                    var errorsHtml = '<strong id="clear" data-id="0">Please upload clear document</strong>';
                    $('.' + key).html(errorsHtml);
                    $('#upload_document').prop('disabled', false);
					$('#blockDiv').hide();
                }else{
					if(i > 0){
						i = i -1 ;
					}
					
					 $('#upload_document').prop('disabled', false);
					$('#blockDiv').hide();
				}
				
            },
            error: function (error) {
            }
        }); 
    }

    $('.save-form').submit(function (event) {
		 var id = $('#clear').attr('data-id');
         var status = document.activeElement.innerHTML;
        event.preventDefault();
        if (status && i == 0 && id != 0) {
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
                   
                    if (result.type === 'SUCCESS') {
                        toastr.success(result.message);
                        $("#upload-kyc-model").modal('hide');
                        $('#transaction-kyc-table').DataTable().ajax.reload();
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


    $(".btn-close").click(function () {
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