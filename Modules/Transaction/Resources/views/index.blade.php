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
                        <div class="text-light text-center" style="font-size :24px; flex: 0.8; font-weight: 600;">Transactions</div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="container transaction-content">
        <!-- Tabs navs -->
        <div class="mt-5 tab-container">
            <ul class="nav nav-tabs qf-nav-tabs" id="ex1" role="tablist">
                <li class="nav-item tab3" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 active" id="ex3-tab-7" data-mdb-toggle="tab" href="#ex3-tabs-7"  role="tab" aria-controls="ex3-tabs-7" aria-selected="true">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap" >
                            <div class="text-center nav-title">Rate Booking</div>
                        </div>
                        <!--<span class="badge rounded-pill badge-notification bg-danger">3</span>-->
                    </a>
                </li>

                <li class="nav-item tab10" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 " id="ex3-tab-10" data-mdb-toggle="tab"
                       href="#ex3-tabs-10" role="tab" aria-controls="ex3-tabs-10" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap">
                            <div>

                            </div>
                            <div class="text-center nav-title"> Approved Deals</div>
                        </div>

                    </a>
                </li>
                <!--<li class="nav-item tab3" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 "id="ex3-tab-3" data-mdb-toggle="tab" href="#ex3-tabs-3"  role="tab" aria-controls="ex3-tabs-3" aria-selected="true">
                        <div class="d-flex gap-2 justify-content-center align-items-center" >

                            <div class="text-center">Transaction<br>Status</div>
                        </div>
                        <span class="badge rounded-pill badge-notification bg-danger">3</span>
                    </a>
                </li>-->
                <li class="nav-item tab2" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 " id="ex3-tab-2"data-mdb-toggle="tab" href="#ex3-tabs-2" role="tab" aria-controls="ex3-tabs-2"aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap" >
                            <div>
                                <!-- <i class="fa-regular fa-square-plus fs-4"></i>  -->
                            </div>
                            <div class="text-center nav-title"> KYC </div>
                        </div>
                        <!--<span class="badge rounded-pill badge-notification bg-danger">1</span>-->
                    </a>

                </li>
                {{--<li class="nav-item tab4" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3"id="ex3-tab-4" data-mdb-toggle="tab" href="#ex3-tabs-4"  role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap" >
                            <div>
                                <!-- <i class="fa-regular fa-square-plus fs-4"></i>  -->
                            </div>
                            <div class="text-center nav-title">Rate Blocked</div>
                        </div>
                        <!--<span class="badge rounded-pill badge-notification bg-danger">2</span>-->
                    </a>
                </li>--}}
                <li class="nav-item tab5" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3"id="ex3-tab-5" data-mdb-toggle="tab" href="#ex3-tabs-5"  role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap" >
                            <div>
                                <!-- <i class="fa-regular fa-square-plus fs-4"></i>  -->
                            </div>
                            <div class="text-center nav-title">Pending Payments</div>
                        </div>
                        <!--<span class="badge rounded-pill badge-notification bg-danger">5</span>-->
						</a>
                </li>
                <li class="nav-item tab6" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 "id="ex3-tab-6" data-mdb-toggle="tab" href="#ex3-tabs-6"  role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap" >
                            <div>
                                <!-- <i class="fa-regular fa-square-plus fs-4"></i>  -->
                            </div>
                            <div class="text-center nav-title">View All Bookings</div>
                        </div>
                        <!--<span class="badge rounded-pill badge-notification bg-danger">15</span>-->
                    </a>
                </li>
				<li class="nav-item tab8" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 "id="ex3-tab-8" data-mdb-toggle="tab" href="#ex3-tabs-8"  role="tab" aria-controls="ex3-tabs-8" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap" >
                            <div>
                                <!-- <i class="fa-regular fa-square-plus fs-4"></i>  -->
                            </div>
                            <div class="text-center nav-title">Completed Transactions</div>
                        </div>
                        <!--<span class="badge rounded-pill badge-notification bg-danger">15</span>-->
                    </a>
                </li>
            </ul>
        </div>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex3-content">
            <div class="tab-pane fade show active" id="ex3-tabs-7" role="tabpanel" aria-labelledby="ex3-tab-7">
                <div class="box pt-4 bgc ps-0 pe-0">
                <table id="ratebooking" class="table roundedTable roundedTable bgc align-middle">
                    <thead class="">
                        <tr class="bgc-table row-font1">
                            <th scope="col" class="fw-bold">Reference Number</th>
                            <th scope="col" class="fw-bold">Branch</th>
                            <th scope="col" class="fw-bold">FX Currency</th>
                            <th scope="col" class="fw-bold">FX Value</th>
                            <th scope="col" class="fw-bold">Booking Purpose</th>
                            <th scope="col" class="fw-bold">Transaction Type</th>
                            <th scope="col" class="fw-bold">Assign Deal Rate</th>
                            <th scope="col" class="fw-bold">Assign Deal ID</th>
                            <th scope="col" class="fw-bold">Created DateTime</th>
                            <th scope="col" class="fw-bold">Action</th>
                            <th scope="col" class="fw-bold"></th>
                        </tr>
                    </thead>
                </table>
                </div>

            </div>
            <div class="tab-pane fade  bg-white" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">
            </div>
            <div class="tab-pane fade  bg-light" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">

                <div class="table-responsive-sm box pt-4   ps-0 pe-0">
                    <table  id="transaction-status-table" class="table roundedTable bgc align-middle">
                        <thead>
                        <tr class="bgc-table row-font1">
                            <th scope="col" class="fw-bold text-wrap">Transaction Number</th>
                            <th scope="col" class="fw-bold text-wrap">Customer Name</th>
                            <th scope="col" class="fw-bold">Currency  </th>
                            <th scope="col" class="fw-bold">Amount</th>
                            <th scope="col" class="fw-bold text-wrap">Date time Transaction created</th>
                            <th scope="col" class="fw-bold text-wrap">Created by</th>
                            {{--<th scope="col" class="fw-bold"> Assign Deal Rate</th>
                            <th scope="col" class="fw-bold"> Assign Deal ID</th>
                            <th scope="col" class="fw-bold text-wrap"> Confirm Button</th>--}}
                        </tr>
                        </thead>
                    </table>

                </div>
                <!-- <div class="text-center pt-5">
                  <a  href="#" class="text-white"><button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize" >Submit</button></a>
                   </div> -->
            </div>

            <div class="tab-pane fade" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">

                <div class="table-responsive-sm pt-4 ps-0 pe-0">
                    <table id="kyc-status-table" class="table roundedTable roundedTable bgc align-middle">
                        <thead>
                        <tr class="bgc-table row-font1">
                            <th scope="col" class="fw-bold">Transaction Number</th>
                            <th scope="col" class="fw-bold">Customer Name </th>
                            <th scope="col" class="fw-bold">Transaction type</th>
                            <th scope="col" class="fw-bold">Purpose </th>
                            <th scope="col" class="fw-bold">KYC Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <div class="  mt-4 pt-2 text-center">
                        <div type="button" class="btn btn-secondary btn-block " id="print-data" data-type="kyc" >
                            <span class=" text-capitalize">Print</span>
                        </div>
                    </div>
                    <div class="  mt-4 pt-2 text-center">

                            <div type="button" class="btn btn-secondary btn-block " id="export-data" data-type="kyc">
                            <span class=" text-capitalize">Download</span>
                            </div>


                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="ex3-tabs-4"role="tabpanel"aria-labelledby="ex3-tab-4">
                <div class="table-reponsive box pt-4   bgc ps-0 pe-0">
                    <table id="rate-blocked-table" class="table   roundedTable border-0   "  >
                        <thead class=" ">
                        <tr class="bgc-table  row-font1">
                            <th scope="col" class="fw-bold text-wrap">Transaction Number  </th>
                            <th scope="col" class="fw-bold text-wrap">Deal ID</th>
                            <th scope="col" class="fw-bold text-wrap">Customer Name  </th>
                            <th scope="col" class="fw-bold">Currency </th>
                            <th scope="col" class="fw-bold">Amount</th>
                            <th scope="col" class="fw-bold">Deal Rate  </th>
                            <th scope="col" class="fw-bold text-wrap">Created by </th>
                            <th scope="col" class="fw-bold text-wrap">Booked by </th>
                            <th scope="col" class="fw-bold">Booking Time</th>
                            <th scope="col" class="fw-bold">KYC Status</th>
                            <th scope="col" class="fw-bold text-wrap">Payment Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>

                <div class="table-responsive-sm pt-4   ps-0 pe-0">
                    <table class="table roundedTable bgc align-middle w-auto   "  >
                        <tr class="bgc-table row-font1">
                            <th scope="col" class="fw-bold"  >Currency  </th>
                            <th scope="col" class="fw-bold">Amount</th>

                        </tr>
                        <tbody class="">
                        <tr class="  ">
                            <th scope="row">CAD
                            </th>
                            <td>1500</td>

                        </tr>
                        <tr class="  ">
                            <th scope="row">USD
                            </th>
                            <td>500</td>

                        </tr>
                        <tr class="  ">
                            <th scope="row">THB
                            </th>
                            <td>10000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="pb-5">
                    <div class="text-center    m-1 float-end">
                        <a  href="#" class="text-white "><button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize" >Download</button></a>
                    </div>
                    <div class="text-center  m-1 float-end">
                        <a  href="#" class="text-white"><button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize" >Print</button></a>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="ex3-tabs-5"role="tabpanel"aria-labelledby="ex3-tab-5">
                <div class="table-responsive-sm pt-4   ps-0 pe-0">
                    <table id="admin-payment-table" class="table roundedTable">
                        <thead>
                            <tr class="bgc-table row-font1">
                                <th scope="col" class="fw-bold">Transaction Number</th>
                                <th scope="col" class="fw-bold">Customer Name</th>
                                <th scope="col" class="fw-bold">Type</th>
                                <th scope="col" class="fw-bold">Remitter PAN</th>
                                <th scope="col" class="fw-bold">KYC Status</th>
                                <th scope="col" class="fw-bold">Payment</th>
                                <th scope="col" class="fw-bold">Payment Status</th>
                                <th scope="col" class="fw-bold">Action</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="container">
                        <div class="d-flex justify-content-center gap-3">
                            <div class="  mt-4 pt-2 text-center">
                                <div type="button" class="btn btn-secondary btn-block " id="print-data" data-type="pending_payment">
                                    <span class=" text-capitalize">Print</span>
                                </div>
                            </div>
                            <div class="  mt-4 pt-2 text-center">
                                    <div type="button" class="btn btn-secondary btn-block "  id="export-data" data-type="pending_payment">
                                    <span class=" text-capitalize">Download</span>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

           	<div class="tab-pane fade" id="ex3-tabs-6" role="tabpanel"aria-labelledby="ex3-tab-6">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="mb-4 mb-md-2">
                        <div class="accordion mt-3" id="accordionWithIcon">
                            <div class="card accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="ti ti-search ti-xs me-2"></i>
                                        Search
                                    </button>
                                </h2>

                                <div id="accordionWithIcon-1" class="accordion-collapse collapse">
                                    <form class="form-horizontal form-material mb-0" id="filter_form">

                                        <div class="accordion-body row">
                                            <div class="col-md-4">
                                                <label for="defaultFormControlInput" class="form-label">Search By Customer</label>
                                                <select class="form-control select2 form-select qf-primary-select"  name="customer_id" id="customer_id">
                                                    <option value="">Select Customer</option>
                                                    @foreach ($customer as $data)
                                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="col-md-4">
                                                <label for="defaultFormControlInput" class="form-label">Search By  Agent</label>
                                                <select class="form-control select2 form-select qf-primary-select"  name="agent_id" id="agent_id">
                                                    <option value="">Select Agent</option>
                                                    @foreach ($agent as $data)
                                                    <option value="{{$data->id}}">{{$data->first_name}} {{$data->last_name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="col-md-4">
                                                <label for="defaultFormControlInput" class="form-label">Search By Created Date</label>
                                                <input type="text" class="form-control datefilter qf-secondary-input" name="booking_datefilter"
                                                    value=""/>
                                            </div>

                                        </div>



                                        <div class="col-12 mt-2 mb-2">
                                            <button class="btn btn-primary black-btn minw-136"><i
                                                    class="ti ti-search ti-xs me-2"></i>Search</button>
                                            <a href=""
                                                class="btn btn-warning transparent-bg-btn">Reset</a>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>

                <div class="table-reponsive box pt-4   bgc ps-0 pe-0">
                    <table id="admin-transaction-table" class="table   roundedTable border-0  text-center">
                        <thead class=" ">
                            <tr class="bgc-table row-font1">
                                <th scope="col" class="fw-bold">Transaction Number</th>
                                <th scope="col" class="fw-bold">Customer Name</th>
                                <th scope="col" class="fw-bold">Type</th>
                                <th scope="col" class="fw-bold">Remitter PAN</th>
                                <th scope="col" class="fw-bold">KYC Status</th>
                                <th scope="col" class="fw-bold">Payment Status</th>
                                <th scope="col" class="fw-bold">Transaction Status</th>
                                <th scope="col" class="fw-bold">Deal Expiry Date</th>
                                <th scope="col" class="fw-bold">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="pb-5">
                    <div class="text-center    m-1 float-end">

                            <div type="button" class="btn btn-secondary btn-block" id="export-data" data-type="all_transection">
                            <span class="text-capitalize">Download</span>
                            </div>

                    </div>

                    <div class="text-center  m-1 float-end">
                        <button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize"  id="print-data" data-type="all_transection">Print
                        </button></a>
                    </div>
                </div>
            </div>

			<div class="tab-pane fade" id="ex3-tabs-8" role="tabpanel" aria-labelledby="ex3-tab-8">

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="mb-4 mb-md-2">
                        <div class="accordion mt-3" id="accordionWithIcon">
                            <div class="card accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="ti ti-search ti-xs me-2"></i>
                                        Search
                                    </button>
                                </h2>

                                <div id="accordionWithIcon-1" class="accordion-collapse collapse">
                                    <form class="form-horizontal form-material mb-0" id="complete_filter_form">

                                        <div class="accordion-body row">
                                            <div class="col-md-4">
                                                <label for="defaultFormControlInput" class="form-label">Search By Customer</label>
                                                <select class="form-control select2 form-select qf-primary-select"  name="complete_customer_id" id="complete_customer_id">
                                                    <option value="">Select Customer</option>
                                                    @foreach ($customer as $data)
                                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="col-md-4">
                                                <label for="defaultFormControlInput" class="form-label">Search By  Agent</label>
                                                <select class="form-control select2 form-select qf-primary-select"  name="complete_agent_id"
                                                id="complete_agent_id">
                                                    <option value="">Select Agent</option>
                                                    @foreach ($agent as $data)
                                                    <option value="{{$data->id}}">{{$data->first_name}} {{$data->last_name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="col-md-4">
                                                <label for="defaultFormControlInput" class="form-label">Search By Created Date</label>
                                                <input type="text" class="form-control datefilter qf-secondary-input"
                                                name="complete_datefilter"
                                                    value=""/>
                                            </div>

                                        </div>



                                        <div class="col-12 mt-2 mb-2">
                                            <button class="btn btn-primary black-btn minw-136"><i
                                                    class="ti ti-search ti-xs me-2"></i>Search</button>
                                            <a href=""
                                                class="btn btn-warning transparent-bg-btn">Reset</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-reponsive box pt-4 bgc ps-0 pe-0">
                    <table id="agent-completed-transaction-table" class="table roundedTable border-0  text-center">
                        <thead class=" ">
                            <tr class="bgc-table row-font1">
                                <th scope="col" class="fw-bold">Transaction Number</th>
                                <th scope="col" class="fw-bold">Customer Name</th>
                                <th scope="col" class="fw-bold">Type</th>
                                <th scope="col" class="fw-bold">Remitter PAN</th>
                                <th scope="col" class="fw-bold">KYC Status</th>
                                <th scope="col" class="fw-bold">Payment Status</th>
                                <th scope="col" class="fw-bold">Transaction Status</th>
								  <th scope="col" class="fw-bold">Payment Mode</th>
                                <th scope="col" class="fw-bold">Deal Expiry Date</th>
                                <th scope="col" class="fw-bold">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="pb-5">
                    <div class="text-center m-1 float-end">
                        <button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize"
                        data-type="complete_transection"
                        id="export-data">Download</button>
                    </div>
                    <div class="text-center m-1 float-end">

                    <button type="button" data-type="complete_transection" class="btn btn-secondary px-5 fw-bold text-capitalize" id="print-data" >Print</button>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="ex3-tabs-10" role="tabpanel" aria-labelledby="ex3-tab-10">
                <div class="table-reponsive box pt-4   bgc ps-0 pe-0">
                    <table id="approved-deal-table" class="table   roundedTable border-0  text-center ">
                        <thead class=" ">
                        <tr class="bgc-table  row-font1">
                            <th scope="col" class="fw-bold">Reference Number</th>
                            <th scope="col" class="fw-bold">Agent Name</th>
                            <th scope="col" class="fw-bold">Currency</th>
                            <th scope="col" class="fw-bold">Value</th>
                            <th scope="col" class="fw-bold">Purpose</th>
                            <th scope="col" class="fw-bold">Transection Type</th>
                            <th scope="col" class="fw-bold">Rate</th>
                            <th scope="col" class="fw-bold">Deal ID</th>
                            <th scope="col" class="fw-bold">Expiry Date</th>
                        </tr>
                        </thead>
                    </table>
                </div>

                <div class="container">
                    <div class="d-flex justify-content-center gap-3">
                        <div class="mt-4 pt-2 text-center">
                            <div type="button" class="btn btn-secondary btn-block " data-type="approved_deals" id="print-data">
                                <span class="text-capitalize" >Print</span>
                            </div>
                        </div>
                        <div class="  mt-4 pt-2 text-center">
                                <div type="button" class="btn btn-secondary btn-block "  data-type="approved_deals"  id="export-data">
                                <span class=" text-capitalize">Download</span>
                                </div>

                        </div>
                    </div>


            </div>

        </div>
        <!-- Tabs content -->
    </div>
<!-- Dynamic Modal -->
    <div class="addModals"></div>
@endsection
@push('pagescript')
    @include('stacks.js.modules.dashboard.ratebooking')
    @include('stacks.js.modules.dashboard.transactionstatus')
    @include('stacks.js.modules.dashboard.kyc')
    @include('stacks.js.modules.dashboard.payment')
    @include('stacks.js.modules.dashboard.approved-deal')

	<script>

        $(document).ready(function() {
            $('.select2').select2();
        });
            $(function() {
                $('.datefilter').daterangepicker({
                  autoUpdateInput: false,
                  locale: {
                      cancelLabel: 'Clear'
                  }
                });

                $('.datefilter').on('apply.daterangepicker', function(ev, picker) {
                  $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                });

                $('.datefilter').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

            });

        function exportExcel() {
            var data = {};
            data['from_date'] = $('#from_date').val();
            data['to_date'] = $('#to_date').val();
            $.ajax({
                url: "{!! route('exportData.csv') !!}",
                type: 'POST',
                contentType: "application/json",
                data: JSON.stringify(data),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    window.location.href = result.data.path;
                }
            });
        }



        $(document).on('click',"#print-data",function(evt){
            var type            =  $(this).attr('data-type');
            if(type == 'all_transection'){
                var agent_id    =   $('select[name=agent_id] option:selected').val();
                var customer_id =  $('select[name=customer_id] option:selected').val();
                var datefilter  =  $('input[name=booking_datefilter]').val();
                var exportUrl   =  "{{ route('data.print')}}?type="+type+"&agent_id="+agent_id+'&customer_id='+customer_id+'&datefilter='+datefilter;
            }else if(type == 'complete_transection'){
                var agent_id    =   $('select[name=complete_agent_id] option:selected').val();
                var customer_id =  $('select[name=complete_customer_id] option:selected').val();
                var datefilter  =  $('input[name=complete_datefilter]').val();
                var exportUrl   =  "{{ route('data.print')}}?type="+type+"&agent_id="+agent_id+'&customer_id='+customer_id+'&datefilter='+datefilter;
            }else{
                var exportUrl   =  "{{ route('data.print')}}?type="+type;
            }
            $.ajax({
            url: exportUrl,
                type: 'GET',
                success: function(result) {
                newWin= window.open("");
                newWin.document.write(result);
                newWin.print();
                newWin.close();
                }
            });
        });


        $(document).on('click',"#export-data",function(evt){
            var type        =  $(this).attr('data-type');
            if(type == 'all_transection'){
                var agent_id    =   $('select[name=agent_id] option:selected').val();
                var customer_id =  $('select[name=customer_id] option:selected').val();
                var datefilter  =  $('input[name=booking_datefilter]').val();
                var exportUrl   =  "{{ route('data.export')}}?type="+type+"&agent_id="+agent_id+'&customer_id='+customer_id+'&datefilter='+datefilter;
            }else if(type == 'complete_transection'){
                var agent_id    =   $('select[name=complete_agent_id] option:selected').val();
                var customer_id =  $('select[name=complete_customer_id] option:selected').val();
                var datefilter  =  $('input[name=complete_datefilter]').val();
                var exportUrl   =  "{{ route('data.export')}}?type="+type+"&agent_id="+agent_id+'&customer_id='+customer_id+'&datefilter='+datefilter;
            }else{
                var exportUrl   =  "{{ route('data.export')}}?type="+type;
            }

            window.location.href = exportUrl;
        });

    </script>
@endpush
