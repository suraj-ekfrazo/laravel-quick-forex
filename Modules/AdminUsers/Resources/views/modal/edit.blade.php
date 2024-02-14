<div class="modal fade" id="editModalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Edit Customer</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <form action="{{url('admin-login/admin/update')}}/{{$data['id']}}" method="post" class="form form-vertical save-form" id="save-customer-form">
                    <div class="row">

                        <div class="col-md-6 col-lg-6  mt-3">
                            <label class="d-none">Name*</label>
                            <div class="input-group mb-3">
                                <input class="form-control  p-2" type="text" name="name" value="{{$data['name']}}" placeholder="Enter Name">
                                @component('components.ajax-error',['field'=>'name'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6  mt-3">
                            <label class="d-none">Mobile Number*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="{{$data['mobile_no']}}" maxlength="16" name="mobile_no" placeholder="Enter Mobile Number">
                                @component('components.ajax-error',['field'=>'mobile_no'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6  mt-3">
                            <label class="d-none">Email Id*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" type="text" name="email" placeholder="Enter Email Id" value="{{$data['email']}}">
                                @component('components.ajax-error',['field'=>'email'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6  mt-3">
                            <label class="d-none">User Name*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" type="text" name="user_name" placeholder="Enter User Name" value="{{$data['user_name']}}">
                                @component('components.ajax-error',['field'=>'user_name'])@endcomponent
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6  mt-3">
                            <label class="d-none">Password*</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2" type="password" name="password" placeholder="Enter Password">
                                @component('components.ajax-error',['field'=>'password'])@endcomponent
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
