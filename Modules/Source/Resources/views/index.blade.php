@extends('layouts.admin')

@section('content')
    <!-- <div class="w-100 bg-cover flickity-cell is-selected" style="background: url(../assets/img/heading.png) center center/cover no-repeat   #ccc;">
        <div class="bg-dark-20">
            <div class=" container  justify-content-between">
                <div class=" " style="min-height: 150px;">
                    <div class="d-flex pt-5">
                        <a href="{{url('/')}}" class=" d-flex align-items-center text-white D-icon text-decoration-none"  >
                            <i class="fa-solid fa-house ms-2 me-2"></i>
                            <p class="d-none d-md-block">Go To Dashboard</p>
                        </a>
                        <div class="text-light text-center" style="font-size :24px; flex: 0.8; font-weight: 600;">Source</div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="container pb-5 mt-5 mb-5 source-page">
        <div class="text-center">
            <div type="button" class="qf-create-btn" onclick="openManageSourceModal()">
            <i class="fa-solid fa-plus"></i> Add Source
            </div>
        </div>
        <div class="table-responsive-sm pt-4  ps-0 pe-0">
            <table id="manage-sources-table"  class="table roundedTable">
                <thead>
                <tr class="bgc-table row-font1">
                    <th scope="col" class="fw-bold">Source</th>
                    <th scope="col" class="fw-bold">TCS Rate %</th>
                    <th scope="col" class="fw-bold">Exempt</th>
                    <th scope="col" class="fw-bold not-export-col">Status</th>
                    <th scope="col" class="fw-bold not-export-col">Action</th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- Modal -->
        <div class="addModals"></div>
    </div>
@endsection
@push('pagescript')
    @include('stacks.js.modules.source.index')
@endpush
