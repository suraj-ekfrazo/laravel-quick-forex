@extends('layouts.admin')
@section('content')
    <style>
        .switch-input:checked ~ .switch-label{
            background: #5379ec;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
        }
    </style>
    <div class="container mt-5 pt-5 bg-white">
        <!-- Tabs content -->
        <div class="d-flex justify-content bg-white mt-4 mb-2">
            <div class="d-flex">
                <div class="qf-title-lg">Automation Scorecard &amp; Documents</div>
            </div>
        </div>
        <div class="bgc">
            <div class="row">
                <div class="col-lg-4 col-sm-4 mt-3">
                    <label class="">Transaction Number</label>
                    <div class="input-group mb-3">
                        <input class="form-control  p-2 bg-transparent" type="text" placeholder="Enter Incident Number" readonly="" value="{{$txnData->txn_number}}">
                    </div>
                </div>
                {{--<div class="col-lg-4 col-sm-4 mt-3">
                    <label class="">Card Number</label>
                    <div class="input-group mb-3">
                        <input class="form-control  p-2 bg-transparent" type="text" placeholder="Enter Card Number" readonly="" value="4833-1100-0000-0000">
                    </div>
                </div>--}}
                <div class="col-lg-4 col-sm-4 mt-3 ">
                    <label class="">Transaction Type</label>
                    <div class="input-group mb-3">
                        <input class="form-control  p-2 bg-transparent" type="text" readonly="" value="{{ $txnData->txn_type==1 ? "Remittance":"Card" }}">
                    </div>
                </div>
                {{--<div class="col-lg-4 col-sm-4 mt-3">
                    <label class="">Buy/Sell</label>
                    <div class="input-group mb-3">
                        <input class="form-control  p-2 bg-transparent" type="text" readonly="" value="Sell">
                    </div>
                </div>--}}
                <div class="col-lg-4 col-sm-4 mt-3">
                    <label class="">Travel Type</label>
                    <div class="input-group mb-3">
                        <input class="form-control  p-2 bg-transparent" type="text" readonly="" value="{{{$purposes->purpose_name}}}">
                    </div>
                </div>
                {{--<div class="col-lg-4 col-sm-4 mt-3">
                    <label class="">Date of Departure</label>
                    <div class="input-group mb-3">
                        <input class="form-control  p-2 bg-transparent" type="text" readonly="" value="24-11-2022">
                    </div>
                </div>--}}
            </div>
        </div>
        <div class="table-responsive scorecard-data-container bgc mt-3">
            <table class="table border-none">
                <thead class="rounded-5 ">
                <tr class="text-light kyc-det-table-head">
                    <th scope="col"  class="kyc-auto-table-head" ><span>Currency</span></th>
                    <th scope="col"  class="kyc-auto-table-head"><span>Amount</span></th>
                    <th scope="col"  class="kyc-auto-table-head"><span>Rate</span></th>
                    <th scope="col"  class="kyc-auto-table-head"><span>Calculate</span></th>
                </tr>
                </thead>
                <tbody class="fw-bold ">
                <?php $totalAmount = 0 ?>
                @foreach($txnCurrency as $txnVal)
                    <tr>
                        <td   scope="row"  class="kyc-auto-table-data">
                          <span>  {{$txnVal->txn_currency_type}}</span>
                        </td>
                        <td  class="kyc-auto-table-data">
                           <span> {{$txnVal->txn_frgn_curr_amount}}</span>
                        </td>
                        <td  class="kyc-auto-table-data">
                           <span> {{$txnVal->txn_booking_rate}}</span>
                        </td>
                        <td  class="kyc-auto-table-data">
                          <span>  {{number_format($txnVal->txn_inr_amount,2)}}</span>
                            <?php $totalAmount +=$txnVal->txn_inr_amount  ?>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="kyc-auto-table-footer">
                <div class="kyc-inner-wrapper">
                    <table  class="table table-borderless">
                        <tr>
                                <th >
                                    Net Amount
                                </th>
                                <th >
                                    {{$txnData->net_amount != "" ? number_format($txnData->net_amount,2) : "0.00" }}
                                </th>
                            </tr>
                            <tr>
                                <th >
                                    Amount For TCS
                                </th>
                                <th >
                                    {{$txnData->amount_for_tcs!="" ? number_format($txnData->amount_for_tcs,2) : "0.00" }}
                                </th>
                            </tr>
                            <tr>
                                <th >
                                    Remit Fees
                                </th>
                                <th >
                                    {{$txnData->remit_fees!="" ? number_format($txnData->remit_fees,2) : "0.00" }}
                                </th>
                            </tr>
                            <tr>
                                <th >
                                    Swift Charge
                                </th>
                                <th >
                                    {{$txnData->swift_charges!="" ? number_format($txnData->swift_charges,2) : "0.00" }}
                                </th>
                            </tr>
                            <tr>
                                <th >
                                    Nostro Charge
                                </th>
                                <th >
                                    {{$txnData->nostro_charge!="" ? number_format($txnData->nostro_charge,2) : "0.00" }}
                                </th>
                            </tr>
                            <tr>
                                <th >
                                    Gross Amount
                                </th>
                                <th >
                                    {{$txnData->gross_payable!="" ? number_format($txnData->gross_payable,2) : "0.00" }}
                                </th>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex mt-5 mb-3">
            <div class="scorecard-title"> Block Rate</div>
        </div>
        <form action="{{route('transactionkyc.update',['id'=>$txnData->txn_number])}}" novalidate="novalidate" id="updateDocForm">
            @csrf
            <input type="hidden" name="txn_number" value="{{ $txnData->txn_number }}">
            <div class="table-responsive-sm table-striped pb-3 ps-0 pe-0 mb-3  ">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <?php
                    /*echo "<pre>";
                    print_r((array)$txnKyc);*/
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table roundedTable dataTable no-footer" style="width: 100%;" aria-describedby="example1_info">
                                <thead style="backgrounD-color: #F4F6F8;">
                                <tr class="bgc-table row-font1">
									 <th  scope="col" class="fw-bold"  >

									      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAll"
                                            name="">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
									 </th>
                                    <th  scope="col" class="fw-bold"  >Sr.No</th>
                                    <th  scope="col" class="fw-bold" >Document</th>
                                    <th  scope="col" class="fw-bold"  >Requirement</th>
                                    <th  scope="col" class="fw-bold text-wrap"  >Uploaded File</th>
                                    {{--<th  scope="col" class="fw-bold text-wrap" >Automation Scorecard</th>--}}
                                    {{--<th  scope="col" class="fw-bold" > Status</th>--}}
                                    <th  scope="col" class="fw-bold w-auto"  > Comment</th>
                                    <th  scope="col" class="fw-bold">Status</th>
                                    <th  scope="col" class="fw-bold"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $cnt = 0; $tmp=0; ?>

                                @if($txnKyc)
                                    @foreach($documents as $key => $val)
                                <tr>
									<td class=""><input type="checkbox"  class="datas"
                                        data-key="{{$key}}" value="{{$txnKyc->id}}"></td>
                                    <td class="">{{++$cnt}}</td>
                                    <td>{{$val}}</td>
                                    <td>Mandatory</td>
                                    <td>

                                        @if(!empty($txnKyc->$key))

                                        <a href="{{asset('upload/allDocuments/').'/'.date('Y-m-d',strtotime($txnData->created_at)).'/'.$txnData->txn_number. '/'.$txnKyc->$key }}"
                                           class="svg-bg m-0 fw-bold view-btn-common disabled" target="_blank">
                                            <i class="fa-solid fa-eye"></i> View &nbsp;</a>
                                        <a href="{{asset('upload/allDocuments/').'/'.date('Y-m-d',strtotime($txnData->created_at)).'/'.$txnData->txn_number. '/'.$txnKyc->$key }}"
                                           class="svg-bg m-0 fw-bold download-btn-common"  download>&nbsp;
                                            <i class="fa-solid fa-download"></i> Download </a>
                                        @else
                                            <span data-toggle="tooltip" data-placement="bottom" title="File Not Uploaded">
                                            <a href="javascript:void(0);"
                                               class="svg-bg m-0 fw-bold view-btn-common isDisabled" >
                                                <i class="fa-solid fa-eye"></i> View &nbsp;</a>
                                            <a href="javascript:void(0);"
                                               class="svg-bg m-0 fw-bold  download-btn-common isDisabled" style=" color:#686cad;">&nbsp;
                                                <i class="fa-solid fa-download"></i> Download </a>
                                            </span>
                                        @endif
                                    </td>
                                    {{--<td class="">
                                       <span style="background-color: #FF9E2E; padding: 2px 38px;">
                                       </span>
                                    </td>--}}
                                    {{--<td class="">
                                        <select class="form-control status" name="passport_status" id="passport_status" disabled>
                                            <option selected="" value="">Select Status</option>
                                            <option value="4">Approve</option>
                                            <option value="2">
                                                Reject
                                            </option>
                                            <option value="3" selected="">
                                                Manual Validation
                                            </option>
                                        </select>
                                    </td>--}}


                                    <td class="w-responsive">
                                        <div class="input-group">
                                            <?php $comment = $key.'_comment'; ?>
                                            <?php $status = $key."_status"; ?>
                                                @if($txnKyc->$status=="")
                                                    @php $tmp=1; @endphp
                                                @endif
                                            <textarea class="form-control comment w-100" id="textarea_{{$key}}" rows="2" name="<?= $key.'_comment' ?>" @if($txnKyc->$status!="") {{"disabled"}} @endif>{{!empty($txnKyc) ? $txnKyc->$comment :""}} </textarea>
                                        </div>
                                        @component('components.ajax-error',['field'=>"$key"."_comment"])@endcomponent
                                    </td>



                                    <td class="w-responsive">
                                        <div class="btn-group">
                                            @if($txnKyc)
                                           		@if($txnKyc->$status == "1")
													<span class="badge badge-pill badge-success comn-approved-btn comn-status-btn" id="doc_status_{{$key}}" data-docStatus = "1">Approve</span>
												@elseif($txnKyc->$status == "2")
													<span class="badge status-danger comn-status-bt comn-status-btnn" id="doc_status_{{$key}}" data-docStatus = "2">Reject</span>
												@else
													<span class="badge status-warning comn-status-btn comn-status-btn" id="doc_status_{{$key}}" data-docStatus = "0">Pending</span>
												@endif
                                            @endif
                                        </div>

                                    </td>
                                    {{--<td class="w-responsive">
                                        <label class="switch">
                                            <input type="hidden" name="<?= $key.'_status' ?>" value="false">
                                            <input type="checkbox" class="switch-input" name="<?= $key.'_status' ?>" value="true">
                                            <!--<i class="icon-play"></i>-->
                                            <span class="switch-label" data-on="Approve" data-off="Reject"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </td>--}}
                                </tr>
                                @endforeach
                                @else
                                <tr class="even">
                                    <td class="sorting_1">Consultancy fees</td>
                                    <td>CONS</td>
                                    <td>CONS</td>
                                    <td>CONS</td>
                                    <td>CONS</td>
                                    <td>CONS</td>
                                    <td class="  r-col-action">
                                      <div class="d-flex gap-3 justify-content">
                                      <label class="switch">
                                            <input type="checkbox" class="switch-input" checked="" onclick="statusChangePurpose(10,1)">
                                            <span class="switch-label" data-on="Match" data-off="Pending"
                                            style="background: #F15922; color: #fff;" ></span>
                                            <span class="switch-handle"></span>
                                      </label>
                                      </div>
                                   </td>
                                   <td class="  r-col-action">
                                        <div class="btn-group action-btn-grp">
                                            <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <div class="action-btn-wrap">
                                                    <button class="action-btn edit-btn" onclick="openManagePurposeModal(15)" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                                    <button class="action-btn delete-btn" onclick="removePurpose(15)" title="Delete">
                                                    <i class="fa-solid fa-trash"></i> Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                               </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="bgc mt-3">
                    <div class="row mt-3 ">
                        {{--<div class="col-lg-3 col-sm-3 mt-3">
                            <label class="">Bordox Number</label>
                            <div class="input-group mb-3">
                                <input class="form-control p-2 bg-transparent" type="text" name="bordox_no" placeholder="Enter Bordox Number" value="Not Use Now" disabled>
                            </div>
                        </div>--}}
                        <div class="col-lg-3 col-sm-4 mt-3">
                            <!-- <label class="">Comment</label> -->
                            <div class="input-group mb-3">
                                <input class="form-control p-2 bg-transparent" type="text" name="kyc_comment" placeholder="Enter Comment" >
                                @component('components.ajax-error',['field'=>'kyc_comment'])@endcomponent
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 mt-3 d-flex align-bottom">
                            <!-- <label class="">Status</label> -->
                            <div class="input-group my-2">
                                <div class="col-sm-4">
                                    <label class="radio-inline d-flex justify-content-center">
                                        <input type="radio" class="qf-radio-sm" name="kyc_status" value="1"><span class="mb-2">
                                        &nbsp; Approve
                                        </span>
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <label class="radio-inline d-flex justify-content-center">
                                        <input type="radio" class="qf-radio-sm" name="kyc_status" value="0">
                                        <span class="mb-2">
                                             &nbsp; Reject
                                        </span>
                                    </label>
                                </div>
                                @component('components.ajax-error',['field'=>'kyc_status'])@endcomponent
                            </div>
                            <div class="text-danger status_error"></div>
                        </div>
                        <div class="col-lg-4 col-sm-4 mt-3">
                        <div class="text-center  ">
                            <button type="submit" class="btn qf-primary-btn px-5 fw-bold text-capitalize m-0"

									>Update</button>
                            <a href="{{route('dashboard.index')}}" class="btn qf-secondary-btn px-5 fw-bold text-capitalize m-0">Back</a>
                        </div>
                    </div>
                    </div>

                </div>
                <!-- Tabs content -->
            </div>
            <footer class="text-center pt-3 pb-3">
                <a href="#">
                    <img src="../assets/img/group.png">
                </a>
            </footer>
        </form>
    </div>
@endsection
@push('pagescript')
    @include('stacks.js.modules.dashboard.kyc')

    <script>
        $('#checkAll').click(function() {
            $('input[name="kyc_status"]').prop('checked', false);
            $('.datas').not(this).prop('checked', this.checked);
        });

        $(".datas").change(function() {
            $('input[name="kyc_status"]').prop('checked', false);
            if ($(this).prop('checked') !== true){ 
                $("#checkAll").prop('checked', false);
            }
            if ($('.datas:checked').length == $('.datas').length) {
                $("#checkAll").prop('checked', true);
            }else{
                $("#checkAll").prop('checked', false);
                $('input[name="kyc_status"]').prop('checked', false);
            }
        });

        $('input[name="kyc_status"]').change(function(){
            
            if ($(this).val() == 1 && $('.datas:checked').length != $('.datas').length) {
                swal({
                    title: "Document approval is pending",
                    text: "",
                    icon: "error",
                    buttons: true,
                    dangerMode: true,
                    buttons:"OK",
                }).then((result) => {});
                $(this).prop('checked', false);
            }
        });

    </script>

@endpush
