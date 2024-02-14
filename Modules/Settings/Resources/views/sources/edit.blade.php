<div class="modal fade" id="editModalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Edit Source</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <form action="{{url('admin-login/settings/sources/update')}}/{{$data['id']}}" method="post" class="form form-vertical save-form" id="save-sources-form" enctype="multipart/form-data" files="true">
                    <div class="row mt-3">
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label class="">Source Name*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" name="source_name" type="text" placeholder="Enter Purpose Name" value="{{$data['source_name']}}">
                                @component('components.ajax-error',['field'=>'source_name'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label class="">TCS Rate %*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" name="tcs_rate" type="number" step="0.01" min="0" placeholder="Enter TCS Rate %" value="{{$data['tcs_rate']}}">
                                @component('components.ajax-error',['field'=>'tcs_rate'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label class="">Exempt*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" type="number" name="exempt" min="0" placeholder="Enter Exempt" value="{{$data['exempt']}}">
                                @component('components.ajax-error',['field'=>'exempt'])@endcomponent
                            </div>
                        </div>
                        {{--<div class="col-md-12 col-lg-12 mt-3">
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
                        </div>--}}
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
                        $('#manage-sources-table').DataTable().ajax.reload(null, false);
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


