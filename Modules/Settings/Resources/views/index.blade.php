@extends('layouts.admin')

@section('content')
    <div class="container pt-5 pb-5 mt-5 mb-5">
            <!-- Tabs navs -->

            <div class="    ">
                <ul class="nav nav-tabs nav-justified  mt-4" id="ex1" role="tablist">
                    <li class="nav-item tab2" role="presentation">
                        <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 active" id="ex3-tab-2"
                           data-mdb-toggle="tab" href="#ex3-tabs-2" role="tab" aria-controls="ex3-tabs-2"
                           aria-selected="true">
                  <span> Manage Branch
                      <br> &nbsp;</span></a>
                    </li>
                    <li class="nav-item tab3" role="presentation">
                            <a class="nav-link fw-bold text-light mt-3 ms-3 me-3" id="ex3-tab-3" data-mdb-toggle="tab"
                               href="#ex3-tabs-3" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                      <span>Manage Purpose
                        <br> &nbsp;</span></a>
                    </li>
                    <li class="nav-item tab4" role="presentation">
                            <a class="nav-link fw-bold text-light mt-3 ms-3 me-3" id="ex3-tab-4" data-mdb-toggle="tab"
                               href="#ex3-tabs-4" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                        <span> Manage Source
                            <br> &nbsp;</span></a>
                    </li>
                    <li class="nav-item tab4" role="presentation">
                        <a class="nav-link fw-bold text-light mt-3 ms-3 me-3" id="ex3-tab-5" data-mdb-toggle="tab"
                           href="#ex3-tabs-5" role="tab" aria-controls="ex3-tabs-5" aria-selected="false">
                        <span> Manage Customers
                            <br> &nbsp;</span></a>
                    </li>
                </ul>
            </div>
            <!-- Tabs navs -->

            <!-- Tabs content -->
            <div class="tab-content" id="ex3-content">

                <div class="tab-pane fade bg-light show active" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
                    <div class="text-center">
                        <div type="button" class="btn-sm btn-secondary float-end mt-3 mb-3" onclick="openAddModal()">
                            <div class="me-3 ms-3"><i class="fa-solid fa-plus"></i> Create Branch ID</div>
                        </div>
                    </div>
                    <div class="table-responsive-sm pt-4 ps-0 pe-0">
                        <table id="agent-table" class="table roundedTable">
                            <thead>
                            <tr class="bgc-table row-font1">
                                <th>Branch Name</th>
                                <th>Email ID</th>
                                <th>Mobile</th>
								<th>Status</th>
                                <th>Action</th>
                                <th>Password</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="container">
                        <div class="d-flex justify-content-center gap-3">
                            <div class="  mt-4 pt-2 text-center">
                                <div type="button" class="btn btn-secondary btn-block " >
                                    <span class=" text-capitalize">Print</span>
                                </div>
                            </div>
                            <div class="  mt-4 pt-2 text-center">
                                <div type="button" class="btn btn-secondary btn-block " >
                            <span class=" text-capitalize">Download
                              </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">
                    <div class="text-center">
                        <div type="button" class="btn-sm btn-secondary float-end mt-3 mb-3" onclick="openManagePurposeModal()">
                            <div class="me-3 ms-3"><i class="fa-solid fa-plus"></i> Add Purpose </div>
                        </div>
                    </div>
                    <div class="table-responsive-sm pt-4 ps-0 pe-0">
                        <table id="manage-purpose-table" class="table roundedTable">
                            <thead>
                                <tr class="bgc-table row-font1">
                                    <th scope="col" class="fw-bold">Purpose</th>
                                    <th scope="col" class="fw-bold">Purpose Code</th>
                                    <th scope="col" class="fw-bold">Required Documents</th>
									<th scope="col" class="fw-bold">Status</th>
                                    <th scope="col" class="fw-bold">Action</th>
                                    {{--<th scope="col" class="fw-bold"></th>--}}
                                </tr>
                            </thead>
                        </table>
                    </div>
                   {{-- <div class="text-center pt-5">
                        <a  href="#" class="text-white"><button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize" >Submit</button></a>
                    </div>--}}
                </div>

                <div class="tab-pane fade" id="ex3-tabs-4"role="tabpanel"aria-labelledby="ex3-tab-4">
                    <div class="text-center">
                        <div type="button" class="btn-sm btn-secondary float-end mt-3 mb-3" onclick="openManageSourceModal()">
                            <div class="me-3 ms-3"><i class="fa-solid fa-plus"></i> Add Source </div>
                        </div>
                    </div>
                    <div class="table-responsive-sm pt-4  ps-0 pe-0">
                        <table id="manage-sources-table"  class="table roundedTable">
                            <thead>
                                <tr class="bgc-table row-font1">
                                    <th scope="col" class="fw-bold">Source</th>
                                    <th scope="col" class="fw-bold">TCS Rate %</th>
                                    <th scope="col" class="fw-bold">Exempt</th>
                                    <th scope="col" class="fw-bold">Status</th>
                                    <th scope="col" class="fw-bold">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    {{--<div class="text-center">
                        <button class="text-white bg-danger   border-0 p-1 rounded-4 " > Add Purpose
                        </button>
                    </div>--}}

                </div>

                <div class="tab-pane fade" id="ex3-tabs-5"role="tabpanel"aria-labelledby="ex3-tab-5">
                    <div class="text-center">
                        <div type="button" class="btn-sm btn-secondary float-end mt-3 mb-3" onclick="openCustomersModal()">
                            <div class="me-3 ms-3"><i class="fa-solid fa-plus"></i> Create Customer </div>
                        </div>
                    </div>
                    <div class="table-responsive-sm pt-4  ps-0 pe-0">
                        <table id="manage-customers-table"  class="table roundedTable">
                            <thead>
                            <tr class="bgc-table row-font1">
                                <th scope="col" class="fw-bold">Name</th>
                                <th scope="col" class="fw-bold">Mobile No</th>
                                {{--<th scope="col" class="fw-bold">Status</th>--}}
                                <th scope="col" class="fw-bold">Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    {{--<div class="text-center">
                        <button class="text-white bg-danger   border-0 p-1 rounded-4 " > Add Purpose
                        </button>
                    </div>--}}

                </div>

            </div>
            <!-- Tabs content -->

        <!-- Modal -->
        <div class="addModals"></div>
    </div>
@endsection

@push('pagescript')
    @include('stacks.js.modules.settings.index')
    @include('stacks.js.modules.settings.purpose')
    @include('stacks.js.modules.settings.sources')
    @include('stacks.js.modules.settings.customers')
@endpush


