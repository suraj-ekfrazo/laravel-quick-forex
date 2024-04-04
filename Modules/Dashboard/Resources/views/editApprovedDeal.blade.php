<div class="modal fade" id="edit-approved-deal-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Update Approved Deal</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <form action="{{route('approvedDeal.update')}}" method="post" class="form form-vertical save-form" id="save-edit-approved-deal-form">
                    <table class="table roundedTable text-center">
                        <thead>
                            <tr class="bgc-table row-font1">
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
                            <tr>
                                <td>{{$data->reference_number ? '#'.$data->reference_number : ""}}</td>
                                <td>{{$data->fx_currency}}</td>
                                <td>{{$data->deal_id}}</td>
                                <td>{{$data->fx_value}}</td>
                                <td>{{$data->fx_rate}}</td>
                                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</td>
                                <td>{{  \Carbon\Carbon::parse($data->expiry_date)->format('d/m/Y')}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 mt-4">
                            <label class="">Deal FX Rate*</label>
                            <div class="input-group mb-3">
                                <input class="form-control qf-shadow-input" type="number" name="fx_rate" id="fx_rate"
                                    step="0.0001" placeholder="Enter Deal Rate">
                                @component('components.ajax-error',['field'=>'fx_rate'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 mt-4">
                            <label class="">Deal ID*</label>
                            <div class="input-group mb-3">
                                <input class="form-control qf-shadow-input" type="number" name="deal_id" id="deal_id"
                                    placeholder="Enter Deal ID">
                                @component('components.ajax-error',['field'=>'deal_id'])@endcomponent
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center mt-3">
                        <input type="hidden" value="{{ $data->id }}" name="id">
                        <input type="submit" class="btn qf-primary-btn">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $('#save-edit-approved-deal-form').submit(function (event) {
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
                    $('#approved-deal-table').DataTable().ajax.reload(null, false);
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
</script>
