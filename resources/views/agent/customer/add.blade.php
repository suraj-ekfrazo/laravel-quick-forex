<style>
    .switch-input:checked ~ .switch-label{
        background: #5379ec;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
    }
</style>
<div class="modal fade" id="create-customer-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Create Customer</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body pt-0">
                <form action="{{route('customer.save')}}" method="post" class="form form-vertical save-form" id="save-customer-form">
                    <div class="row mt-0">

                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 mt-3">
                            <label class="">Customer Name*</label>
                            <div class="input-group inputWithIcon mb-3">
                                <input class="form-control  p-2" type="text" name="name" placeholder="Enter Customer/Agent Name">
								<img src="./assets/img/dashboard/svg/icon_user.svg" class="mb-2 mt-1 me-2 " alt="">
                                @component('components.ajax-error',['field'=>'name'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12  col-xs-12 mt-3">
                            <label class="">Mobile Number*</label>
                            <div class="input-group inputWithIcon mb-3">
                                <input class="form-control p-2" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="16" name="mobile" placeholder="Enter Mobile Number">
								<img src="./assets/img/dashboard/svg/icon_phone.svg" class="mb-2 mt-1 me-2 " alt="">
                                @component('components.ajax-error',['field'=>'mobile'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6  mt-3">
                            <label class="">OTP Required*</label>
                            <div class="input-group mt-2">
                                {{--<input type="hidden" name="is_otp" id="is_otp" value="0">
                                <a class="btn btn-default fw-bold" onclick="$('#is_otp').val(1)">Yes</a>
                                <a class="btn btn-primary active fw-bold" onclick="$('#is_otp').val(0)">No</a>--}}
                                <label class="switch">
                                    <input type="checkbox" class="switch-input" name="is_otp" value="1">
                                    <!--<i class="icon-play"></i>-->
                                    <span class="switch-label" data-on="Yes" data-off="No"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div>
                        </div>
						<div class="col-md-6 col-lg-6 mt-3">
							<button type="submit" class="btn btn-primary float-end mt-4">Submit</button></div>
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
                        getCustomersList();
                        $('.modal').modal('hide');
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

    function getCustomersList(){
        console.log("getCustomersList===");
        $.ajax({
            url: "{!! route('customers.get') !!}",
            type: 'GET',
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                /*return result.data;*/
                console.log(result.data);
                $("#single-select-field").empty();
                $("#single-select-field").append("<option></option>");
                var data = [result.data];
                $.each(result.data, function (key, value) {
                    $("#single-select-field").append("<option value='" + value.id + "' data-custname='" + value.name + "'>" + value.mobile + "</option>");
                });
            }
        });
    }
</script>
