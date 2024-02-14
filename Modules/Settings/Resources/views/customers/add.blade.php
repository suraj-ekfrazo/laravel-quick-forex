<div class="modal fade" id="addModalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Create Customer</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <form action="{{route('customers.save')}}" method="post" class="form form-vertical save-form" id="save-customer-form">
                    <div class="row mt-3">

                        <div class="col-md-12 col-lg-12  mt-3">
                            <label class="">Customer Name*</label>
                            <div class="input-group mb-3">
                                <input class="form-control  p-2" type="text" name="name" placeholder="Enter Customer/Agent Name">
                                @component('components.ajax-error',['field'=>'name'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12  mt-3">
                            <label class="">Mobile Number*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="16" name="mobile" placeholder="Enter Mobile Number">
                                @component('components.ajax-error',['field'=>'mobile'])@endcomponent
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer text-center mt-3">
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
                        $('.modal').modal('hide');
                        $('#manage-customers-table').DataTable().ajax.reload(null, false);
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
