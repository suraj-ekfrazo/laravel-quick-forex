<div class="modal fade" id="addModalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Add Currency</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <form action="{{route('currencyrate.save')}}" method="post" class="form form-vertical save-form" id="save-currencyrate-form" enctype="multipart/form-data" files="true">
                <div class="row">
                    <div class="col-md-6 col-lg-6 mt-3">
                        <label>Currency Name*</label>
                        <div class="input-group mb-3">
                            <input class="form-control qf-shadow-input" name="currency_name" type="text" placeholder="Enter Currency Name">
                            @component('components.ajax-error',['field'=>'currency_name'])@endcomponent
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mt-3">
                        <label>Status*</label>
                        <div class="input-group mb-3">
                            <select class="form-control qf-shadow-select" id="status" name="status">
                                <option value="" selected>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>
                            </select>
                        </div>
                        @component('components.ajax-error',['field'=>'status'])@endcomponent
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-rounded">Submit</button>
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
                        $("#addModalData").modal('hide');
                        $('#manage-currencyrate-table').DataTable().ajax.reload(null, false);
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


