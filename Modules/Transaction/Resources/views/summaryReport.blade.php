@extends('layouts.admin')

@section('content')

    <div class="container transaction-content">
        <div class="d-flex justify-content-center pt-4 pb-1">
            <div class="d-flex">
                <div class="qf-title-lg mb-4">Summary Report</div>
            </div>
        </div>
        <div class="mt-6 tab-container">
            <ul class="nav nav-tabs qf-nav-tabs" id="ex1" role="tablist" style="justify-content: space-around;">
                <li class="nav-item tab1" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 active" id="sumReport-tab-1" data-mdb-toggle="tab" 
                        href="#sumReport-tabs-1" role="tab" aria-controls="sumReport-tabs-1" aria-selected="true">
                        <div class="d-flex gap-4 justify-content-center align-items-center qf-inner-wrap" >
                            <div class="text-center nav-title">Transaction Wise</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item tab2" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 " id="sumReport-tab-2" data-mdb-toggle="tab"
                        href="#sumReport-tabs-2" role="tab" aria-controls="sumReport-tabs-2" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center qf-inner-wrap">
                            <div class="text-center nav-title">Branch User Wise</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

        <!-- tab content -->
        <div class="tab-content" id="ex3-content">

            <div class="tab-pane fade show active" id="sumReport-tabs-1" role="tabpanel" aria-labelledby="sumReport-tab-1">
                
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="mb-4 mb-md-2">
                        <div class="accordion mt-3" id="accordionWithIcon">
                            <div class="card accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button qf-bg-blue" data-bs-toggle="collapse"
                                        data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="ti ti-search ti-xs me-2"></i>
                                        Search
                                    </button>
                                </h2>
                                <div id="accordionWithIcon-1" class="accordion-collapse">
                                    <form class="form-horizontal form-material mb-0" id="transaction_statusreport" action="{{ route('admin-transaction.filterReportSummary') }}">
                                        <div class="accordion-body row">
                                            <div class="col-md-4">
                                                <label for="defaultFormControlInput" class="form-label">Search By Created Date</label>
                                                <input type="text" class="form-control datefilter qf-secondary-input" placeholder="MM/DD/YYYY - MM/DD/YYYY"
                                                    name="transaction_statusreport_daterange" id="transaction_statusreport_daterange" value=""/>
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

                <div class="d-flex justify-content-end gap-3">
                    <div class="  mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-primary-btn btn-block" onClick="adminTransactionStatusExportExcel()">
                            <span class=" text-capitalize">Download</span>
                        </div>
                    </div>
                </div>
            
                <div class="table-responsive box pt-2 bgc ps-0 pe-0">
                    <div class="dataTables_wrapper no-footer">
                        <table id="admin-transaction-status-report" class="table roundedTable dataTable no-footer">
                            <thead class="">
                                <tr class="bgc-table row-font">
                                    <th scope="col" >Transaction Type</th>
                                    <th scope="col" class="fw-bold" style="text-align: center !important">Incident Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Transaction Created</td>
                                    <td id="total">{{$data['total']}}</td>
                                </tr>
                                <tr>
                                    <td>Total Approved</td>
                                    <td id="approved">{{$data['approved']}}</td>
                                </tr>
                                <tr>
                                    <td>Total KYC Rejected</td>
                                    <td id="kyc_rejected">{{$data['kyc_rejected']}}</td>
                                </tr>
                                <tr>
                                    <td>Total Payment Rejected</td>
                                    <td id="payment_rejected">{{$data['payment_rejected']}}</td>
                                </tr>
                                <tr>
                                    <td>Total KYC Pending</td>
                                    <td id="kyc_pending">{{$data['kyc_pending']}}</td>
                                </tr>
                                <tr>
                                    <td>Total Payment Pending</td>
                                    <td id="payment_pending">{{$data['payment_pending']}}</td>
                                </tr>
                                <tr>
                                    <td>Total Swift Pending</td>
                                    <td id="swift_pending">{{$data['swift_pending']}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="sumReport-tabs-2" role="tabpanel" aria-labelledby="sumReport-tab-2">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="mb-4 mb-md-2">
                        <div class="accordion mt-3" id="accordionWithIcon">
                            <div class="card accordion-item active">
                                <h2 class="accordion-header d-flex align-items-center">
                                    <button type="button" class="accordion-button qf-bg-blue" data-bs-toggle="collapse"
                                        data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                                        <i class="ti ti-search ti-xs me-2"></i>
                                        Search
                                    </button>
                                </h2>
                                <div id="accordionWithIcon-1" class="accordion-collapse">
                                    <form class="form-horizontal form-material mb-0" id="branchuserwise-report-form">
                                        <div class="accordion-body row">
                                            <div class="col-md-4">
                                                <label for="defaultFormControlInput" class="form-label">Search By Created Date</label>
                                                <input type="text" class="form-control datefilter qf-secondary-input" placeholder="MM/DD/YYYY - MM/DD/YYYY"
                                                    name="daterange" value=""/>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="defaultFormControlInput" class="form-label">Search By Agent</label>
                                                <select class="form-control select2 form-select qf-primary-select"  name="branch_user_id" id="branch_user_id">
                                                    <option value="">Select Agent</option>
                                                    @foreach ($branchWiseUser_List as $agentData)
                                                        <option value="{{$agentData->id}}">{{$agentData->first_name}} {{$agentData->last_name}}</option>
                                                    @endforeach
                                                </select>
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
                
                <div class="d-flex justify-content-end gap-3">
                    <div class="  mt-4 pt-2 text-center">
                        <div type="button" class="btn qf-primary-btn btn-block" onClick="adminBranchTransactionExportExcel()">
                            <span class=" text-capitalize">Download</span>
                        </div>
                    </div>
                </div>

                <div class="table-responsive box pt-2 bgc ps-0 pe-0">
                        <div class="dataTables_wrapper no-footer">
                            <table id="admin-transaction-branch-user-wise-report" class="table roundedTable dataTable no-footer">
                                <thead class="">
                                    <tr class="bgc-table row-font">
                                        <th scope="col" >Agent Name</th>
                                        <th scope="col" >Branch Name</th>
                                        <th scope="col" >Transaction Created</th>
                                        <th scope="col" >Approved</th>
                                        <th scope="col" >KYC Rejected</th>
                                        <th scope="col" >Payment Rejected</th>
                                        <th scope="col" >KYC Pending</th>
                                        <th scope="col" >Payment Pending</th>
                                        <th scope="col" class="fw-bold" style="text-align: center !important">Swift Pending</th>
                                    </tr>
                                </thead>
                               <style>.even td:last-child, .odd td:last-child{text-align:center !important }</style>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('pagescript')

    @include('stacks.js.modules.dashboard.branch-wise-transaction-report')

    <script>
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
    </script>
    <script>
        $(document).ready(function() {
            // Handle the form submission
            $('#transaction_statusreport').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission
                var data = new FormData(this);

                // Make the AJAX request
                $.ajax({
                    url: $(this).attr("action"),
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Update the report with the filtered data
                        $('#total').text(response.data.total);
                        $('#approved').text(response.data.approved);
                        $('#kyc_rejected').text(response.data.kyc_rejected);
                        $('#payment_rejected').text(response.data.payment_rejected);
                        $('#kyc_pending').text(response.data.kyc_pending);
                        $('#payment_pending').text(response.data.payment_pending);
                        $('#swift_pending').text(response.data.swift_pending);
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseText);
                    }
                });
            });

        });

        function adminTransactionStatusExportExcel() {
            var daterange = $("#transaction_statusreport_daterange").val();
            $.ajax({
                url: "{!! route('admin-transaction-status-exportData.csv') !!}",
                type: 'POST',
                contentType: "application/json",
                data: JSON.stringify({"daterange": daterange}),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    window.location.href = result.data.path;
                }
            });
        }

        function adminBranchTransactionExportExcel() {
            var daterange = $("#daterange").val();
            var branch_user_id = $("#branch_user_id").val();
            $.ajax({
                url: "{!! route('admin-transaction-branch-wise-exportData.csv') !!}",
                type: 'POST',
                contentType: "application/json",
                data: JSON.stringify({"daterange": daterange, "branch_user_id" : branch_user_id}),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    window.location.href = result.data.path;
                }
            });
        }

    </script>

@endpush
