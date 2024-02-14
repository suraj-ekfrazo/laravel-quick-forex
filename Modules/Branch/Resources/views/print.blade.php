
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
                    <th>Branch Name</th>
                    <th>Email ID</th>
                    <th>Mobile</th>
                    <th class="not-export-col">Status</th>
                </tr>

            </thead>
            <tbody class="">
                @foreach($users as $data)
                <tr class="">

                    <th >{{ $data->branch_name}}</th>
                    <th >{{ $data->email}}</th>
                    <th >{{ $data->mobile}}</th>
                    <th >{{ $data->status == 1 ? 'Active' : 'Inactive'}}</th>
                </tr>
                @endforeach
            </tbody>
        </table>


