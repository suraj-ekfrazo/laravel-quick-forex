<div class="modal fade" id="editModalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Edit Purpose</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <form action="{{url('admin-login/settings/managePurposes/update')}}/{{$data['id']}}" method="post" class="form form-vertical save-form" id="save-purposes-form" enctype="multipart/form-data" files="true">
                    <div class="row mt-3">
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label class="">Purpose Name*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" name="purpose_name" type="text" placeholder="Enter Purpose Name" value="{{$data['purpose_name']}}">
                                @component('components.ajax-error',['field'=>'purpose_name'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label class="">Purpose Code*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" type="text" name="purpose_code" maxlength="7" placeholder="Enter Purpose Code" value="{{$data['purpose_code']}}">
                                @component('components.ajax-error',['field'=>'purpose_code'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label class="">TCS*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" name="tcs" type="number" step="0.01" min="0" placeholder="Enter TCS" value="{{$data['tcs']}}">
                                @component('components.ajax-error',['field'=>'tcs'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 mt-3">
                            <div class=" bgc-model m-2">
                                <div class="row ">
                                    <div class=" ">
                                        <p  class="text-color">Required Documents
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @foreach($dataDocuments as $val)
                                <div class=" bgc-model m-2">
                                    <li class=" list-unstyled m-2 ">
                                        <label for="documents-{{$val['id']}}" class="m-0">{{$val['document_name']}}</label>
                                        <input type="checkbox" class="float-end mt-1" name="documents[]" id="documents-{{$val['id']}}" value="{{$val['id']}}" {{str_contains($data['documents'], $val['id']) ? "checked":""}}>
                                    </li>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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
                        $("#editModalData").modal('hide');
                        $('#manage-purpose-table').DataTable().ajax.reload(null, false);
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

</script>


