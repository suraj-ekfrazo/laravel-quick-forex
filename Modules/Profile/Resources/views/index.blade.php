@extends('layouts.admin')

@section('content')
    <!-- <div class="w-100 bg-cover flickity-cell is-selected" style="background: url(../assets/img/heading.png) center center/cover no-repeat   #ccc; ;  ">
        <div class="bg-dark-20">
            <div class=" container  justify-content-between">
                <div class=" " style="min-height: 150px;">
                    <div class="d-flex pt-5">
                        <a href="{{url('/')}}" class=" d-flex align-items-center text-white D-icon text-decoration-none"  >
                            <i class="fa-solid fa-house ms-2 me-2"></i>
                            <p class="d-none d-md-block">Go To Dashboard</p>
                        </a>
                        <div class="text-light text-center" style="font-size :24px; flex: 0.8; font-weight: 600;">Profile</div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-6 mx-auto">
        <form action="{{url('admin-login/profile/update')}}/{{Auth::user()->id}}" method="post" class="form form-vertical save-form" id="save-customer-form">
            <div class="row mt-3">

                <div class="col-md-6 col-lg-6  mt-3">
                    <label class="">Name*</label>
                    <div class="input-group mb-3">
                        <input class="form-control p-2 profile-edit-input" type="text" name="name" value="{{$data['name']}}" placeholder="Enter Name">
                        @component('components.ajax-error',['field'=>'name'])@endcomponent
                    </div>
                </div>
                <div class="col-md-6 col-lg-6  mt-3">
                    <label class="">Mobile Number*</label>
                    <div class="input-group mb-3">
                        <input class="form-control p-2 profile-edit-input" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="{{$data['mobile_no']}}" maxlength="16" name="mobile_no" placeholder="Enter Mobile Number">
                        @component('components.ajax-error',['field'=>'mobile_no'])@endcomponent
                    </div>
                </div>
                <div class="col-md-6 col-lg-6  mt-3">
                    <label class="">Email Id*</label>
                    <div class="input-group mb-3">
                        <input class="form-control p-2 profile-edit-input" type="text" name="email" placeholder="Enter Email Id" value="{{$data['email']}}">
                        @component('components.ajax-error',['field'=>'email'])@endcomponent
                    </div>
                </div>
                <div class="col-md-6 col-lg-6  mt-3">
                    <label class="">User Name*</label>
                    <div class="input-group mb-3">
                        <input class="form-control p-2 profile-edit-input" type="text" name="user_name" placeholder="Enter User Name" value="{{$data['user_name']}}">
                        @component('components.ajax-error',['field'=>'user_name'])@endcomponent
                    </div>
                </div>
                <div class="col-md-6 col-lg-6  mt-3">
                    <label class="">Password</label>
                    <div class="input-group mb-3">
                        <input class="form-control p-2 profile-edit-input" type="password" name="password" placeholder="Enter Password">
                        @component('components.ajax-error',['field'=>'password'])@endcomponent
                    </div>
                </div>
                <div class="col-md-6 col-lg-6  mt-3">
                    <label class="">Confirm Password</label>
                    <div class="input-group mb-3">
                        <input class="form-control p-2 profile-edit-input" type="password" name="confirm_password" placeholder="Enter Confirm Password">
                        @component('components.ajax-error',['field'=>'confirm_password'])@endcomponent
                    </div>
                </div>

            </div>
            <div class="modal-footer text-center mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
@push('pagescript')
    @include('stacks.js.modules.profile.index')
@endpush
