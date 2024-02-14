@extends('layouts.app')
@section('content')
    <div>
        <form action="{{route('profile.save')}}" method="post" class="save-profile-form">
            @csrf
            <div class="bgc">
                <div class="justify-content-between pt-4 pb-3">
                    <div class="me-5 text-center  ">
                        {{--<div type="button" class="btn-sm btn-secondary float-end" onclick="openCustomerModel();">
                            <div class="  me-3 ms-3"><i class="fa-solid fa-plus"></i> Create Customer</div>
                        </div>--}}
                    </div>
                </div>

                <div class="d-flex justify-content-between pt-4 pb-3">
                    <div class="d-flex">
                        <div class="   border-heading"></div>
                        <div class="ps-1 fw-bold">Profile</div>
                    </div>
                </div>
                <div class="row mt-3">

                    <div class="col-md-4 col-lg-6 mt-1">
                        <label class="">First Name</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="text" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ $data['first_name'] }}">
                            @component('components.ajax-error',['field'=>'first_name'])@endcomponent
                        </div>

                    </div>

                    <div class="col-md-4 col-lg-6 mt-1">
                        <label class="">Last Name</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="text" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ $data['last_name'] }}">
                            @component('components.ajax-error',['field'=>'last_name'])@endcomponent
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-6 mt-1">
                        <label class="">Email</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="text" name="email" id="email" placeholder="Enter Email Address" value="{{ $data['email'] }}">
                            @component('components.ajax-error',['field'=>'email'])@endcomponent
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-6 mt-1">
                        <label class="">Mobile</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" value="{{ $data['mobile'] }}">
                            @component('components.ajax-error',['field'=>'mobile'])@endcomponent
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-6 mt-1">
                        <label class="">Branch Name</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="text" name="branch_name" id="branch_name" placeholder="Enter Branch Name" value="{{ $data['branch_name'] }}">
                            @component('components.ajax-error',['field'=>'branch_name'])@endcomponent
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-6 mt-1">
                        <label class="">Password</label>
                        <div class="input-group mb-3">
                            <input class="form-control p-2" type="password" name="password" id="password" placeholder="Enter Password">
                            @component('components.ajax-error',['field'=>'password'])@endcomponent
                        </div>
                    </div>

                </div>

            </div>
            <div class="bgc pb-5">
                <div class=" pb-4">
                    <div class="me-5 mb-5 text-center float-end  ">
                        <button type="button" class="btn-sm btn-secondary">
                            <div class=" text-capitalize me-3 ms-3" onclick="history.go(-1)">Back</div>
                        </button>
                    </div>
                    <div class="me-5 mb-5 text-center float-end">
                        <button type="submit" class="btn-sm btn-secondary">
                            <div class=" text-capitalize me-3 ms-3">Update</div>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('pagescript')
    <script>
        $('#date_time_div').hide();
    </script>
    @include('stacks.js.front.dashboard.profile')
@endpush
