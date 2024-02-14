@extends('layouts.admin')

@section('content')
    <!-- /Navbar -->

    <!-- <div class="w-100 bg-cover flickity-cell is-selected" style="background: url(../assets/img/heading.png) center center/cover no-repeat   #ccc; ;  ">
        <div class="bg-dark-20">
            <div class=" container  justify-content-between">
                <div class=" " style="min-height: 150px;">
                    <div class="d-flex pt-5">
                        <a href="{{url('/')}}" class=" d-flex align-items-center text-white D-icon text-decoration-none"  >
                            <i class="fa-solid fa-house ms-2 me-2"></i>
                            <p class="d-none d-md-block">Go To Dashboard</p>
                        </a>
                        <div class="text-light text-center" style="font-size :24px; flex: 0.8; font-weight: 600;">Branch</div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


    <div class="container   pb-5 mt-5 mb-5">
        <!-- Tabs navs -->

        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="text-center">
            <div type="button" class="qf-create-btn" onclick="openAddModal()">
              <i class="fa-solid fa-plus"></i>Create Branch ID
           </div>
        </div>
        <div class="table-responsive-sm pt-4   ps-0 pe-0">
            <table id="agent-table" class="table roundedTable">
                <thead>
                <tr class="bgc-table row-font1">
                    <th>Branch Name</th>
                    <th>Email ID</th>
                    <th>Mobile</th>
                    <th class="not-export-col">Status</th>
                    <th class="not-export-col">Action</th>
                    <th class="not-export-col">Password</th>
                </tr>
                </thead>
            </table>
        </div>

        <div class="container">
            <div class="d-flex justify-content-center gap-3">
                <div class="mt-4 pt-2 text-center">
                    <div type="button" class="btn btn-rounded-outlined" id="print-data">
                        <span class=" text-capitalize">Print</span>
                    </div>
                </div>
                <div class="  mt-4 pt-2 text-center">
                    <a href="{{ route('adminbranch.export') }}">
                        <div type="button" class="btn btn-rounded" >
                            <span class=" text-capitalize">Download
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="addModals"></div>
    </div>
@endsection
@push('pagescript')
    @include('stacks.js.modules.branch.index')

    <script>
        $(document).on('click', "#print-data", function(evt) {
            var exportUrl = "{{ route('adminbranch.print') }}";
            $.ajax({
                url: exportUrl,
                type: 'GET',
                success: function(result) {
                    newWin = window.open("");
                    newWin.document.write(result);
                    newWin.print();
                    newWin.close();
                }
            });
        });
    </script>
@endpush
