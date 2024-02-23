<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="alert" id="alert-message" role="alert"></div>
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Forgot Your Password</h5>
                <span>Please enter the email address you used to register. We will then send you a new password.</span>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <form action="{{ route('forgot') }}" method="post" class="form form-vertical forgot-password-form" id="forgot-password-form">
                    <div class="row">
                        <div class="col-md-6 col-lg-12  mt-3">
                            <label class="d-none">Email*</label>
                            <div class="input-group mb-3">
                                <input class="form-control qf-shadow-input" type="email" name="email" placeholder="Enter Email">
                                @component('components.ajax-error',['field'=>'email'])@endcomponent
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center mt-3">
                        <button type="submit" class="btn btn-rounded">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<script>
    $('.forgot-password-form').submit(function (event) {
        var status = document.activeElement.innerHTML;
        event.preventDefault();
        console.log(status);
        if (status) {
            $('.ajax-error').html('');
            $("#alert-message").removeClass("alert-success");
            $("#alert-message").removeClass("alert-danger");
            $("#alert-message").html();
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
                        $("#alert-message").addClass("alert-success");
                        $("#alert-message").html(result.message);
                        setTimeout(function() {
                            $('#forgotPasswordModal').modal('hide');
                        }, 2000);
                    } else {
                        $("#alert-message").addClass("alert-danger");
                        $("#alert-message").html(result.message);
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
