@extends('layouts.app')
<style>
    .select2 {
        width: 100%;
    }

    .nostro_charge {
        text-align: left;
        padding-left: 130px;
    }
</style>
@section('content')
<!-- Tabs -->
<div class="">
    <ul class="nav nav-tabs nav-justified" id="ex1" role="tablist">

        <li class="nav-item tab4" role="presentation">
            <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 active" id="ex3-tab-4" data-mdb-toggle="tab"
                href="#ex3-tabs-4" role="tab" aria-controls="ex3-tabs-4" aria-selected="false">
                <div class="d-flex gap-2 justify-content-center align-items-center">
                    <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap">
                        <div class="text-center nav-title">Rate Booking</div>
                    </div>
                </div>
            </a>
        </li>

        <li class="nav-item tab6" role="presentation">
            <a class="nav-link fw-bold text-light mt-3 ms-3 me-3" id="ex3-tab-6" data-mdb-toggle="tab"
                href="#ex3-tabs-6" role="tab" aria-controls="ex3-tabs-6" aria-selected="false">
                <div class="d-flex gap-2 justify-content-center align-items-center">
                    <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap">
                        <div class="text-center nav-title"> Approved Deals
                            <span class="badge rounded-pill badge-notification bg-danger" id="approved-deal-table-count">0</span>
                        </div>                    
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item tab1" role="presentation">
            <a class="nav-link fw-bold text-light mt-3 ms-3 me-3" id="ex3-tab-1" data-mdb-toggle="tab"
                href="#ex3-tabs-1" role="tab" aria-controls="ex3-tabs-1" aria-selected="true">
                <div class="d-flex gap-2 justify-content-center align-items-center">
                    <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap">
                        <div class="text-center nav-title"> Create Transaction</div>
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item tab3" role="presentation">
            <a class="nav-link fw-bold text-light mt-3 ms-3 me-3" id="ex3-tab-3" data-mdb-toggle="tab"
                href="#ex3-tabs-3" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                <div class="d-flex gap-2 justify-content-center align-items-center">
                    <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap">
                        <div class="text-center nav-title"> KYC 
                            <span class="badge rounded-pill badge-notification bg-danger" id="transaction-kyc-table-count">0</span>
                        </div>
                    </div>
                </div>
            </a>

        </li>
        <li class="nav-item tab5" role="presentation">
            <a class="nav-link fw-bold text-light mt-3 ms-3 me-3" id="ex3-tab-5" data-mdb-toggle="tab"
                href="#ex3-tabs-5" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                <div class="d-flex gap-2 justify-content-center align-items-center">
                    <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap">
                        <div class="text-center nav-title">  Payments 
                            <span class="badge rounded-pill badge-notification bg-danger" id="agent-payment-table-count">0</span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <!--<li class="nav-item tab6" role="presentation">
                <a class="nav-link fw-bold text-light mt-3 ms-3 me-3" id="ex3-tab-6" data-mdb-toggle="tab"
                   href="#ex3-tabs-6" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                    <div class="d-flex gap-2 justify-content-center align-items-center">
                        <div class="text-center"> Completed <br> Bookings</div>
                    </div>
                </a>
            </li>-->
        <li class="nav-item tab2" role="presentation">
            <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 " id="ex3-tab-2" data-mdb-toggle="tab"
                href="#ex3-tabs-2" role="tab" aria-controls="ex3-tabs-2" aria-selected="false">
                <div class="d-flex gap-2 justify-content-center align-items-center">
                    <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap">
                        <div class="text-center nav-title"> View All Transaction 
                            <span class="badge rounded-pill badge-notification bg-danger" id="admin-transaction-table-count">0</span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
    </ul>
</div>
<!-- Tabs navs -->
<!-- Tabs content -->
<div class="tab-content agent-transaction-main" id="ex3-content">
    <div class="tab-pane fade" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">
        <form action="{{route('transaction.save')}}" method="post" class="save-incidents-form" enctype="multipart/form-data" files="true">
            <div class="main-wrapper">
                <!-- <div class="create-btn-wrap">
                    <div class="text-center  ">
                        <div type="button" class="qf-primary-btn new_btn_add_customer"
                            onclick="openCustomerModel();">
                            <div class="  me-3 ms-3"><i class="fa-solid fa-plus"></i> Create Customer</div>
                        </div>
                    </div>
                </div> -->
                <!-- collapsable start -->
                <div id="accordion" class="agent-detail-accordion">
                    <div class="card agent-detail-card" >
                        <div class="card-header" id="headingOne" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span class="accordion-title">
                                Customer Detail
                            </span>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">
                                <div class="card-inner-wrapper">
                            
                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3 inputWithIcon">
                                            <input onkeypress="return isOnlyAlphaKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="pan_card_name"
                                                id="pan_card_name" placeholder="Enter Pan Card Name">
                                            <img src="./assets/img/dashboard/svg/icon_user.svg" class="mb-2 mt-1 me-2 "
                                                alt="">

                                            @component('components.ajax-error',['field'=>'pan_card_name'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3 inputWithIcon">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" maxlength="10"
                                                name="valid_pancard_no" id="valid_pancard_no" placeholder="Enter Pan Card Number">
                                            <img src="./assets/img/dashboard/svg/icon_numbers.svg"
                                                class="mb-2 mt-1 me-2 " alt="">

                                            @component('components.ajax-error',['field'=>'valid_pancard_no'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <button type="button" class="qf-primary-btn" id="validate-pan-details">
                                            <span class="text-capitalize">Validate Pan Details</span>
                                        </button>
                                    </div>
                                </div>
                                <span class="verified-pan-success" style="display:none; color: #169d5e; font-size:17px">
                                    <strong>Pan details has verified successfully.</strong>
                                </span>
                                <div class="card-inner-wrapper" style="padding-top: 25px;">   
                                    <div class="qf-select-wrap">

                                        <input onkeypress="return isSpecialKey(event)"
                                            class="form-control qf-secondary-input" type="text"
                                            name="customer_mobile"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                            id="customer_mobile" placeholder="Enter Mobile Number"/>

                                        @component('components.ajax-error',['field'=>'customer_mobile'])@endcomponent

                                        <ul class="qf-num-list" id="optionList"></ul>
                                        <input type="hidden"name="customer_id" id="customer_id">

                                        <!-- <select class="form-select qf-primary-select" name="customer_id"
                                            id="single-select-field" data-placeholder="Choose one Customer Number">
                                            <option></option>
                                            @foreach($customers as $val)
                                            <option value="{{$val['id']}}" data-custname="{{$val['name']}}">
                                                {{$val['mobile']}}</option>
                                            @endforeach
                                        </select>
                                        @component('components.ajax-error',['field'=>'customer_id'])@endcomponent -->
                                    </div>
                                    
                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text"
                                                name="customer_reference" id="customer_reference"
                                                placeholder="Enter Customer Reference">
                                            @component('components.ajax-error',['field'=>'customer_reference'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input"
                                                onkeypress="return isSpecialKey(event)" type="text" name="dd_number"
                                                id="dd_number" placeholder="Enter DD Number">
                                            @component('components.ajax-error',['field'=>'dd_number'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text"
                                                name="forward_booking_ref" id="forward_booking_ref"
                                                placeholder="Enter Forward Booking Ref.">
                                            @component('components.ajax-error',['field'=>'forward_booking_ref'])@endcomponent
                                        </div>
                                    </div>

                                    {{--<div class="col-md-4 col-lg-3  mt-3">
                                        <label class="">Mobile Number*</label>
                                        <div class="input-group mb-3">

                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text"
                                                name="customer_mobile"
                                                oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                                id="customer_mobile" placeholder="Enter Mobile Number" readonly>
                                            @component('components.ajax-error',['field'=>'customer_mobile'])@endcomponent
                                        </div>
                                    </div>--}}

                                </div>
                                <span class="validate-pan-restriction" style="color: #ff2929; font-size:17px">
                                    <strong>Please validate pan details to processed further steps</strong>
                                </span>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo" type="button" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <span class="accordion-title">
                                Transaction Detail
                            </span>
                        </div>
                        <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="card-inner-wrapper">
                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3">
                                            <select class="form-select qf-primary-select" name="txn_type"
                                                id="txn_type_detail">
                                                <option value="">Select Transaction Type</option>
                                                <option value="1" selected>Remittance</option>
                                                {{--<option value="Card">Card</option>--}}
                                            </select>
                                            @component('components.ajax-error',['field'=>'txn_type'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3">
                                            <select class="form-select qf-primary-select" name="booking_purpose_id"
                                                id="booking_purpose_id">
                                                <option value="" selected>Select Purpose</option>
                                                @foreach($purposes as $val)
                                                <option value="{{$val['id']}}">{{$val['purpose_name']}}</option>
                                                @endforeach
                                            </select>
                                            @component('components.ajax-error',['field'=>'booking_purpose_id'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3">
                                            <select class="form-select qf-primary-select" name="fund_source_id"
                                                id="fund_source_id">
                                                <option value="" selected>Select Source of Fund</option>
                                                @foreach($sources as $val)
                                                <option value="{{$val['id']}}" tcs-rate="{{$val['tcs_rate']}}"
                                                    tcs-exempt="{{$val['exempt']}}"> {{$val['source_name']}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @component('components.ajax-error',['field'=>'fund_source_id'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3 inputWithIcon">

                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="agent_code"
                                                id="agent_code" placeholder="Enter Code">
                                            <img src="./assets/img/dashboard/svg/icon_numbers.svg"
                                                class="mb-2 mt-1 me-2 " alt="">
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3 inputWithIcon">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="agent_name"
                                                id="agent_name" placeholder="Enter Agent Name">
                                            <img src="./assets/img/dashboard/svg/icon_user.svg" class="mb-2 mt-1 me-2 "
                                                alt="">
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3">
                                            <select class="form-select qf-primary-select" name="nostro_charge_type"
                                                id="nostro_charge_type">
                                                <option value="" selected>Select Nostro Charges</option>
                                                <option value="OUR">OUR</option>
                                                <option value="SHA">SHA</option>
                                            </select>
                                            @component('components.ajax-error',['field'=>'nostro_charge_type'])@endcomponent
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSix" type="button" data-toggle="collapse"
                            data-target="#collapseSix" aria-expanded="true" aria-controls="collapseTwo">
                            <span class="accordion-title">
                                LRS Detail
                            </span>
                        </div>
                        <div id="collapseSix" class="collapse " aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body">
                                <div class="card-inner-wrapper">
                                    <div class="qf-select-wrap">
                                        <label class="">LSR Document Sheet</label>
                                        <div class="input-group mb-3">
                                            <input class="form-control qf-file-upload" type="file" name="lrs_sheet_document" id="lrs_sheet_document">
                                            @component('components.ajax-error',['field'=>'lrs_sheet_document'])@endcomponent
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree" type="button" data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            <span class="accordion-title">
                                Remitter Detail
                            </span>
                        </div>

                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                <div class="card-inner-wrapper">
                                    <div class="qf-select-wrap">
                                        <label class="">Remitter PAN Card*</label>
                                        <div class="input-group mb-3 inputWithIcon">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" maxlength="10"
                                                name="pancard_no" id="pancard_no" placeholder="Enter Pan Card Number" readonly>
                                            <img src="./assets/img/dashboard/svg/icon_numbers.svg"
                                                class="mb-2 mt-1 me-2 " alt="">

                                            @component('components.ajax-error',['field'=>'pancard_no'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <label class="">Remitter PAN Name*</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="pancard_name"
                                                id="pancard_name" placeholder="Enter PAN Name" readonly>
                                            @component('components.ajax-error',['field'=>'pancard_name'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <label class="">Remitter PAN Relation*</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="pancard_relation"
                                                id="pancard_relation" placeholder="Enter PAN Relation">
                                            @component('components.ajax-error',['field'=>'pancard_relation'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <label class="">Remitter Aadhaar Card*</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="aadhaarcard_no"
                                                id="aadhaarcard_no" placeholder="Enter Aadhaar Card Number">
                                            @component('components.ajax-error',['field'=>'aadhaarcard_no'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <label class="">Pan Aadhaar Link Status*</label>
                                        <div class="input-group mb-3">
                                            <input type="checkbox" class="float-end mt-1 larger" name="pan_aadhaar_link_status" id="pan_aadhaar_link_status" style="pointer-events: none;">
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <label class="">Remitter Address</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="remitter_address"
                                                id="remitter_address" placeholder="Enter Remitter Address">
                                            @component('components.ajax-error',['field'=>'remitter_address'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <label class="">Remitter City</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="remitter_city"
                                                id="remitter_city" placeholder="Enter Remitter City">
                                            @component('components.ajax-error',['field'=>'remitter_city'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Remitter Country</label>
                                        <div class="input-group mb-3">
                                            {{--<select class="form-select qf-primary-select" name="remitter_country"
                                                id="remitter_country">
                                                <option value="">Select Remitter Country</option>
                                                @foreach ($countries as $country)
                                                <option {{ $country['code']=='IN' ? 'selected' : '' }}
                                                    value="{{ filter_var($country['name'])}}">{{
                                                    ucfirst($country['name'])}}</option>
                                                @endforeach
                                            </select>--}}
                                            <input class="form-control qf-secondary-input" type="text" name="remitter_country"
                                                id="remitter_country" placeholder="Enter Remitter Country" value="India" readonly>
                                            @component('components.ajax-error',['field'=>'remitter_country'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Remitter Email</label>
                                        <div class="input-group mb-3">
                                            <input class="form-control qf-secondary-input" type="text" name="remitter_email"
                                                id="remitter_email" placeholder="Enter Remitter Email">
                                            @component('components.ajax-error',['field'=>'remitter_email'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Remitter Mobile</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="remitter_mobile"
                                                id="remitter_mobile" placeholder="Enter Remitter Mobile">
                                            @component('components.ajax-error',['field'=>'remitter_mobile'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <label class="">Remitter Passport File Number</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="passport_file_number"
                                                id="passport_file_number" placeholder="Enter Passport File Number">
                                            @component('components.ajax-error',['field'=>'passport_file_number'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <label class="">Remitter Passport Holder Name</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="passport_holder_name"
                                                id="passport_holder_name" placeholder="Enter Passport File Number">
                                            @component('components.ajax-error',['field'=>'passport_holder_name'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <label class="">Remitter Passport Holder DOB</label>
                                        <div class="input-group mb-3">
                                        <input class="form-control qf-secondary-input" type="date" name="passport_holder_dob"
                                        onkeypress="return isSpecialKey(event)" id="passport_holder_dob" placeholder="Enter Passport Holder DOB">
                                            @component('components.ajax-error',['field'=>'passport_holder_dob'])@endcomponent
                                        </div>
                                    </div>
                                    <input type="hidden"  name="passport_detail_verification" id="passport_detail_verification" />
                                    <div class="qf-select-wrap">
                                        <div class="input-group mb-3" style="padding-top:25px">
                                            <button type="button" class="qf-primary-btn" id="verify-passport-no">
                                                <span class="text-capitalize">Verify Passport No</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour" type="button" data-toggle="collapse"
                            data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            <span class="accordion-title">
                                Beneficiary Detail
                            </span>
                        </div>

                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">

                                <div class="card-inner-wrapper">
                                    <div class="qf-select-wrap">
                                        <label class="">Beneficiary Name*</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text"
                                                name="beneficiary_name" id="beneficiary_name"
                                                placeholder="Enter Beneficiary Name">
                                            @component('components.ajax-error',['field'=>'beneficiary_name'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <label class="">Beneficiary Address*</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text"
                                                name="beneficiary_address" id="beneficiary_address"
                                                placeholder="Enter Beneficiary Address">
                                            @component('components.ajax-error',['field'=>'beneficiary_address'])@endcomponent
                                        </div>
                                    </div>
                                    <div class="qf-select-wrap">
                                        <label class="">Beneficiary City*</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="beneficiary_city"
                                                id="beneficiary_city" placeholder="Enter Beneficiary City">
                                            @component('components.ajax-error',['field'=>'beneficiary_city'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Beneficiary Country*</label>
                                        <div class="input-group mb-3">
                                            <select class="form-select qf-primary-select" name="beneficiary_country"
                                                id="beneficiary_country">
                                                <option value="">Select Beneficiary Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ filter_var($country['code'])}}">{{
                                                        ucfirst($country['name'])}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @component('components.ajax-error',['field'=>'beneficiary_country'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Beneficiary Ac Number / IBAN Code*</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text"
                                                name="beneficiary_ac_number" id="beneficiary_ac_number"
                                                placeholder="Enter Beneficiary Ac Number / IBAN Code">
                                            @component('components.ajax-error',['field'=>'beneficiary_ac_number'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Beneficiary Bank Name*</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text"
                                                name="beneficiary_bank_name" id="beneficiary_bank_name"
                                                placeholder="Enter Beneficiary Bank Name">
                                            @component('components.ajax-error',['field'=>'beneficiary_bank_name'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Beneficiary Bank Address*</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text"
                                                name="beneficiary_bank_address" id="beneficiary_bank_address"
                                                placeholder="Enter Beneficiary Bank Addess">
                                            @component('components.ajax-error',['field'=>'beneficiary_bank_address'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Beneficiary Bank SORT/BSB/ABA...*</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text"
                                                name="beneficiary_bank_sort" id="beneficiary_bank_sort"
                                                placeholder="Enter Beneficiary Bank SORT/BSB/ABA...">
                                            @component('components.ajax-error',['field'=>'beneficiary_bank_sort'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Beneficiary Swift Code*</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text"
                                                name="beneficiary_swift_code" id="beneficiary_swift_code"
                                                placeholder="Enter Beneficiary Swift Code">
                                            @component('components.ajax-error',['field'=>'beneficiary_swift_code'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Sub Purpose Code</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="sub_purpose_code"
                                                id="sub_purpose_code" placeholder="Enter Sub Purpose Code">
                                            @component('components.ajax-error',['field'=>'sub_purpose_code'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Additional Details (For Education/Tour Etc)</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="additional_detail"
                                                id="additional_detail" placeholder="Enter Additional Detail">
                                            @component('components.ajax-error',['field'=>'additional_detail'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">FB Charges</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="fb_charges"
                                                id="fb_charges" placeholder="Enter FB Charges">
                                            @component('components.ajax-error',['field'=>'fb_charges'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Interm Bank Name</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="interm_bank_name"
                                                id="interm_bank_name" placeholder="Enter Interm Bank Name">
                                            @component('components.ajax-error',['field'=>'interm_bank_name'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Interm Address</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="interm_address"
                                                id="interm_address" placeholder="Enter Interm Address">
                                            @component('components.ajax-error',['field'=>'interm_address'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Interm BIC Code</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="interm_bic_code"
                                                id="interm_bic_code" placeholder="Enter Interm BIC Code">
                                            @component('components.ajax-error',['field'=>'interm_bic_code'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Interm Bank SORT/BSB/ABA/TRANSIT...</label>
                                        <div class="input-group mb-3">
                                            <input onkeypress="return isSpecialKey(event)"
                                                class="form-control qf-secondary-input" type="text" name="interm_bank_sort"
                                                id="interm_bank_sort"
                                                placeholder="Enter Interm Bank SORT/BSB/ABA/TRANSIT...">
                                            @component('components.ajax-error',['field'=>'interm_bank_sort'])@endcomponent
                                        </div>
                                    </div>

                                    <div class="qf-select-wrap">
                                        <label class="">Individual/Entity/Corporate</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control qf-secondary-input" name="individual_entity_corporate"
                                                id="individual_entity_corporate">
                                                <option value="individual">Individual</option>
                                                <option value="entity">Entity</option>
                                                <option value="corporate">Corporate</option>
                                            </select>
                                            @component('components.ajax-error',['field'=>'individual_entity_corporate'])@endcomponent
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive" type="button" data-toggle="collapse"
                            data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                            <span class="accordion-title">
                                Currency Details
                            </span>
                        </div>

                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body">
                              <div class="card-inner-wrapper">
                                <div class="qf-select-wrap">
                                    <div class="input-group mb-3">
                                        <!-- <label class="input-group-text border-0 border-bottom " for="inputGroupSelect01"><img src="../assets/svg/6.svg">
                                            </label>-->
                                        <select class="form-control qf-secondary-input" id="currencyType">
                                            <option value="" selected>Select Currency</option>
                                            <option value="USD">USD</option>
                                            <option value="CAD">CAD</option>
                                            <option value="AUD">AUD</option>
                                            <option value="JPY">JPY</option>
                                            <option value="CHF">CHF</option>
                                            <option value="AED">AED</option>
                                            <option value="GBP">GBP</option>
                                            <option value="EUR">EUR</option>
                                            <option value="THB">THB</option>
                                            <option value="SGD">SGD</option>
                                            <option value="NZD">NZD</option>
                                            <option value="SAR">SAR</option>
                                            <option value="ZAR">ZAR</option>
                                            <option value="SEK">SEK</option>
                                            <option value="NOK">NOK</option>
                                            <option value="DKK">DKK</option>
                                            <option value="HKD">HKD</option>
                                        </select>
                                        @component('components.ajax-error',['field'=>'currency'])@endcomponent
                                    </div>
                                </div>
                                <div class="qf-select-wrap">
                                    <div class="input-group mb-3 inputWithIcon">
                                        <input onkeypress="return isSpecialKey(event)"
                                            class="form-control qf-secondary-input bgc" name="amount" id="amount"
                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" type="text"
                                            onkeyup="return calculateInr();" placeholder="Enter Amount">
                                        <img src="./assets/img/dashboard/svg/icon_value.svg" class="mb-2 mt-1 me-2 "
                                            alt="">

                                        <span class="text-danger" id="amountError"></span>
                                    </div>
                                </div>
                                <div class="qf-select-wrap">

                                    <div class="ms-auto  text-center" >
                                        <button type="button" class="btn qf-primary-btn btn-block" id="selectDealRateBtn"
                                            onclick="return selectDealRate($('#amount').val(),$('#currencyType').val(),$('#booking_purpose_id').val(),$('#txn_type_detail').val());"
                                            disabled>
                                            <span class=" text-capitalize">Select Deal Rate</span>
                                        </button>
                                        {{--<input onkeypress="return isSpecialKey(event)"
                                            class="form-control qf-secondary-input bgc" id="bookingRate"
                                            onkeyup="return calculateInr();" type="number" min="0" step="0.01"
                                            placeholder="Enter Booking Rate">
                                        <input onkeypress="return isSpecialKey(event)"
                                            class="form-control qf-secondary-input bgc" id="inrAmount" type="hidden"
                                            onchange="return currencyBtn();">--}}
                                    </div>
                                </div>
                                {{-- <div class="col-md-4 col-lg-3 mt-0">
                                    <div class="ms-auto mt-0  text-center">
                                        <button type="button" class="qf-primary-btn btn-block" id="addCurrency"
                                            disabled>
                                            <span class=" text-capitalize">Add Currency1</span>
                                        </button>
                                    </div>
                                </div>--}}
                                <span class="text-danger" id="currencyError"></span>
                              </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Collapsible Group Item #1
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Collapsible Group Item #1
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">

                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- collapsable end -->


            </div>
            <div class="table-responsive-sm selected-currency-container">
                <table class="table roundedTable text-center" id="selected-currency">
                    <thead>
                        <tr class="bgc-table row-font1">
                            {{--<th scope="col" class="qf-td-md q--py-20px">Sr.No</th>--}}
                            <th scope="col" class="qf-td-md q--py-20px">Currency</th>

                            <th scope="col" class="qf-td-md q--py-20px">Amount
                            </th>
                            <th scope="col" class="qf-td-md q--py-20px">Client Rate
                            </th>
                            <th scope="col" class="qf-td-md q--py-20px">Value INR
                            </th>
                            <th scope="col" class="qf-td-md q--py-20px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="currencyTable">
                    </tbody>

                </table>
            </div>
            <div class="charges-summary-wrap" >
                <table class="table roundedTable">
                    <tbody class="curr-sum-table" >
                        <tr class="bgc tr" >
                            <td style="width:40%"></td>
                            <td class="qf-td-md fw-bold q--pt-30px"><label>Total INR Value:</td>
                            <td class="qf-td-md q--pt-30px">
                                <label id="total_inr_value" class="text-black fw-bold">₹0</label>
                                <input onkeypress="return isSpecialKey(event)" type="hidden" id="net_amount_text_box"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="net_amount" value="0"
                                    class="form-control qf-line-input qf-td-md q--py-20px">
                            </td>
                            <td></td>
                        </tr>
                        <tr class="bgc">
                        <td style="width:40%"></td>
                            <td class="qf-td-base">Remit Charges:</td>
                            <td class="qf-td-base">
                                <input onkeypress="return isSpecialKey(event)" type="text" id="remit_fees"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="remit_fees" value="0"
                                    class="form-control qf-line-input">
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="bgc">
                        <td style="width:40%"></td>
                            <td class="qf-td-base">Nostro Charges:</td>
                            <td class="qf-td-base nostro_charge_msg">
                                <input onkeypress="return isSpecialKey(event)"
                                    class="form-control qf-line-input" id="nostro_charge" type="text"
                                    value="0" oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                    name="nostro_charge">
                                @component('components.ajax-error',['field'=>'nostro_charge'])@endcomponent
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="bgc">
                        <td style="width:40%"></td>
                            <td class="qf-td-base">Swift Charges:</td>
                            <td class="qf-td-base">
                                <input onkeypress="return isSpecialKey(event)" type="text" id="swift_charges"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="swift_charges"
                                    value="250" class="form-control qf-line-input">
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="bgc">
                        <td style="width:40%"></td>
                            <td><label class="qf-td-base">TCS:<span>
                                <!-- <i class="fa-solid fa-info-circle text-primary"
                                    title="If Loan – than TCS % 0.5% If any other– TCS applicable 5% TCS on amount above INR 7,00,000"></i> -->
                                </span></label>
                            </td>
                            <td class="qf-td-base">
                                <label id="tcs_amount">₹0</label>
                                <input onkeypress="return isSpecialKey(event)" class="fw-bold" type="hidden" id="tcs_amount_text_box"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="amount_for_tcs"
                                    value="0" class="form-control qf-line-input qf-td-base">
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="bgc">
                        <td style="width:40%"></td>
                            <td><label class="qf-td-base">GST:</label></td>
                            <td class="qf-td-base">
                                <label id="gst_amount">₹0</label>
                                <input onkeypress="return isSpecialKey(event)" class="fw-bold" type="hidden" id="gst"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="gst" value="0"
                                    class="form-control qf-line-input">
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="bgc">
                        <td style="width:40%"></td>
                            <td class="qf-td-base text-black fw-bold">Total Payable Amount:</td>
                            <td class="qf-td-base">
                                <label id="total_payable_amount" class="text-black fw-bold">₹0</label>
                                <input onkeypress="return isSpecialKey(event)"
                                       class="fw-bold"
                                       type="hidden" id="gross_payable_text_box"
                                       oninput="this.value=this.value.replace(/[^0-9]/g,'');"   name="gross_payable"
                                       value="0" class="form-control qf-line-input qf-td-base">
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <td style="width:40%"></td>
                            <td class="qf-td-base"></td>
                            <td class="qf-td-base">
                                <button type="submit" class="qf-secondary-btn initiate-transaction-btn">
                                  INITIATE TRANSACTION
                               </button>
                            </td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- <div class="bgc pb-5 initiate-t-btn-wrapper">
                <div class="pb-4 ">
                    <div class="text-center float-end  ">
                        <button type="submit" class="qf-primary-btn">
                            <div class=" text-capitalize me-3 ms-3"><img
                                    src="./assets/img/dashboard/svg/ic_initiate.svg" class="mb-2 mt-1 me-2 " alt="">
                                Initiate Transaction
                            </div>
                        </button>
                    </div>
                </div>
            </div> -->
        </form>
        <!--
            <div class="text-center pt-5">
           <a  href="buy_2.html" class="text-white"><button type="button" class="qf-primary-btn px-5 fw-bold text-capitalize" >Next</button></a>
            </div> -->
    </div>


    <div class="tab-pane" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
        <div class="table-responsive pt-4   ps-0 pe-0">
            <table id="transaction-status-table" class="table  roundedTable">
                <thead>
                    <tr class="bgc-table row-font1">
                        <th scope="col" class="fw-normal">Transaction Number</th>
                        <th scope="col" class="fw-normal">Customer Name</th>
                        <th scope="col" class="fw-normal">Fx Value</th>
                        <th scope="col" class="fw-normal">Type</th>
                        <th scope="col" class="fw-normal">Remitter PAN</th>
                        <th scope="col" class="fw-normal">KYC Status</th>
                        <th scope="col" class="fw-normal">Payment Status</th>
                        <th scope="col" class="fw-normal">Transaction Status</th>
                        <th scope="col" class="fw-normal">Payment Mode</th>
                        <th scope="col" class="fw-normal">LRS Doc</th>
                        <th scope="col" class="fw-normal">Swift Doc</th>
                        <th scope="col" class="fw-normal">Deal Expiry Date</th>
                        <th scope="col" class="fw-normal">Action</th>
                    </tr>
                </thead>
            </table>

        </div>

        <div class="container">
            <div class="d-flex justify-content-center gap-3">
                <div class="  mt-4 pt-2 text-center">
                    <div type="button" class="qf-secondary-btn btn-block " id="print-data">
                        <span class=" text-capitalize">Print</span>
                    </div>
                </div>
                <div class="  mt-4 pt-2 text-center">
                    <a href="{{ route('transection.export')}}">
                        <div type="button" class="qf-primary-btn btn-block">
                            <span class=" text-capitalize">Download</span>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>

    <div class="tab-pane fade" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">
        {{--<div class="row">
            <div class="col-md-4 col-lg-3  mt-3">
                <label class="">Select Transaction
                </label>
                <div class="input-group mb-3">
                    <input onkeypress="return isSpecialKey(event)" class="form-control border-end-0  p-2" type="text"
                        placeholder="Enter Customer/Transaction ID">
                    <span class="input-group-text  border-start-0 bg-transparent" id="basic-addon1">
                    </span>
                </div>
            </div>
        </div>--}}

        <div class="table-responsive-sm box pt-4   ps-0 pe-0">
            <table id="transaction-kyc-table" class="table roundedTable bgc align-middle">
                <thead>
                    <tr class="bgc-table row-font1">
                        <th scope="col" class="fw-normal">Transaction Number</th>
                        <th scope="col" class="fw-normal">Customer Name</th>
                        <th scope="col" class="fw-normal">Fx Value</th>
                        <th scope="col" class="fw-normal">Transaction type</th>
                        <th scope="col" class="fw-normal">Purpose</th>
                        <th scope="col" class="fw-normal">Source Of Fund</th>
                        <th scope="col" class="fw-normal">Remitter PAN</th>
                        <th scope="col" class="fw-normal">Status</th>
                        <th scope="col" class="fw-normal" style="width: 15%;">Kyc Upload</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

    <div class="tab-pane fade show active bg-white" id="ex3-tabs-4" role="tabpanel" aria-labelledby="ex3-tab-4">
        {{--<div class="text-center">
            <div type="button" class="btn-sm btn-secondary float-end mt-5 mb-3" onclick="openRateBlockModel();">
                <div class="me-3 ms-3"><i class="fa-solid fa-plus"></i> Create Rate Booking</div>
            </div>
        </div>--}}
        <form action="{{route('rate-block.save')}}" method="post" class="save-currency-form">
            <div class="bgc mt-3 pt-4 pb-3">

                <div class="d-flex justify-content-between pt-4 pb-1">
                    <div class="d-flex">
                        <div class="qf-title-lg mb-4">Currency Details</div>
                    </div>
                </div>
                <div class="agent-curr-det-container">
                    <div class="agent-curr-det-each">
                        <!-- <label class="">FX Currency*</label> -->
                        <div class="input-group mb-3">
                            <!-- <label class="input-group-text border-0 border-bottom " for="inputGroupSelect01"><img src="../assets/svg/6.svg">
                                </label>-->
                            <select class="form-select qf-primary-select" id="currencyTyperb" name="currencyTyperb">
                                <option value="" selected>FX Currency*</option>
                                <option value="USD">USD</option>
                                <option value="CAD">CAD</option>
                                <option value="AUD">AUD</option>
                                <option value="JPY">JPY</option>
                                <option value="CHF">CHF</option>
                                <option value="AED">AED</option>
                                <option value="GBP">GBP</option>
                                <option value="EUR">EUR</option>
                                <option value="THB">THB</option>
                                <option value="SGD">SGD</option>
                                <option value="NZD">NZD</option>
                                <option value="SAR">SAR</option>
                                <option value="ZAR">ZAR</option>
                                <option value="SEK">SEK</option>
                                <option value="NOK">NOK</option>
                                <option value="DKK">DKK</option>
                                <option value="HKD">HKD</option>
                            </select>
                            <span class="invalid-feedback ajax-error has-error w-100 vh-30" role="alert"
                                id="currencyerror"></span>
                            @component('components.ajax-error',['field'=>'currencyrb'])@endcomponent
                        </div>
                    </div>
                    <div class="agent-curr-det-each">
                        <!-- <label class="">FX Value*</label> -->
                        <div class="input-group mb-3 input-group-sm inputWithIcon">
                            <input onkeypress="return isSpecialKey(event)" class="form-control qf-secondary-input px-3"
                                name="amountrb" id="amountrb"
                                oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                type="text" placeholder="Enter Amount">
                            <img src="./assets/img/dashboard/svg/icon_value.svg" class="mb-2 mt-1 me-2 " alt="">

                            <span class="invalid-feedback ajax-error has-error w-100 vh-30" role="alert"
                                id="amountErrorrb"></span>

                        </div>
                    </div>
                    <div class="agent-curr-det-each">
                        <!-- <label class="">Booking purpose*</label> -->
                        <div class="input-group mb-3">
                            <select class="form-select qf-primary-select" name="purpose_id" id="purpose_id">
                                <option value="" data-value="" selected>Select Purpose</option>
                                @foreach($purposes as $val)
                                <option value="{{$val['id']}}" data-value="{{$val['purpose_name']}}">
                                    {{$val['purpose_name']}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback ajax-error has-error w-100 vh-30" role="alert"
                                id="purpose_idErrorrb"></span>
                        </div>
                    </div>
                    <div class="agent-curr-det-each">
                        <!-- <label class="">Transaction Type*</label> -->
                        <div class="input-group mb-3">
                            <select class="form-select qf-primary-select" name="txn_type" id="txn_type">
                                <option value="" selected>Transaction Type*</option>
                                <option value="1">Remittance</option>
                                {{--<option value="2">Card</option>--}}
                                {{--<option value="3">Currency</option>--}}
                            </select>
                            <span class="invalid-feedback ajax-error has-error w-100 vh-30" role="alert"
                                id="txn_typeErrorrb"></span>

                        </div>
                    </div>
                    <div class="agent-curr-det-each">
                        <button type="button" class="qf-primary-btn" id="addCurrencyrb">
                            <span class=" text-capitalize">Add Currency</span>
                        </button>
                    </div>
                    <div class="col-md-4 col-lg-3 mt-0">
                        <div class="ms-auto mt-0 text-center">

                        </div>
                    </div>

                    <span class="text-danger" id="currencyErrorrb"></span>
                </div>

            </div>
            <div class="table-responsive-sm pt-4   ps-0 pe-0">
                <table class="table roundedTable text-center currency-table" id="selected-currencyrb">
                    <thead>
                        <tr class="bgc-table row-font1">
                            {{--<th scope="col" class="fw-bold text-center">Sr.No</th>--}}
                            <th scope="col" class="fw-bold text-center">Currency</th>

                            <th scope="col" class="fw-bold text-center">Amount
                            </th>
                            <th scope="col" class="fw-bold text-center">Booking Purpose</th>
                            <th scope="col" class="fw-bold text-center">Transaction Type</th>
                            <th scope="col" class="fw-bold text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="currencyTablerb">

                    </tbody>
                </table>
                <div class="qf-select-wrap mb-3">
                    <div class="ms-auto mt-4 request-rate-btn-wrap">

                        <button type="submit" class="qf-primary-btn request-rate-btn" id="addCurrencyrb">
                            <img src="./assets/img/dashboard/svg/ic_initiate.svg" class="mb-2 mt-1 me-2 " alt="">
                            <span class=" text-capitalize">Request Rate</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="tab-pane fade" id="ex3-tabs-5" role="tabpanel" aria-labelledby="ex3-tab-5">
        <div class="table-responsive-sm pt-4   ps-0 pe-0">
            <table id="agent-payment-table" class="table roundedTable text-center ">
                <thead>
                    <tr class="bgc-table row-font1">
                        <th scope="col" class="fw-normal">Transaction Number</th>
                        <th scope="col" class="fw-normal">Customer Name</th>
                        <th scope="col" class="fw-normal">Fx Value</th>
                        <th scope="col" class="fw-normal">Type</th>
                        <th scope="col" class="fw-normal">Remitter PAN</th>
                        <th scope="col" class="fw-normal">KYC Status</th>
                        <th scope="col" class="fw-normal">Payment</th>
                        <th scope="col" class="fw-normal">Payment Status</th>
                        <th scope="col" class="fw-normal">Txn Created Date</th>
                        <th scope="col" class="fw-normal">Action</th>
                    </tr>
                </thead>
            </table>
            {{-- <div class=" ">
                <div class="text-center pt-5  m-1 float-end">
                    <a href="#" class="text-white ">
                        <button type="button" class="qf-primary-btn px-5 fw-bold text-capitalize">Download
                        </button>
                    </a>
                </div>
                <div class="text-center pt-5 m-1 float-end">
                    <a href="#" class="text-white">
                        <button type="button" class="qf-primary-btn px-5 fw-bold text-capitalize">Print</button>
                    </a>
                </div>
            </div>--}}
        </div>
    </div>

    <div class="tab-pane fade" id="ex3-tabs-6" role="tabpanel" aria-labelledby="ex3-tab-6">
        <div class="table-reponsive box pt-4   bgc ps-0 pe-0">
            <table id="approved-deal-table" class="table   roundedTable border-0  text-center ">
                <thead class=" ">
                    <tr class="bgc-table  row-font1">
                        <th scope="col" class="fw-normal">Reference Number</th>
                        <th scope="col" class="fw-normal">Currency</th>
                        <th scope="col" class="fw-normal">Value</th>
                        <th scope="col" class="fw-normal">Purpose</th>
                        <th scope="col" class="fw-normal">Transection Type</th>
                        <th scope="col" class="fw-normal">Rate</th>
                        <th scope="col" class="fw-normal">Deal ID</th>
                        <th scope="col" class="fw-normal">Expiry Date</th>
                        <th scope="col" class="fw-normal">Created Date</th>
                        <th scope="col" class="fw-normal">Updated Date</th>
                    </tr>
                </thead>
            </table>
        </div>


    </div>

</div>
<!-- Tabs content -->
<!-- Modal -->
{{--Not Used--}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Edit Detail</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <div class="d-flex  pb-3 ">
                    <div class="qf-title-lg">Transaction Details</div>
                    <div class="ml-auto">
                        <button class="btn-print  "> <img src="./assets/img/dashboard/svg/ic-print.svg"
                                class="mb-1 me-1" alt=""> Print</button>
                        <button class="btn-download  "> <img src="./assets/img/dashboard/svg/ic-download.svg"
                                class="mb-1 me-1" alt=""> Download</button>
                    </div>

                </div>

                <div class=" bgc-model m-2">
                    <div class="row ">


                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Customer Name</p>
                            <div>
                                <p> Ramesh Shah</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                            <p class="text-color">Mobile Number</p>
                            <div>
                                <p>
                                    +91 - 9876541230
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                            <p class="text-color">Transaction type</p>
                            <div>
                                <p>
                                    Remittance
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Purpose</p>
                            <div>
                                <p>
                                    Education
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Source Of Fund</p>
                            <div>
                                <p>
                                    Relative
                                </p>
                            </div>

                        </div>
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Remitter PAN</p>
                            <div>
                                <p>
                                    AAPOC8795T
                                </p>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="d-flex gap-3 justify-content-start m-2">
                    <div class="d-flex badge-1 pe-2">
                        <div class="border-incdent"></div>
                        <p class="badge-c ps-1 fw-bold lh-lg small">*TCS Applicable @ 5%</p>
                    </div>
                    <!-- <div class="d-flex badge-1 pe-2">
                        <div class="border-incdent"></div>
                        <p class="ps-1 badge-c fw-bold lh-lg small">*Previous Remittance in AY with QFX: 0.00</p>
                    </div> -->
                </div>

                <div class="table-responsive-sm pt-4  Transaction_Details_Popup_Table ps-0 pe-0">
                    <table class="table roundedTable text-center ">
                        <tr class="bgc-table row-font1">
                            <th scope="col" class="fw-normal">Sr.No</th>
                            <th scope="col" class="fw-normal">Currency</th>
                            <th scope="col" class="fw-normal">Amount</th>
                            <th scope="col" class="fw-normal">Client Rate</th>
                            <th scope="col" class="fw-normal">Remit Fees</th>
                            <th scope="col" class="fw-normal">Value INR</th>

                        </tr>
                        <tbody class="">
                            <tr class="  ">
                                <th scope="row">1</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="./assets/img/dashboard/usd_t.png" style="width: 25px; height: 18px"
                                            class="rounded-1" />
                                        <div class="ms-2">
                                            <p class=" mb-0">USD</p>
                                        </div>
                                    </div>
                                </td>
                                <td>$5,625</td>
                                <td>80.26</td>
                                <td>₹4,49,269</td>
                                <td class="text-start">8,38,500.00</td>

                            </tr>
                            <tr class=" ">
                                <th scope="row">2</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="./assets/img/dashboard/eur_t.png" style="width: 25px; height: 18px"
                                            class="rounded-1" />
                                        <div class="ms-2">
                                            <p class=" mb-0">JPY</p>
                                        </div>
                                    </div>
                                </td>
                                <td>¥3,325</td>
                                <td>45.56</td>
                                <td>₹6,350</td>
                                <td class="text-start">6,17,000.00</td>
                            </tr>
                            <tr class="bgc">
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end ">
                                    <div>Net Amount :</div>
                                    <div>TCS :</div>
                                    <div>Amount for TCS :</div>
                                    <div>Remit Fees :</div>
                                    <div>GST @ 18 % :</div>

                                </td>
                                <td class="text-start">
                                    <div> 14,55,500.00 </div>
                                    <div> 37,775.00 </div>
                                    <div> 7,55,500.00 </div>
                                    <div> 1000.00 </div>
                                    <div> 180.00 </div>
                                </td>
                            </tr>

                            <tr class="bgc-model">
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="fw-bold text-end ">Gross Payable :</td>
                                <td class="row-font1 fw-bold text-start">14,94,455.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="modal-footer text-center">
                  <button type="button" class="btn btn-primary">Submit</button>
                </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title fw-bold  r " id="exampleModalLabel1" style="color: #2565ab;">KYC Initiate
                </h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <!-- <div class="d-flex  pb-3 ">
                        <div class="border-heading"></div>
                          <div class="ps-1 fw-bold">Transaction Details</div>
                            <div class="ml-auto">
                                <button class="btn-print  ">  <img src="./assets/img/dashboard/svg/ic-print.svg" class="mb-1 me-1" alt=""> Print</button>
                                <button class="btn-download  "> <img src="./assets/img/dashboard/svg/ic-download.svg" class="mb-1 me-1" alt=""> Download</button>
                            </div>

                        </div> -->

                <div class=" bgc-model m-2">
                    <div class="row ">


                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Transaction Number
                            </p>
                            <div>
                                <p> Ramesh Shah</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                            <p class="text-color">Customer Name
                            </p>
                            <div>
                                <p>
                                    +91 - 9876541230
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                            <p class="text-color">Mobile
                            </p>
                            <div>
                                <p>
                                    Remittance
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Transaction type
                            </p>
                            <div>
                                <p>
                                    Education
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Purpose</p>
                            <div>
                                <p>
                                    Relative
                                </p>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label mt-3" for="customFile">Passport :
                        </label>
                        <input onkeypress="return isSpecialKey(event)" type="file" class="form-control"
                            id="customFile" />
                    </div>
                    <div class="col-md-3">
                        <div class="text-center mt-5 ">
                            <a href="#" class="text-white"><button type="button"
                                    class="qf-primary-btn   fw-bold text-capitalize"><i class="fa-solid fa-eye"></i>
                                </button></a>
                        </div>

                    </div>
                    <div class="col-md-3">

                        <div class="input-group mt-5">
                            <input onkeypress="return isSpecialKey(event)" class="form-control qf-secondary-input" type="text"
                                placeholder="Passport Number ">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label mt-3" for="customFile">PAN :
                        </label>
                        <input onkeypress="return isSpecialKey(event)" type="file" class="form-control"
                            id="customFile" />
                    </div>
                    <div class="col-md-3">
                        <div class="text-center mt-5 ">
                            <a href="#" class="text-white"><button type="button"
                                    class="qf-primary-btn   fw-bold text-capitalize"><i class="fa-solid fa-eye"></i>
                                </button></a>
                        </div>

                    </div>
                    <div class="col-md-3">

                        <div class="input-group mt-5">
                            <input onkeypress="return isSpecialKey(event)" class="form-control qf-secondary-input" type="text"
                                placeholder="PAN Number">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label mt-3" for="customFile">Visa :
                        </label>
                        <input onkeypress="return isSpecialKey(event)" type="file" class="form-control"
                            id="customFile" />
                    </div>
                    <div class="col-md-3">
                        <div class="text-center mt-5 ">
                            <a href="#" class="text-white"><button type="button"
                                    class="qf-primary-btn   fw-bold text-capitalize"><i class="fa-solid fa-eye"></i>
                                </button></a>
                        </div>

                    </div>
                    <div class="col-md-3">

                        <div class="input-group mt-5">
                            <input onkeypress="return isSpecialKey(event)" class="form-control qf-secondary-input" type="date"
                                placeholder="Validity Date ">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label mt-3" for="customFile">Ticket :
                        </label>
                        <input onkeypress="return isSpecialKey(event)" type="file" class="form-control"
                            id="customFile" />
                    </div>
                    <div class="col-md-3">
                        <div class="text-center mt-5 ">
                            <a href="#" class="text-white"><button type="button"
                                    class="qf-primary-btn   fw-bold text-capitalize"><i class="fa-solid fa-eye"></i>
                                </button></a>
                        </div>

                    </div>
                    <div class="col-md-3">

                        <div class="input-group mt-5">
                            <input onkeypress="return isSpecialKey(event)" class="form-control qf-secondary-input" type="date"
                                placeholder="Travel Date">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label mt-3" for="customFile">A2 Form :
                        </label>
                        <input onkeypress="return isSpecialKey(event)" type="file" class="form-control"
                            id="customFile" />
                    </div>
                    <div class="col-md-3">
                        <div class="text-center mt-5 ">
                            <a href="#" class="text-white"><button type="button"
                                    class="qf-primary-btn   fw-bold text-capitalize"><i class="fa-solid fa-eye"></i>
                                </button></a>
                        </div>

                    </div>
                    <!-- <div class="col-md-3">

                         <div class="input-group mt-5">
                           <input onkeypress="return isSpecialKey(event)" class="form-control    p-2" type="date" placeholder="Enter Customer/Agent ID">

                         </div>
                        </div> -->
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <div class="input-group mt-5">

                            <input onkeypress="return isSpecialKey(event)" class="form-control   border-end-0 p-2 bgc"
                                type="text" placeholder="Remitter Name
                      ">
                            <span class="input-group-text   border-start-0 bg-transparent" id="basic-addon1">
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label mt-3" for="customFile">
                        </label>
                        <input onkeypress="return isSpecialKey(event)" type="file" class="form-control"
                            id="customFile" />
                    </div>


                </div>



                <div class="row">
                    <div class="col-md-12">

                        <div class="input-group mt-3">

                            <input onkeypress="return isSpecialKey(event)" class="form-control   border-end-0 p-2 bgc"
                                type="text" placeholder=" Beneficiary  Account Number
                      ">
                            <span class="input-group-text   border-start-0 bg-transparent" id="basic-addon1">
                            </span>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">

                        <div class="input-group mt-3">

                            <input onkeypress="return isSpecialKey(event)" class="form-control   border-end-0 p-2 bgc"
                                type="text" placeholder="Beneficiary Name
                      ">
                            <span class="input-group-text   border-start-0 bg-transparent" id="basic-addon1">
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="input-group mt-3">

                            <input onkeypress="return isSpecialKey(event)" class="form-control   border-end-0 p-2 bgc"
                                type="text" placeholder="SORT">
                            <span class="input-group-text   border-start-0 bg-transparent" id="basic-addon1">
                            </span>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">

                        <div class="input-group mt-3">

                            <input onkeypress="return isSpecialKey(event)" class="form-control   border-end-0 p-2 bgc"
                                type="text" placeholder="SWIFT Code
                      ">
                            <span class="input-group-text   border-start-0 bg-transparent" id="basic-addon1">
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="input-group mt-3">

                            <input onkeypress="return isSpecialKey(event)" class="form-control   border-end-0 p-2 bgc"
                                type="text" placeholder="Bank Name
                      ">
                            <span class="input-group-text   border-start-0 bg-transparent" id="basic-addon1">
                            </span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="text-center pt-3 pb-3">
                <a href="#" class="text-white"><button type="button"
                        class="qf-primary-btn px-5 fw-bold text-capitalize">Upload</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title fw-bold  r " id="exampleModalLabel1" style="color: #2565ab;">Document
                </h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <!-- <div class="d-flex  pb-3 ">
                        <div class="border-heading"></div>
                          <div class="ps-1 fw-bold">Transaction Details</div>
                            <div class="ml-auto">
                                <button class="btn-print  ">  <img src="./assets/img/dashboard/svg/ic-print.svg" class="mb-1 me-1" alt=""> Print</button>
                                <button class="btn-download  "> <img src="./assets/img/dashboard/svg/ic-download.svg" class="mb-1 me-1" alt=""> Download</button>
                            </div>

                        </div> -->

                <div class=" bgc-model m-2">
                    <div class="row ">


                        <div class="col-md-4 col-sm-6  ">
                            <p class="text-color">Transaction Number
                            </p>
                            <div>
                                <p> 02022302</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 ">
                            <p class="text-color">Customer Name
                            </p>
                            <div>
                                <p>
                                    Remittance

                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 ">
                            <p class="text-color">Mobile
                            </p>
                            <div>
                                <p>
                                    +91 - 9876541230
                                </p>
                            </div>
                        </div>



                    </div>


                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Payment Proof
                                </label>
                            </div>
                            <div class="col-auto">
                                <div class="dropdown  m-auto text-center">
                                    <a class="text-decoration-none text-dark " href="#" role="button"
                                        id="dropdownMenuLink" data-mdb-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Type
                                        <span>
                                            <img src="{{asset(" assets/img/dashboard/svg/DROPDOWNARROW.svg")}}" alt=""
                                                width="10px">
                                        </span>
                                    </a>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><button class="dropdown-item" type="button">Transfer
                                            </button></li>
                                        <li><button class="dropdown-item" type="button">Cheque</button></li>
                                        <li><button class="dropdown-item" type="button">UPI</button></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3">


                        <label class="custom-upload btn-sm btn-block p-2"><input onkeypress="return isSpecialKey(event)"
                                type="file" name="upload_file" /> <i class="fa-solid fa-paperclip"></i> Attach
                            Proof</label>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center   ">
                            <a href="#" class="text-white"><button type="button"
                                    class="btn-sm p-2  custom-upload  btn-block  fw-bold text-capitalize"><i
                                        class="fa-solid fa-eye"></i> </button></a>
                        </div>

                    </div>

                </div>

            </div>
            <div class="text-center pt-3 pb-3">
                <a href="#" class="text-white"><button type="button"
                        class="qf-primary-btn px-5 fw-bold text-capitalize">Submit</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title fw-bold  r " id="exampleModalLabel1" style="color: #2565ab;">Assign Deal
                </h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <div class=" bgc-model m-2">
                    <div class="row ">
                        <div class="col-md-4 col-sm-6  ">
                            <p class="text-color">Transaction Number
                            </p>
                            <div>
                                <p> 02022302</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 ">
                            <p class="text-color">Customer Name
                            </p>
                            <div>
                                <p>
                                    Remittance
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 ">
                            <p class="text-color">Mobile
                            </p>
                            <div>
                                <p>
                                    +91 - 9876541230
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-reponsive box pt-4   bgc ps-0 pe-0">
                    <table id="example4" class="table   roundedTable border-0  text-center ">
                        <thead class=" ">
                            <tr class="bgc-table  row-font1">
                                <th scope="col" class="fw-bold">Currency </th>
                                <th scope="col" class="fw-bold">Select Deal

                                </th>
                                <th scope="col" class="fw-bold">Booked Rate

                                </th>
                                <th scope="col" class="fw-bold">Amount </th>
                                <th scope="col" class="fw-bold">Sell Rate
                                </th>
                                <th scope="col" class="fw-bold">Value
                                </th>
                            </tr>
                        </thead>

                        <tbody class="border-0">
                            <tr class="  ">
                                <th scope="row">USD
                                </th>
                                <td>
                                    <div class="dropdown  m-auto text-center">
                                        <a class="text-decoration-none text-dark " href="#" role="button"
                                            id="dropdownMenuLink" data-mdb-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Type
                                            <span>
                                                <img src="{{asset(" assets/img/dashboard/svg/DROPDOWNARROW.svg")}}"
                                                    alt="" width="10px">
                                            </span>
                                        </a>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><button class="dropdown-item" type="button">QF1231
                                                </button></li>
                                            <li><button class="dropdown-item" type="button">QF1232</button></li>
                                            <li><button class="dropdown-item" type="button">QF1233</button></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>90.23</td>
                                <td>1000
                                </td>
                                <td>89.23 </td>

                                <td>89.230
                                </td>

                            </tr>
                            <tr class="  ">
                                <th scope="row">USD
                                </th>
                                <td>
                                    <div class="dropdown  m-auto text-center">
                                        <a class="text-decoration-none text-dark " href="#" role="button"
                                            id="dropdownMenuLink" data-mdb-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Type
                                            <span>
                                                <img src="{{asset(" assets/img/dashboard/svg/DROPDOWNARROW.svg")}}"
                                                    alt="" width="10px">
                                            </span>
                                        </a>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><button class="dropdown-item" type="button">QF1231
                                                </button></li>
                                            <li><button class="dropdown-item" type="button">QF1232</button></li>
                                            <li><button class="dropdown-item" type="button">QF1233</button></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>89.56
                                </td>
                                <td>500</td>
                                <td>89.23</td>

                                <td> 89.23
                                </td>

                            </tr>
                            <tr class="  ">
                                <th scope="row">USD
                                </th>
                                <td>
                                    <div class="dropdown  m-auto text-center">
                                        <a class="text-decoration-none text-dark " href="#" role="button"
                                            id="dropdownMenuLink" data-mdb-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Type
                                            <span>
                                                <img src="{{asset(" assets/img/dashboard/svg/DROPDOWNARROW.svg")}}"
                                                    alt="" width="10px">
                                            </span>
                                        </a>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><button class="dropdown-item" type="button">QF1231
                                                </button></li>
                                            <li><button class="dropdown-item" type="button">QF1232</button></li>
                                            <li><button class="dropdown-item" type="button">QF1233</button></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>90.95</td>
                                <td>1000</td>
                                <td>89.23</td>

                                <td> 89.23 </td>

                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>


            <div class="container text-center pt-3 pb-3">
                <a href="#" class="text-white"><button type="button"
                        class=" btn-dialog qf-primary-btn px-5 fw-bold text-capitalize">Assign Deal
                    </button></a>
                <!-- Dialog will be inserted here -->
                <div class="awsm-dialog animated bounceIn">
                    <div class="awd-content">
                        <p class="awd-message">Are you </p>
                        <button class="btn awd-ok">Yes</button>
                        <button class="btn awd-cancel">No</button>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

{{--Not Used--}}
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Edit Detail</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <div class="d-flex  pb-3 ">
                    <div class="qf-title-lg">Transaction Details</div>
                    <div class="ml-auto ">
                        <button class="btn-print  "> <img src="./assets/img/dashboard/svg/ic-print.svg"
                                class="mb-1 me-1" alt=""> Print</button>
                        <button class="btn-download  "> <img src="./assets/img/dashboard/svg/ic-download.svg"
                                class="mb-1 me-1" alt=""> Download</button>
                    </div>
                </div>

                <div class=" bgc-model m-2">
                    <div class="row ">
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Customer Name</p>
                            <div>
                                <p> Suresh
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                            <p class="text-color">Mobile Number</p>
                            <div>
                                <p>
                                    8529478650
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                            <p class="text-color">Transaction type</p>
                            <div>
                                <p>
                                    Remittance
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Purpose</p>
                            <div>
                                <p>
                                    Education
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Source Of Fund</p>
                            <div>
                                <p>
                                    Loan
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Remitter PAN</p>
                            <div>
                                <p>
                                    AWLPO8712G
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex gap-3 justify-content-center m-2">
                    <div class="d-flex badge-1     ">
                        <div class="border-incdent"></div>
                        <p class="badge-c ps-1 fw-bold lh-lg small">*TCS Applicable @ 0.5%</p>
                    </div>
                    <!-- <div class="d-flex badge-1   ">
                        <div class="border-incdent"></div>
                        <p class="ps-1 badge-c fw-bold lh-lg small">*Previous Remittance in AY with QFX: 0.00</p>
                    </div> -->
                </div>

                <div class="table-responsive-sm pt-4   ps-0 pe-0">
                    <table class="table roundedTable text-center ">
                        <tr class="bgc-table row-font1">
                            <th scope="col" class="fw-bold">Sr.No</th>
                            <th scope="col" class="fw-bold">Currency</th>
                            <th scope="col" class="fw-bold">Amount</th>
                            <th scope="col" class="fw-bold">Client Rate</th>
                            <th scope="col" class="fw-bold">Remit Fees</th>
                            <th scope="col" class="fw-bold">Value INR</th>

                        </tr>
                        <tbody class="">
                            <tr class="  ">
                                <th scope="row">1</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="./assets/img/dashboard/usd_t.png" style="width: 25px; height: 18px"
                                            class="rounded-1" />
                                        <div class="ms-2">
                                            <p class=" mb-0">USD</p>
                                        </div>
                                    </div>
                                </td>
                                <td>$5,625</td>
                                <td>80.26</td>
                                <td>₹4,49,269</td>
                                <td class="text-start">8,38,500.00</td>

                            </tr>

                            <tr class="bgc">
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end ">
                                    <div>Net Amount :</div>
                                    <div>TCS :</div>
                                    <div>Amount for TCS :</div>
                                    <div>Remit Fees :</div>
                                    <div>GST @ 18 % :</div>

                                </td>
                                <td class="text-start">
                                    <div> 8,38,500.00 </div>
                                    <div> 37,775.00 </div>
                                    <div> 1,38,500.00
                                    </div>
                                    <div> 1000.00 </div>
                                    <div> 180.00 </div>
                                </td>
                            </tr>

                            <tr class="bgc-model">
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="fw-bold text-end ">Gross Payable :</td>
                                <td class="row-font1 fw-bold text-start">8,40,373.00
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="modal-footer text-center">
                  <button type="button" class="btn btn-primary">Submit</button>
                </div> -->
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="background: rgba(6,39,75,0.5);">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Edit Detail</h5>
                <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
            </div>
            <div class="modal-body">
                <div class="d-flex  pb-3 ">
                    <div class="qf-title-lg">Transaction Details</div>
                    <div class="ml-auto">
                        <button class="btn-print  "> <img src="./assets/img/dashboard/svg/ic-print.svg"
                                class="mb-1 me-1" alt=""> Print</button>
                        <button class="btn-download  "> <img src="./assets/img/dashboard/svg/ic-download.svg"
                                class="mb-1 me-1" alt=""> Download</button>
                    </div>

                </div>

                <div class=" bgc-model m-2">
                    <div class="row ">


                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Customer Name</p>
                            <div>
                                <p>Mahesh</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                            <p class="text-color">Mobile Number</p>
                            <div>
                                <p>
                                    7892546580
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                            <p class="text-color">Transaction type</p>
                            <div>
                                <p>
                                    Remittance
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Purpose</p>
                            <div>
                                <p>
                                    Education
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Source Of Fund</p>
                            <div>
                                <p>
                                    Self
                                </p>
                            </div>

                        </div>
                        <div class="col-md-3 col-sm-6  ">
                            <p class="text-color">Remitter PAN</p>
                            <div>
                                <p>
                                    AWTWS8541d
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="d-flex gap-3 justify-content-center m-2">
                    <div class="d-flex badge-1">
                        <div class="border-incdent"></div>
                        <p class="badge-c ps-1 fw-bold lh-lg small">*TCS Applicable @ 5%</p>
                    </div>
                    <!-- <div class="d-flex badge-1">
                        <div class="border-incdent"></div>
                        <p class="ps-1 badge-c fw-bold lh-lg small">*Previous Remittance in AY with QFX: 0.00</p>
                    </div> -->
                </div>

                <div class="table-responsive-sm pt-4   ps-0 pe-0">
                    <table class="table roundedTable text-center ">
                        <tr class="bgc-table row-font1">
                            <th scope="col" class="fw-bold">Sr.No</th>
                            <th scope="col" class="fw-bold">Currency</th>
                            <th scope="col" class="fw-bold">Amount</th>
                            <th scope="col" class="fw-bold">Client Rate</th>
                            <th scope="col" class="fw-bold">Remit Fees</th>
                            <th scope="col" class="fw-bold">Value INR</th>

                        </tr>
                        <tbody class="">
                            <tr class="  ">
                                <th scope="row">1</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="./assets/img/dashboard/usd_t.png" style="width: 25px; height: 18px"
                                            class="rounded-1" />
                                        <div class="ms-2">
                                            <p class=" mb-0">USD</p>
                                        </div>
                                    </div>
                                </td>
                                <td>$3000</td>
                                <td>80.26</td>
                                <td>₹251,550.00
                                </td>
                                <td class="text-start">8,38,500.00</td>

                            </tr>

                            <tr class="bgc">
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end ">
                                    <div>Net Amount :</div>

                                    <div>Amount for TCS :</div>
                                    <div>TCS :</div>
                                    <div>Remit Fees :</div>
                                    <div>GST @ 18 % :</div>

                                </td>
                                <td class="text-start">
                                    <div> 2,51,550.00
                                    </div>
                                    <div> 37,775.00 </div>
                                    <div> 51,550.00
                                    </div>
                                    <div> 1000.00 </div>
                                    <div> 180.00 </div>
                                </td>
                            </tr>

                            <tr class="bgc-model">
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="fw-bold text-end ">Gross Payable :</td>
                                <td class="row-font1 fw-bold text-start">2,55,308.00
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="modal-footer text-center">
                  <button type="button" class="btn btn-primary">Submit</button>
                </div> -->
        </div>
    </div>
</div>




<!-- Dynamic Modal -->
<div class="addModals"></div>
@endsection

@push('pagescript')
@include('stacks.js.front.customer.index')
@include('stacks.js.front.dashboard.transaction')
@include('stacks.js.front.dashboard.kyc')
@include('stacks.js.front.dashboard.payment')
@include('stacks.js.front.dashboard.approved-deal')
@include('stacks.js.front.dashboard.signzyapi')
<script>
    /*$('#pancard_no').keypress(function(e) {*/
    $("#pancard_no").on("keyup", function (e) {
        if (e.which === 32) {
            return false;
        }
        $(this).val($(this).val().toUpperCase());
    });

    $("#customer_reference").on("keyup", function (evt) {


        $(this).val($(this).val().toUpperCase());
    });

    $(".textInput").on("keyup", function (evt) {
        $(this).val($(this).val().toUpperCase());
    });

    $(document).on('click', "#print-data", function (evt) {

        var exportUrl = "{{ route('transection-print')}}";
        $.ajax({
            url: exportUrl,
            type: 'GET',
            success: function (result) {
                newWin = window.open("");
                newWin.document.write(result);
                newWin.print();
                newWin.close();
            }
        });
    });

</script>
@endpush
