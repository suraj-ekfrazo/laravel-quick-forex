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
                            <div class="text-center nav-title">Rate Booking
                                <span class="badge rounded-pill badge-notification bg-danger" id="ratebooking-count">0</span>
                            </div>
                        </div>                    
                    </a>
                </li>

                <li class="nav-item tab10" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 " id="ex3-tab-10" data-mdb-toggle="tab"
                       href="#ex3-tabs-10" role="tab" aria-controls="ex3-tabs-10" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap">
                            <div class="text-center nav-title"> Approved Deals</div>
                        </div>
                        <!-- <span class="badge rounded-pill badge-notification bg-danger" id="approved-deal-table-count">0</span> -->
                    </a>
                </li>
                <li class="nav-item tab2" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 " id="ex3-tab-2"data-mdb-toggle="tab" href="#ex3-tabs-2" role="tab" aria-controls="ex3-tabs-2"aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap" >
                            <div class="text-center nav-title"> KYC 
                                <span class="badge rounded-pill badge-notification bg-danger" id="kyc-status-table-count">0</span>
                            </div>
                        </div>
                    </a>

                </li>
                <li class="nav-item tab5" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3"id="ex3-tab-5" data-mdb-toggle="tab" href="#ex3-tabs-5"  role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap" >
                            <div class="text-center nav-title">Pending Payments
                                <span class="badge rounded-pill badge-notification bg-danger" id="admin-payment-table-count">0</span>
                            </div>
                        </div>
					</a>
                </li>
                <li class="nav-item tab6" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 "id="ex3-tab-6" data-mdb-toggle="tab" href="#ex3-tabs-6"  role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap" >
                            <div class="text-center nav-title">View All Bookings
                                <span class="badge rounded-pill badge-notification bg-danger" id="admin-transaction-table-count">0</span>
                            </div>
                        </div>
                    </a>
                </li>
				<li class="nav-item tab8" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 "id="ex3-tab-8" data-mdb-toggle="tab" href="#ex3-tabs-8"  role="tab" aria-controls="ex3-tabs-8" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap" >
                            <div class="text-center nav-title">Completed Transactions
                                <span class="badge rounded-pill badge-notification bg-danger" id="agent-completed-transaction-table-count">0</span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex3-content">
            <div class="tab-pane fade show active" id="ex3-tabs-7" role="tabpanel" aria-labelledby="ex3-tab-7">
                <div class="box pt-4 bgc ps-0 pe-0">
                    <div class="d-flex justify-content-end gap-3">
                        <span class="pt-2" style="font-size:18px">Refresh</span>
                        <button type="button" class="qf-refresh-btn" onClick="$('#ratebooking').DataTable().ajax.reload(null, false)"><i class="fa fa-refresh"></i></button>
                    </div>
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
                <div class="d-flex justify-content-end gap-3">
                    <div class="mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-secondary-btn btn-block " data-type="kyc" id="print-data">
                            <span class="text-capitalize" >Print</span>
                        </div>
                    </div>
                    <div class="  mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-primary-btn btn-block "  data-type="kyc"  id="export-data">
                            <span class=" text-capitalize">Download</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive-sm pt-4 ps-0 pe-0">
                    <div class="d-flex justify-content-end">
                        <span class="pt-2" style="font-size:18px">Refresh</span>
                        <button type="button" class="qf-refresh-btn" onClick="$('#kyc-status-table').DataTable().ajax.reload(null, false)"><i class="fa fa-refresh"></i></button>
                    </div>
                    <table id="kyc-status-table" class="table roundedTable roundedTable bgc align-middle">
                        <thead>
                        <tr class="bgc-table row-font1">
                            <th scope="col" class="fw-bold">Transaction Number</th>
                            <th scope="col" class="fw-bold">Customer Name </th>
                            <th scope="col" class="fw-bold">Fx Value </th>
                            <th scope="col" class="fw-bold">Transaction type</th>
                            <th scope="col" class="fw-bold">Purpose </th>
                            <th scope="col" class="fw-bold">Doc Upload Date</th>
                            <th scope="col" class="fw-bold">KYC Status</th>
                            <th scope="col" class="fw-bold">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <!-- <div class="d-flex justify-content-center gap-3">
                    <div class="  mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-secondary-btn btn-block " id="print-data" data-type="kyc" >
                            <span class=" text-capitalize">Print</span>
                        </div>
                    </div>
                    <div class="  mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-primary-btn btn-block " id="export-data" data-type="kyc">
                            <span class=" text-capitalize">Download</span>
                            </div>
                            </div>


                        </div>


                    </div>
                </div> -->
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
                <div class="d-flex justify-content-end gap-3">
                    <div class="mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-secondary-btn btn-block " data-type="pending_payment" id="print-data">
                            <span class="text-capitalize" >Print</span>
                        </div>
                    </div>
                    <div class="  mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-primary-btn btn-block "  data-type="pending_payment"  id="export-data">
                            <span class=" text-capitalize">Download</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive-sm pt-4 ps-0 pe-0">
                    <div class="d-flex justify-content-end">
                        <span class="pt-2" style="font-size:18px">Refresh</span>
                        <button type="button" class="qf-refresh-btn" onClick="$('#admin-payment-table').DataTable().ajax.reload(null, false)"><i class="fa fa-refresh"></i></button>
                    </div>
                    <table id="admin-payment-table" class="table roundedTable">
                        <thead>
                            <tr class="bgc-table row-font1">
                                <th scope="col" class="fw-bold">Transaction Number</th>
                                <th scope="col" class="fw-bold">Customer Name</th>
                                <th scope="col" class="fw-bold">Fx Value</th>
                                <th scope="col" class="fw-bold">Type</th>
                                <th scope="col" class="fw-bold">Remitter PAN</th>
                                <th scope="col" class="fw-bold">KYC Status</th>
                                <th scope="col" class="fw-bold">Payment</th>
                                <th scope="col" class="fw-bold">Payment Status</th>
                                <th scope="col" class="fw-bold">Txn Created Date</th>
                                <th scope="col" class="fw-bold">Action</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- <div class="container">
                        <div class="d-flex justify-content-center gap-3">
                            <div class="  mt-4 pt-2 text-center">
                                <div type="button" class="btn qf-secondary-btn btn-block " id="print-data" data-type="pending_payment">
                                    <span class=" text-capitalize">Print</span>
                                </div>
                            </div>
                            <div class="  mt-4 pt-2 text-center">
                                <div type="button" class="btn qf-primary-btn btn-block "  id="export-data" data-type="pending_payment">
                                    <span class=" text-capitalize">Download</span>
                                    </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

           	<div class="tab-pane fade" id="ex3-tabs-6" role="tabpanel"aria-labelledby="ex3-tab-6">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="mb-4 mb-md-2">
                        <div class="accordion mt-3" id="accordionWithIcon">
                            <div class="card accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button qf-bg-blue collapsed" data-bs-toggle="collapse"
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



                                        <div class="col-12 mt-4 mb-4">
                                            <button class="btn btn-primary black-btn minw-136 qf-primary-btn"><i
                                                    class="ti ti-search ti-xs me-2"></i>Search</button>
                                            <a href=""
                                                class="btn transparent-bg-btn qf-secondary-btn">Reset</a>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>

                <div class="d-flex justify-content-end gap-3">
                    <div class="mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-secondary-btn btn-block " data-type="all_transection" id="print-data">
                            <span class="text-capitalize" >Print</span>
                        </div>
                    </div>
                    <div class="  mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-primary-btn btn-block "  data-type="all_transection"  id="export-data">
                            <span class=" text-capitalize">Download</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive box pt-4   bgc ps-0 pe-0">
                    <div class="d-flex justify-content-end">
                        <span class="pt-2" style="font-size:18px">Refresh</span>
                        <button type="button" class="qf-refresh-btn" onClick="$('#admin-transaction-table').DataTable().ajax.reload(null, false)"><i class="fa fa-refresh"></i></button>
                    </div>
                    <table id="admin-transaction-table" class="table   roundedTable border-0  text-center">
                        <thead class=" ">
                            <tr class="bgc-table row-font1">
                                <th scope="col" class="fw-bold">Transaction Number</th>
                                <th scope="col" class="fw-bold">Customer Name</th>
                                <th scope="col" class="fw-bold">Fx Value</th>
                                <th scope="col" class="fw-bold">Type</th>
                                <th scope="col" class="fw-bold">Remitter PAN</th>
                                <th scope="col" class="fw-bold">KYC Status</th>
                                <th scope="col" class="fw-bold">Payment Status</th>
                                <th scope="col" class="fw-bold">Transaction Status</th>
                                <th scope="col" class="fw-bold">Txt Created Date</th>
                                <th scope="col" class="fw-bold">Txn Expiry Date</th>
                                <th scope="col" class="fw-bold">Doc Upload Date</th>
                                <th scope="col" class="fw-bold">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <!-- <div class="pb-5">
                    <div class="text-center    m-1 float-end">
                        <div type="button" class="btn btn-secondary btn-block" id="export-data" data-type="all_transection">
                            <span class="text-capitalize">Download</span>
                            </div>
                            </div>

                        </div>

                    </div>
                    <div class="text-center  m-1 float-end">
                        <button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize"  id="print-data" data-type="all_transection">Print
                        </button></a>
                    </div>
                </div> -->
            </div>

			<div class="tab-pane fade" id="ex3-tabs-8" role="tabpanel" aria-labelledby="ex3-tab-8">

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="mb-4 mb-md-2">
                        <div class="accordion mt-3" id="accordionWithIcon">
                            <div class="card accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button qf-bg-blue collapsed" data-bs-toggle="collapse"
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
                                            <button class="btn btn-primary black-btn minw-136 qf-primary-btn">
                                                <i class="ti ti-search ti-xs me-2"></i>Search
                                            </button>
                                            <a href="" class="btn transparent-bg-btn qf-secondary-btn">Reset</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                        <div class="left-action d-flex ">
                        <div class="mt-4 pt-2 text-left">
                            <div type="button" class="btn qf-primary-btn btn-block " onclick="exportExcel()">
                                <span class=" text-capitalize">Export</span>
                            </div>
                        </div>
                        </div>
                        <div class="right-action d-flex gap-3">
                        <div class="mt-4 pt-2 text-center">
                            <div type="button" class="btn qf-secondary-btn btn-block " data-type="complete_transection" id="print-data">
                                <span class="text-capitalize" >Print</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-2 text-center">
                            <div type="button" class="btn qf-primary-btn btn-block "  data-type="complete_transection"  id="export-data">
                                <span class=" text-capitalize">Download</span>
                            </div>
                        </div>
                        </div>
                    </div>
                <div class="table-responsive box pt-2 bgc ps-0 pe-0">
                    <div class="d-flex justify-content-end">
                        <span class="pt-2" style="font-size:18px">Refresh</span>
                        <button type="button" class="qf-refresh-btn" onClick="$('#agent-completed-transaction-table').DataTable().ajax.reload(null, false)"><i class="fa fa-refresh"></i></button>
                    </div>
                    <table id="agent-completed-transaction-table" class="table roundedTable border-0  text-center">
                        <thead class=" ">
                            <tr class="bgc-table row-font1">
                                <th  scope="col" class="fw-bold"  >
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="downloadAll" name="">
                                        <label class="custom-control-label" for="downloadAll"></label>
                                    </div>
                                </th>
                                <th scope="col" class="fw-bold">Transaction Number</th>
                                <th scope="col" class="fw-bold">Customer Name</th>
                                <th scope="col" class="fw-bold">Fx Value</th>
                                <th scope="col" class="fw-bold">Type</th>
                                <th scope="col" class="fw-bold">Remitter PAN</th>
                                <th scope="col" class="fw-bold">KYC Status</th>
                                <th scope="col" class="fw-bold">Payment Status</th>
                                <th scope="col" class="fw-bold">Transaction Status</th>
								<th scope="col" class="fw-bold">Payment Mode</th>
                                <th scope="col" class="fw-bold">LRS Doc</th>
                                <th scope="col" class="fw-bold">Txn Date</th>
                                <th scope="col" class="fw-bold">Txn Time</th>
                                <th scope="col" class="fw-bold">Txn Expiry Date</th>
                                <th scope="col" class="fw-bold">Doc Upload Date</th>
                                <th scope="col" class="fw-bold">Doc Upload Time</th>
                                <th scope="col" class="fw-bold">Completed Date</th>
                                <th scope="col" class="fw-bold">Completed Time</th>
                                <th scope="col" class="fw-bold">Swift Upload</th>
                                <th scope="col" class="fw-bold">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <!-- <div class="pb-5">
                    <div class="text-center m-1 float-end">
                        <button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize"
                        data-type="complete_transection"
                        id="export-data">Download</button>
                    </div>
                    <div class="text-center m-1 float-end">

                    <button type="button" data-type="complete_transection" class="btn btn-secondary px-5 fw-bold text-capitalize" id="print-data" >Print</button>
                    </div>
                </div> -->

            </div>

            <div class="tab-pane fade" id="ex3-tabs-10" role="tabpanel" aria-labelledby="ex3-tab-10">
                <div class="d-flex justify-content-end gap-3">
                    <div class="mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-secondary-btn btn-block " data-type="approved_deals" id="print-data">
                            <span class="text-capitalize" >Print</span>
                        </div>
                    </div>
                    <div class="  mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-primary-btn btn-block "  data-type="approved_deals"  id="export-data">
                            <span class=" text-capitalize">Download</span>
                        </div>
                    </div>
                </div>

                <div class="table-responsive box pt-4 bgc ps-0 pe-0">
                    <div class="d-flex justify-content-end">
                        <span class="pt-2" style="font-size:18px">Refresh</span>
                        <button type="button" class="qf-refresh-btn" onClick="$('#approved-deal-table').DataTable().ajax.reload(null, false)"><i class="fa fa-refresh"></i></button>
                    </div>
                    <table id="approved-deal-table" class="table roundedTable border-0 text-center">
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
                                <th scope="col" class="fw-bold">Created Date</th>
                                <th scope="col" class="fw-bold">Updated Date</th>
                                <th scope="col" class="fw-bold">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <!-- <div class="container">
                    <div class="d-flex justify-content-center gap-3">
                        <div class="mt-4 pt-2 text-center">
                            <div type="button" class="btn qf-secondary-btn btn-block " data-type="approved_deals" id="print-data">
                                <span class="text-capitalize" >Print</span>
                            </div>
                        </div>
                        <div class="  mt-4 pt-2 text-center">
                            <div type="button" class="btn qf-primary-btn btn-block "  data-type="approved_deals"  id="export-data">
                                <span class=" text-capitalize">Download</span>
                            </div>
                        </div>
                    </div>
                </div> -->
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
            if ($("input[name='downloadIdList']:checked").length > 0) {
                var transaction_Ids = [];
                $.each($("input[name='downloadIdList']:checked"), function() {
                    transaction_Ids.push($(this).attr('data-key'));
                });

                $.ajax({
                    url: "{!! route('exportData.csv') !!}",
                    type: 'POST',
                    contentType: "application/json",
                    data: JSON.stringify({"downloadIdList": transaction_Ids}),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        window.location.href = result.data.path;
                    }
                });

            }else{
                swal({
                    title: "Please select rows to export",
                    text: "",
                    icon: "error",
                    buttons: true,
                    dangerMode: true,
                    buttons:"OK",
                }).then((result) => {});
            }
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
