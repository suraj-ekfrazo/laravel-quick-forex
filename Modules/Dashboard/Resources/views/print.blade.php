
<style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }



    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;

      color: rgb(0, 0, 0);
    }
    
   </style>


    @if($type == 'complete_transection')
        <table id="customers" class="table roundedTable border  text-center">
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

                </tr>

            </thead>

            <tbody class="">
                @foreach($transections as $data)
                <tr class="">
                    <th >{{ $data->txn_number}}</th>
                    <th >{{ $data->customer_name}}</th>
                    <th >{{ $data->txn_type == '1' ? 'Remittance' : 'Card'}}</th>
                    <th >{{ $data->pancard_no}}</th>
                    <th >Completed</th>
                    <th >Completed</th>
                    <th >Completed</th>
                    <th>{{ $data->expired_date ? date('d-m-Y h:m:ss A', strtotime($data->expired_date)) : ''}}</th>
                </tr>
                @endforeach

                </tbody>

        </table>
    @elseif($type == 'all_transection')
    <table id="customers" class="table   roundedTable border-0  text-center">
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
            </tr>
        </thead>
        <tbody class="">
            @foreach($transections as $data)
            <tr class="">
                <th >{{ $data->txn_number}}</th>
                <th >{{ $data->customer_name}}</th>
                <th >{{ $data->txn_type == '1' ? 'Remittance' : 'Card'}}</th>
                <th >{{ $data->pancard_no}}</th>

                @php
                    if($data->kyc_status == 0){
                        $kyc_status = "Pending";
                    }elseif($data->kyc_status == 1){
                        $kyc_status = "Completed";
                    }else{
                        $kyc_status = "Rejected";
                    }
                @endphp
                <th >{{$kyc_status}}</th>

                @php
                    if($data->payment_status == 0){
                        $payment_status = "Pending";
                    }elseif($data->payment_status == 1){
                        $payment_status = "Completed";
                    }else{
                        $payment_status = "Rejected";
                    }
                @endphp

                <th >{{ $payment_status}}</th>

                @php
                    if($data->transaction_status == 0){
                        $transaction_status = "Pending";
                    }elseif($data->transaction_status == 1){
                        $transaction_status = "Completed";
                    }else{
                        $transaction_status = "Rejected";
                    }
                @endphp
                <th >{{ $transaction_status}}</th>
                <th>{{ $data->expired_date ? date('d-m-Y h:m:ss A', strtotime($data->expired_date)) : ''}}</th>
            </tr>
            @endforeach

            </tbody>
    </table>
    @elseif($type == 'pending_payment')
    <table id="customers" class="table   roundedTable border-0  text-center">
        <thead>
            <tr class="bgc-table row-font1">
                <th scope="col" class="fw-bold">Transaction Number</th>
                <th scope="col" class="fw-bold">Customer Name</th>
                <th scope="col" class="fw-bold">Type</th>
                <th scope="col" class="fw-bold">Remitter PAN</th>
                <th scope="col" class="fw-bold">KYC Status</th>
                <th scope="col" class="fw-bold">Payment Status</th>
            </tr>
        </thead>
        <tbody class="">
            @foreach($transections as $data)
            <tr class="">
                <th >{{ $data->txn_number}}</th>
                <th >{{ $data->customer_name}}</th>
                <th >{{ $data->txn_type == '1' ? 'Remittance' : 'Card'}}</th>
                <th >{{ $data->pancard_no}}</th>

                @php
                    if($data->kyc_status == 0){
                        $kyc_status = "Pending";
                    }elseif($data->kyc_status == 1){
                        $kyc_status = "Completed";
                    }else{
                        $kyc_status = "Rejected";
                    }
                @endphp
                <th >{{$kyc_status}}</th>

                @php
                    if($data->payment_status == 0){
                        $payment_status = "Pending";
                    }elseif($data->payment_status == 1){
                        $payment_status = "Completed";
                    }else{
                        $payment_status = "Rejected";
                    }
                @endphp

                <th >{{ $payment_status}}</th>

            </tr>
            @endforeach

            </tbody>
    </table>

    @elseif($type == 'kyc')
    <table id="customers" class="table   roundedTable border-0  text-center">
        <thead>
            <tr class="bgc-table row-font1">
                <th scope="col" class="fw-bold">Transaction Number</th>
                <th scope="col" class="fw-bold">Customer Name </th>
                <th scope="col" class="fw-bold">Transaction type</th>
                <th scope="col" class="fw-bold">Purpose </th>

            </tr>
        </thead>
        <tbody class="">
            @foreach($transections as $data)
            <tr class="">
                <th >{{ $data->txn_number}}</th>
                <th >{{ $data->customer_name}}</th>
                <th >{{ $data->txn_type == '1' ? 'Remittance' : 'Card'}}</th>
                <th >{{ optional($data->purposeData)->purpose_name}}</th>
            </tr>
            @endforeach

            </tbody>
    </table>

    @elseif($type == 'approved_deals')
    <table id="customers" class="table   roundedTable border-0  text-center">
        <thead>
            <tr class="bgc-table row-font1">
                <th scope="col" class="fw-bold">Reference Number</th>
                <th scope="col" class="fw-bold">Customer Name</th>
                <th scope="col" class="fw-bold">Currency</th>
                <th scope="col" class="fw-bold">Value</th>
                <th scope="col" class="fw-bold">Purpose</th>
                <th scope="col" class="fw-bold">Transection Type</th>
                <th scope="col" class="fw-bold">Rate</th>
                <th scope="col" class="fw-bold">Deal ID</th>
                <th scope="col" class="fw-bold">Expiry Date</th>
            </tr>
        </thead>
        <tbody class="">
            @foreach($transections as $data)
            <tr class="">
                <th >{{ $data->reference_number}}</th>
                <th >{{ $data->branch_id ? optional($data->getAgent)->branch_name : ''}}</th>
                <th >{{ $data->fx_currency}}</th>
                <th >{{ $data->fx_value}}</th>
                <th >{{ $data->getPurpose ? optional($data->getPurpose)->purpose_name : 'N/A'}}</th>
                <th >{{ 'Remittance'}}</th>
                <th >{{ $data->fx_rate}}</th>
                <th >{{ $data->deal_id ?? ''}}</th>
                <th >{{ $data->expiry_date ? date('d-m-Y h:m:ss A', strtotime($data->expiry_date)) : ''}}</th>
            </tr>
            @endforeach

            </tbody>
    </table>


    @endif

