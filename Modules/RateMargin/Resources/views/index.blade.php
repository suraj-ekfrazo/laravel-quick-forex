@extends('layouts.admin')

@section('content')
    <div class="container pb-5 mt-5 mb-5 ratemargin-page">
        <div class="text-center">
            <div type="button" class="qf-create-btn" onclick="openRateMarginModal()">
            <i class="fa-solid fa-plus"></i> Add Rate Margin
            </div>
        </div>
        <div class="table-responsive-sm pt-4  ps-0 pe-0">
            <table id="manage-ratemargin-table"  class="table roundedTable">
                <thead>
                <tr class="bgc-table row-font1">
                    <th scope="col" class="fw-bold">Currency Name</th>
                    <th scope="col" class="fw-bold">XE Rate</th>
                    <th scope="col" class="fw-bold">Sell Margin 10-12</th>
                    <th scope="col" class="fw-bold">Sell Margin 12-2</th>
                    <th scope="col" class="fw-bold">Sell Margin 2-3:30</th>
                    <th scope="col" class="fw-bold">Sell Margin 3:30 End</th>
                    <th scope="col" class="fw-bold">Holiday Margin</th>
                    <th scope="col" class="fw-bold">Date</th>
                    <th scope="col" class="fw-bold not-export-col action-last-col">Action</th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- Modal -->
        <div class="addModals"></div>
    </div>
@endsection
@push('pagescript')
    @include('stacks.js.modules.ratemargin.index')
@endpush
