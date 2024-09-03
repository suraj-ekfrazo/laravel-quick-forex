@extends('layouts.admin')

@section('content')
    <div class="container pb-5 mt-5 mb-5 currencyrate-page">
        <div class="text-center">
            <div type="button" class="qf-create-btn" onclick="openCurrencyRateModal()">
            <i class="fa-solid fa-plus"></i> Add Currency
            </div>
        </div>
        <div class="table-responsive-sm pt-4  ps-0 pe-0">
            <table id="manage-currencyrate-table"  class="table roundedTable">
                <thead>
                <tr class="bgc-table row-font1">
                    <th scope="col" class="fw-bold">Currency Name</th>
                    <th scope="col" class="fw-bold">Status</th>
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
    @include('stacks.js.modules.currencyrate.index')
@endpush
