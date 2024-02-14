@extends('layouts.admin')

@section('content')
    <div class="container pt-5 pb-5 mt-5 mb-5">
        <!-- Tabs navs -->
        <div class="container mt-5  mb-2">
            <div class="d-flex align-items-center justify-content-end gap-2">
                <div>
                    <img class="mb-2" src="{{asset('/assets/img/dashboard/svg/ic_calendar.svg')}}" width="20px" alt="">
                    <span class="date"> Date :</span>
                </div>
                <div class="display-date">
                    <span id="daynum">00 </span>/
                    <span id="month">month</span>
                    <span id="year">0000</span>
                </div>
                <div class="time_border">   </div>
                <div> <img class="mb-2" src="{{asset('/assets/img/dashboard/svg/ic_time.svg')}}" width="25px" alt="">
                    <span class="date"> Time :</span>
                </div>
                <div class="display-time"></div>
            </div>
        </div>
        <div class="">
            <ul class="nav nav-tabs nav-justified   " id="ex1" role="tablist">

                <li class="nav-item tab3" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 active"id="ex3-tab-3" data-mdb-toggle="tab" href="#ex3-tabs-3"  role="tab" aria-controls="ex3-tabs-3" aria-selected="true">
                        <div class="d-flex gap-2 justify-content-center align-items-center" >
                            <div>
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </div>
                            <div class="text-center"> Transaction <br>Status</div>
                        </div>
                        <span class="badge rounded-pill badge-notification bg-danger">3</span>
                    </a>
                </li>
                <li class="nav-item tab2" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 " id="ex3-tab-2"data-mdb-toggle="tab" href="#ex3-tabs-2" role="tab" aria-controls="ex3-tabs-2"aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center" >
                            <div>
                                <!-- <i class="fa-regular fa-square-plus fs-4"></i>  -->
                            </div>
                            <div class="text-center"> KYC <br>&nbsp;</div>
                        </div>
                        <span class="badge rounded-pill badge-notification bg-danger">1</span>
                    </a>

                </li>
                <li class="nav-item tab4" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3"id="ex3-tab-4" data-mdb-toggle="tab" href="#ex3-tabs-4"  role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center" >
                            <div>
                                <!-- <i class="fa-regular fa-square-plus fs-4"></i>  -->
                            </div>
                            <div class="text-center">  Rate Blocked <br>&nbsp;</div>
                        </div>
                        <span class="badge rounded-pill badge-notification bg-danger">2</span>
                    </a>
                </li>
                <li class="nav-item tab5" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3"id="ex3-tab-5" data-mdb-toggle="tab" href="#ex3-tabs-5"  role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center" >
                            <div>
                                <!-- <i class="fa-regular fa-square-plus fs-4"></i>  -->
                            </div>
                            <div class="text-center"> Pending  <br>Payments</div>
                        </div>
                        <span class="badge rounded-pill badge-notification bg-danger">5</span></a>
                </li>
                <li class="nav-item tab6" role="presentation">
                    <a class="nav-link fw-bold text-light mt-3 ms-3 me-3 "id="ex3-tab-6" data-mdb-toggle="tab" href="#ex3-tabs-6"  role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                        <div class="d-flex gap-2 justify-content-center align-items-center" >
                            <div>
                                <!-- <i class="fa-regular fa-square-plus fs-4"></i>  -->
                            </div>
                            <div class="text-center">   Completed <br> Bookings</div>
                        </div>
                        <span class="badge rounded-pill badge-notification bg-danger">15</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex3-content">
            <div class="tab-pane fade  bg-white"id="ex3-tabs-1" role="tabpanel"aria-labelledby="ex3-tab-1">

            </div>


            <div class="tab-pane fade  bg-light  show active" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">




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
                            <th scope="col" class="fw-bold"> Assign Deal Rate</th>
                            <th scope="col" class="fw-bold"> Assign Deal ID</th>
                            <th scope="col" class="fw-bold text-wrap"> Confirm Button</th>
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
                    <table id="example3" class="table roundedTable   "  >
                        <thead>
                        <tr class="bgc-table row-font1">
                            <th scope="col" class="fw-bold"  >Sr.No</th>
                            <th scope="col" class="fw-bold">Transaction Number </th>
                            <th scope="col" class="fw-bold">Customer Name</th>
                            <th scope="col" class="fw-bold">Agent Branch Name</th>
                            <th scope="col" class="fw-bold">Date & Time</th>
                            <th scope="col" class="fw-bold">View</th>
                            <!-- <th scope="col" class="fw-bold">Comment
                            </th>
                            <th scope="col" class="fw-bold"> Confirm Button
                            </th> -->
                        </tr>
                        </thead>

                        <tbody class="">
                        <tr class=" ">
                            <th  >1</th>
                            <td>02022302</td>
                            <td>Sham</td>
                            <td>
                                abc
                            </td>
                            <td>02-02-2023 10.28.11 am</td>
                            <td><button data-bs-toggle="modal" data-bs-target="#exampleModal5" class="border-0 text-white bg-secondary p-1 rounded-4 "> <i class="fa-solid fa-eye"></i> </button></td>
                            <!-- <td> <input type="text" id="form12" class="form-control-sm border p-0"  /></td>
                            <td>
                              <button class="btn-secondary btn-sm rounded-4 btn-block  border-0  " data-bs-toggle="modal" data-bs-target="#exampleModal1">  Confirm</button>
                            </td> -->
                        </tr>
                        <tr class=" ">
                            <th  >2</th>
                            <td>02022303</td>
                            <td>Ram</td>
                            <td>
                                dfg

                            </td>
                            <td>02-02-2023 10.28.11 am</td>
                            <td> <button data-bs-toggle="modal" data-bs-target="#exampleModal5" class="border-0 text-white bg-secondary p-1 rounded-4 "> <i class="fa-solid fa-eye"></i> </button></td>
                            <!-- <td> <input type="text" id="form12" class="form-control-sm border p-0"  /></td>
                            <td>
                              <button class="btn-secondary btn-sm rounded-4 btn-block  border-0  " data-bs-toggle="modal" data-bs-target="#exampleModal1">  Confirm</button>
                             </td> -->
                        </tr>
                        </tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <!-- <td></td>
                            <td></td> -->
                        </tr>
                    </table>
                    <div class=" ">
                        <div class="text-center pt-5  m-1 float-end">
                            <a  href="#" class="text-white "><button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize" >Download</button></a>
                        </div>
                        <div class="text-center pt-5 m-1 float-end">
                            <a  href="#" class="text-white"><button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize" >Print</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="ex3-tabs-6"role="tabpanel"aria-labelledby="ex3-tab-6">
                <div class="table-reponsive box pt-4   bgc ps-0 pe-0">
                    <table id="example4" class="table   roundedTable border-0  text-center "  >
                        <thead class=" ">
                        <tr class="bgc-table  row-font1">
                            <th scope="col" class="fw-bold"  >Transaction Number  </th>
                            <th scope="col" class="fw-bold">Assigned Deal </th>
                            <th scope="col" class="fw-bold">Customer Name </th>
                            <th scope="col" class="fw-bold">Currency </th>
                            <th scope="col" class="fw-bold">Amount</th>
                            <th scope="col" class="fw-bold">Sell Rate  </th>
                            <th scope="col" class="fw-bold">INR   </th>
                            <th scope="col" class="fw-bold">Date time booking done </th>

                        </tr>
                        </thead>
                        <tbody class="border-0">
                        <tr class="  ">
                            <th scope="row">02022301
                            </th>
                            <td>QF0121</td>
                            <td>Ram</td>
                            <td>CAD</td>
                            <td>1000
                            </td>
                            <td> 88.55
                            </td>
                            <td>88550 </td>
                            <td>02-02-2023 10.28.44 am
                            </td>

                        </tr>
                        <tr class="  ">
                            <th scope="row">02022302
                            </th>
                            <td>QF0122</td>
                            <td>Sham</td>
                            <td>USD</td>
                            <td>500</td>
                            <td> 81.35
                            </td>
                            <td>40675 </td>
                            <td>02-02-2023 11.28.33 am
                            </td>

                        </tr>
                        <tr class="  ">
                            <th scope="row">02022303
                            </th>
                            <td>QF0125</td>
                            <td>Gopal</td>
                            <td>THB</td>
                            <td>10000</td>
                            <td> 2.56 </td>
                            <td>25600 </td>
                            <td>02-02-2023 11.48.22 am
                            </td>

                        </tr>
                        </tbody>
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

        </div>
        <!-- Tabs content -->
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
            <div class="modal-dialog  modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color: #2565ab;">Edit Detail</h5>
                        <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex  pb-3 ">
                            <div class="border-heading"></div>
                            <div class="ps-1 fw-bold">Transaction Details</div>
                            <div class="ml-auto">
                                <button class="btn-print  ">  <img src="../assets/img/dashboard/svg/ic-print.svg" class="mb-1 me-1" alt=""> Print</button>
                                <button class="btn-download  "> <img src="../assets/img/dashboard/svg/ic-download.svg" class="mb-1 me-1" alt=""> Download</button>
                            </div>

                        </div>

                        <div class=" bgc-model m-2">
                            <div class="row ">


                                <div class="col-md-3 col-sm-6  ">
                                    <p  class="text-color">Customer Name</p>
                                    <div>
                                        <p> Ramesh Shah</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 ">
                                    <p  class="text-color">Mobile Number</p>
                                    <div>
                                        <p>
                                            +91 - 9876541230
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 ">
                                    <p  class="text-color">Transaction type</p>
                                    <div>
                                        <p>
                                            Remittance
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6  ">
                                    <p  class="text-color">Purpose</p>
                                    <div>
                                        <p>
                                            Education
                                        </p>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-6  ">
                                    <p  class="text-color">Source Of Fund</p>
                                    <div>
                                        <p>
                                            Relative
                                        </p>
                                    </div>

                                </div>
                                <div class="col-md-3 col-sm-6  ">
                                    <p  class="text-color">Remitter PAN</p>
                                    <div>
                                        <p>
                                            AAPOC8795T
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="d-flex gap-3 float-end m-2">
                            <div class="d-flex badge-1     ">
                                <div class="border-incdent"></div>
                                <span class="badge-c ps-1 fw-bold lh-lg">*TCS Applicable @ 5%</span>
                            </div>
                            <div class="d-flex badge-1   ">
                                <div class="border-incdent"></div>
                                <span class="ps-1 badge-c fw-bold lh-lg">*Previous Remittance in AY with QFX: 0.00</span>
                            </div>
                        </div>

                        <div class="table-responsive-sm pt-4   ps-0 pe-0">
                            <table class="table roundedTable text-center "  >
                                <tr class="bgc-table row-font1">
                                    <th scope="col" class="fw-bold"  >Sr.No</th>
                                    <th scope="col" class="fw-bold">Currency</th>
                                    <th scope="col" class="fw-bold">Amount</th>
                                    <th scope="col" class="fw-bold">Booking Rate</th>
                                    <th scope="col" class="fw-bold">Remit Fees</th>
                                    <th scope="col" class="fw-bold">Value INR</th>

                                </tr>
                                <tbody class="">
                                <tr class="  ">
                                    <th scope="row">1</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="../assets/img/dashboard/usd_t.png" style="width: 25px; height: 18px" class="rounded-1"/>
                                            <div class="ms-2"><p class=" mb-0">USD</p></div>
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
                                            <img src="../assets/img/dashboard/eur_t.png"style="width: 25px; height: 18px" class="rounded-1"/>
                                            <div class="ms-2"><p class=" mb-0">JPY</p> </div>
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
                                        <div>Net Amount  :</div>
                                        <div>TCS  :</div>
                                        <div>Amount for TCS :</div>
                                        <div>Remit Fees :</div>
                                        <div>GST @ 18 % :</div>

                                    </td>
                                    <td class="text-start">
                                        <div>  14,55,500.00 </div>
                                        <div>  37,775.00 </div>
                                        <div>  7,55,500.00 </div>
                                        <div>  1000.00 </div>
                                        <div>  180.00 </div>
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

        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
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


                                <div class="col-md-4 col-sm-6  ">
                                    <p  class="text-color">Transaction Number
                                    </p>
                                    <div>
                                        <p> 02022302</p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 ">
                                    <p  class="text-color">Customer Name
                                    </p>
                                    <div>
                                        <p>
                                            Remittance

                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 ">
                                    <p  class="text-color">Mobile
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
                                        <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-3">


                                <label class="custom-upload btn-sm btn-block p-2"><input type="file" name="upload_file" /> <i class="fa-solid fa-paperclip"></i> Attach Proof</label>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center   ">
                                    <a  href="#" class="text-white"><button type="button" class="btn-sm p-2  custom-upload  btn-block  fw-bold text-capitalize" >View</button></a>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="text-center pt-3 pb-3">
                        <a  href="#" class="text-white"><button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize" >Submit</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
            <div class="modal-dialog  modal-lg modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title fw-bold  r " id="exampleModalLabel1" style="color: #2565ab;">KYC Initiate
                        </h5>
                        <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
                    </div>
                    <div class="modal-body">
                        <div class=" bgc-model m-2">
                            <div class="input-group  ">
                        <span class="input-group-text" id="basic-addon1">Enter  New Booking Rate
                        </span>
                                <input type="text" class="form-control" placeholder="Enter Rate" aria-label="rate" aria-describedby="basic-addon1">
                            </div>

                            <div class="d-flex gap-3 justify-content-center">
                                <div class="text-center pt-3 pb-3">
                                    <a  href="#" class="text-white"><button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize" >Cancel
                                        </button></a>
                                </div>
                                <div class="text-center pt-3 pb-3">
                                    <a  href="#" class="text-white"><button type="button" class="btn btn-secondary px-5 fw-bold text-capitalize" >Confirm

                                        </button></a>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(6,39,75,0.5);">
            <div class="modal-dialog  modal-lg modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title fw-bold  r " id="exampleModalLabel1" style="color: #2565ab;">Payment
                        </h5>
                        <div type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
                    </div>
                    <div class="modal-body">


                    </div>

                </div>
            </div>
        </div>
@endsection
@push('pagescript')
    @include('stacks.js.modules.dashboard.transactionstatus')
    @include('stacks.js.modules.dashboard.kyc')
    @include('stacks.js.modules.dashboard.rateblocked')
@endpush
