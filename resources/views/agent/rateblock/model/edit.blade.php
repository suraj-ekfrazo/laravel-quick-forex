<div class="modal fade" id="create-dealrate-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Deal Rate Booking</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <form action="{{route('deal-rate.save')}}" method="post" class="form form-vertical save-form" id="save-rateblock-form">
                <table class="table roundedTable text-center">
                    <thead>
                        <tr class="bgc-table row-font1">
							
                            <th scope="col" class="fw-bold">Select</th>
							<th scope="col" class="fw-bold">Reference Number</th>
                            <th scope="col" class="fw-bold">FX Currency</th>
                            <th scope="col" class="fw-bold">Deal ID</th>
                            <th scope="col" class="fw-bold">FX Amount</th>
                            <th scope="col" class="fw-bold">Deal Rate</th>
                            <th scope="col" class="fw-bold">Creation Date</th>
                            <th scope="col" class="fw-bold">Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($data_count > 0)
                    @foreach($data as $val)
                        <tr>
                            <td>
                                <input type="radio" name="select_deal_rate" value="{{$val['id']}}">
                                <input type="hidden" name="fx_rate" value="{{$val['fx_rate']}}">
                            </td>
							<td>{{$val['reference_number'] ? '#'.$val['reference_number'] : ""}}</td>
                            <td>{{$val['fx_currency']}}</td>
                            <td>{{$val['deal_id']}}</td>
                            <td>{{$val['fx_value']}}</td>
                            <td>{{$val['fx_rate']}}</td>
                            <td>{{ \Carbon\Carbon::parse($val['created_at'])->format('d/m/Y') }}</td>
                            <td>{{  \Carbon\Carbon::parse($val['expiry_date'])->format('d/m/Y')}}</td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="7">No Data Found</td>
                        </tr>
                    @endif
                    </tbody>
                    <tbody>
                    </tbody>
                </table>
                <div class="col-md-12 col-lg-12  mb-5">
                    @component('components.ajax-error',['field'=>'select_deal_rate'])@endcomponent
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6 mt-4">
                        <label class="">Branch Margin*</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="number" name="branch_margin" id="branch_margin"
                                   step="0.01" placeholder="Enter Branch Margin">
                            @component('components.ajax-error',['field'=>'branch_margin'])@endcomponent
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mt-4">
                        <label class="">Agent commission</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="number" name="agent_commission" step="0.01"
                                   placeholder="Enter Agent commission">
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
                /*$(this).attr("disabled", false);*/
                if (result.type === 'SUCCESS') {
                    toastr.success(result.message);
                    $('.modal').modal('hide');                    
                    addCurrency(result.data);
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
