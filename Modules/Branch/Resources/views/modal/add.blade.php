<div class="modal fade" id="addModalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Create Branch ID</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <form action="{{route('branch.save')}}" method="post" class="form form-vertical save-agent-form" id="save-agent-form" enctype="multipart/form-data" files="true">
                <div class="row">
                    <div class="col-md-6 col-lg-6 mt-3">
                        <label class="d-none">First Name*</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" name="first_name" type="text" placeholder="Enter First Name">
                            @component('components.ajax-error',['field'=>'first_name'])@endcomponent
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mt-3">
                        <label class="d-none">Last Name*</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="text" name="last_name" placeholder="Enter Last Name">
                            @component('components.ajax-error',['field'=>'last_name'])@endcomponent
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mt-3">
                        <label class="d-none">Email*</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" name="email" type="email" placeholder="Enter Email">
                            @component('components.ajax-error',['field'=>'email'])@endcomponent
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mt-3">
                        <label class="d-none">Mobile Number*</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="tel" name="mobile" maxlength="10" placeholder="Enter Mobile Number">
                            @component('components.ajax-error',['field'=>'mobile'])@endcomponent
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mt-3">
                        <label class="d-none">Branch Name*</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="text" name="branch_name" placeholder="Enter Branch Name">
                            @component('components.ajax-error',['field'=>'branch_name'])@endcomponent
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mt-3">
                        <label class="d-none">Password*</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="password" name="password" placeholder="Enter password">
                            @component('components.ajax-error',['field'=>'password'])@endcomponent
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
</div>
<script>
    $('.save-agent-form').submit(function (event) {
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
                        $('#agent-table').DataTable().ajax.reload(null, false);
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


