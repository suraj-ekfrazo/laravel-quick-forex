<div class="modal fade" id="addModalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Add Purpose</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <form action="{{route('purpose.save')}}" method="post" class="form form-vertical save-form" id="save-agent-form" enctype="multipart/form-data" files="true">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label class="d-none">Purpose Name*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" name="purpose_name" type="text" placeholder="Enter Purpose Name">
                                @component('components.ajax-error',['field'=>'purpose_name'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label class="d-none">Purpose Code*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" type="text" name="purpose_code" maxlength="7" placeholder="Enter Purpose Code">
                                @component('components.ajax-error',['field'=>'purpose_code'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 mt-3">
                            <div class=" bgc-model m-2" style="background:transparent;">
                                <div class="row ">
                                    <div class=" ">
                                        <p class="fw-bold text-dark">Required Documents</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php $checkedArr = ['other','a2form','pan_card'] ?>
                                @foreach($dataDocuments as $val)
                                    <div class="col-md-6">
                                        <div class=" bgc-model m-2">
                                            <li class=" list-unstyled m-2 ">
                                                <label for="documents-{{$val['id']}}" class="m-0">{{$val['document_value']}}</label>
                                                <input type="checkbox" class="float-end mt-1 larger" name="documents[]" id="documents-{{$val['id']}}" value="{{$val['id']}}" <?= in_array($val['document_name'],$checkedArr) ? "checked":""?>>
                                            </li>
                                        </div>
                                    </div>
                                @endforeach
                                    <div class="col-md-12 mb-3 ml-2">
                                        @component('components.ajax-error',['field'=>'documents'])@endcomponent
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-rounded">Submit</button>
                </div>
            </form>
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
                        $("#addModalData").modal('hide');
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


