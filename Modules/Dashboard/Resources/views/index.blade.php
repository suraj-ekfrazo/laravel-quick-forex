@extends('layouts.admin')

@section('content')
    <div class="w-100 bg-cover flickity-cell is-selected banner">
        <div class="bg-dark-20">
            <div class=" container d-flex  ">
                <div class="row align-items-center justify-content-end height-text ">
                    <div class=" col-12  ">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row   pb-5">
            <div class="col-md-6 col-lg-4 col-sm-12">
                <a href="{{route('admin-user.index')}}" class="text-decoration-none">
                    <div class="widget-stat card bg-dashboard m-3">
                        <div class="card-body ">
                            <div class="media">
                            <span class="me-3">
                                <img src="../assets/img/icon/admin.png" class="img-fluid" width="35px">
                            </span>
                                <div class="fw-bold">Admin
                                </div>
                                <div class="media-body text-white text-end">
                                    <h3 class="" style="color: #2565ab;"><i class="fa-solid fa-angle-right"></i></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-12">
                <a href="{{route('branch.index')}}" class="text-decoration-none">
                    <div class="widget-stat card bg-dashboard m-3">
                        <div class="card-body ">
                            <div class="media">
                              <span class="me-3">
                                  <img src="../assets/img/icon/brach.png" class="img-fluid" width="35px">
                              </span>
                                <div class=" fw-bold">Branch</div>
                                <div class="media-body text-white text-end">
                                    <h3 style="color: #2565ab;"><i class="fa-solid fa-angle-right"></i></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-12">
                <a href="{{route('customer.index')}}" class="text-decoration-none">
                    <div class="widget-stat card bg-dashboard m-3">
                        <div class="card-body ">
                            <div class="media">
                              <span class="me-3">
                                  <img src="../assets/img/icon/customer.png" class="img-fluid" width="35px">
                              </span>
                                <div class=" fw-bold">Customer</div>
                                <div class="media-body text-white text-end">
                                    <h3 class="" style="color: #2565ab;"><i class="fa-solid fa-angle-right"></i></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-12">
                <a href="{{route('agent-transaction.index')}}" class="text-decoration-none">
                    <div class="widget-stat card bg-dashboard m-3">
                        <div class="card-body ">
                            <div class="media">
                              <span class="me-3">
                                  <img src="../assets/img/icon/transaction.png" class="img-fluid" width="35px">
                              </span>
                                <div class=" fw-bold">Transaction</div>
                                <div class="media-body text-white text-end">

                                    <h3 class="" style="color: #2565ab;"><i class="fa-solid fa-angle-right"></i></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-4 col-sm-12">
                <a href="{{route('purpose.index')}}" class="text-decoration-none">
                    <div class="widget-stat card bg-dashboard m-3">
                        <div class="card-body ">
                            <div class="media">
                              <span class="me-3">
                                  <img src="../assets/img/icon/purpos.png" class="img-fluid" width="35px">
                              </span>
                                <div class=" fw-bold">Purpose</div>
                                <div class="media-body text-white text-end">

                                    <h3 class="" style="color: #2565ab;"><i class="fa-solid fa-angle-right"></i></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-12">
                <a href="">
                </a><a href="{{route('source.index')}}" class="text-decoration-none">
                    <div class="widget-stat card bg-dashboard m-3">
                        <div class="card-body ">
                            <div class="media">
                                    <span class="me-3">
                                        <img src="../assets/img/icon/source.png" class="img-fluid" width="35px">
                                    </span>
                                <div class=" fw-bold">Source</div>
                                <div class="media-body text-white text-end">
                                    <h3 class="" style="color: #2565ab;"><i class="fa-solid fa-angle-right"></i></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!--<div class="col-md-6 col-lg-4 col-sm-12">
                <a href="{{url('/')}}" class="text-decoration-none">
                    <div class="widget-stat card bg-dashboard m-3">
                        <div class="card-body ">
                            <div class="media">
                                <span class="me-3">
                                    <img src="../assets/img/icon/ratemaster.png" class="img-fluid" width="35px">
                                </span>
                                <div class=" fw-bold">Rate Master</div>
                                <div class="media-body text-white text-end">
                                    <h3 class="" style="color: #2565ab;"><i class="fa-solid fa-angle-right"></i></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>-->
            
            <div class="col-md-6 col-lg-4 col-sm-12">
                <a href="{{url('/')}}" class="text-decoration-none">
                    <div class="widget-stat card bg-dashboard m-3">
                        <div class="card-body ">
                            <div class="media">
                                <span class="me-3">
                                    <img src="../assets/img/icon/report.png" class="img-fluid" width="35px">
                                </span>
                                <div class=" fw-bold">Reports </div>
                                <div class="media-body text-white text-end">

                                    <h3 class="" style="color: #2565ab;"><i class="fa-solid fa-angle-right"></i></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
@push('pagescript')
    @include('stacks.js.modules.dashboard.transactionstatus')
    @include('stacks.js.modules.dashboard.kyc')
    @include('stacks.js.modules.dashboard.rateblocked')
@endpush
