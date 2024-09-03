<div class="modal fade" id="editModalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Edit Rate Margin</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <form action="{{url('admin-login/ratemargin/update')}}/{{$data['id']}}" method="post" class="form form-vertical save-form" id="save-ratemargin-form" enctype="multipart/form-data" files="true">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label>Currency Name*</label>
                            <div class="input-group mb-3">
                                <input class="form-control qf-shadow-input" name="currency_name" type="text" placeholder="Enter Currency Name" value="{{$data['currency_name']}}">
                                @component('components.ajax-error',['field'=>'currency_name'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label>Sell Margin 10-12*</label>
                            <div class="input-group mb-3">
                                <input class="form-control qf-shadow-input" name="sell_margin_10_12" type="number" step="0.01" min="0" placeholder="Sell Margin 10-12" value="{{$data['sell_margin_10_12']}}">
                                @component('components.ajax-error',['field'=>'sell_margin_10_12'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label>Sell Margin 12-2*</label>
                            <div class="input-group mb-3">
                                <input class="form-control qf-shadow-input" name="sell_margin_12_2" type="number" step="0.01" min="0" placeholder="Sell Margin 12-2" value="{{$data['sell_margin_12_2']}}">
                                @component('components.ajax-error',['field'=>'sell_margin_12_2'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label>Sell Margin 2-3:30*</label>
                            <div class="input-group mb-3">
                                <input class="form-control qf-shadow-input" name="sell_margin_2_3_30" type="number" step="0.01" min="0" placeholder="Sell Margin 2-3:30" value="{{$data['sell_margin_2_3_30']}}">
                                @component('components.ajax-error',['field'=>'sell_margin_2_3_30'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label>Sell Margin 3:30 End*</label>
                            <div class="input-group mb-3">
                                <input class="form-control qf-shadow-input" name="sell_margin_3_30_end" type="number" step="0.01" min="0" placeholder="Sell Margin 3:30 End" value="{{$data['sell_margin_3_30_end']}}">
                                @component('components.ajax-error',['field'=>'sell_margin_3_30_end'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mt-3">
                            <label>Holiday Margin*</label>
                            <div class="input-group mb-3">
                                <input class="form-control qf-shadow-input" name="holiday_margin" type="number" step="0.01" min="0" placeholder="Holiday Margin" value="{{$data['holiday_margin']}}">
                                @component('components.ajax-error',['field'=>'holiday_margin'])@endcomponent
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


