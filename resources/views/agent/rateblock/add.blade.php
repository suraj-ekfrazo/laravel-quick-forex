<style>
    .switch-input:checked ~ .switch-label{
        background: #5379ec;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
    }
</style>
<div class="modal fade" id="create-ratebooking-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Request Rate Booking</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <form action="{{route('rate-block.save')}}" method="post" class="form form-vertical save-form" id="save-rateblock-form">
                    <div class="row mt-3">

                        <div class="col-md-12 col-lg-12  mt-4">
                            <label class="">Fx Currency*</label>
                            <select class="form-select border pb-1 bgc" id="fx_currency" name="fx_currency">
                                <option value="" selected>Select Currency</option>
                                <option value="USD/INR">USD</option>
                                <option value="CAD/INR">CAD</option>
                                <option value="AUD/INR">AUD</option>
                                <option value="JPY/INR">JPY</option>
                                <option value="CHF/INR">CHF</option>
                                <option value="AED/INR">AED</option>
                                <option value="GBP/INR">GBP</option>
                                <option value="EUR/INR">EUR</option>
                                <option value="THB/INR">THB</option>
                                <option value="SGD/INR">SGD</option>
                            </select>
                            @component('components.ajax-error',['field'=>'fx_currency'])@endcomponent
                        </div>
                        <div class="col-md-12 col-lg-12  mt-4">
                            <label class="">Fx Value*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" type="number" name="fx_value" id="fx_value" placeholder="Enter Value">
                                @component('components.ajax-error',['field'=>'fx_value'])@endcomponent
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center mt-3">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $('#save-rateblock-form').submit(function (event) {
        event.preventDefault();
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
                        //getCustomersList();
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
