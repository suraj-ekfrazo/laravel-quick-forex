
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
                </tr>
                @endforeach

                </tbody>

        </table>


