
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
                    <th scope="col" class="fw-bold">Name</th>
                    <th scope="col" class="fw-bold">Email ID</th>
                    <th scope="col" class="fw-bold">User Name</th>
                    <th scope="col" class="fw-bold">Mobile</th>
                    <th scope="col" class="fw-bold not-export-col">Status</th>
                </tr>

            </thead>
            <tbody class="">
                @foreach($users as $data)
                <tr class="">
                    <th >{{ $data->name}}</th>
                    <th >{{ $data->email}}</th>
                    <th >{{ $data->user_name}}</th>
                    <th >{{ $data->mobile_no}}</th>
                    <th >{{ $data->status == 1 ? 'Active' : 'Inactive'}}</th>
                </tr>
                @endforeach
            </tbody>
        </table>


