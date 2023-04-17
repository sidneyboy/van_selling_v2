
 <form method="post" action="{{ route('bad_order_save') }}" accept-charset="UTF-8">
  @csrf
  <table id="daily_routine_bo_export" class="table table-bordered table-hover" style="display:;">
      <tr>
          <th colspan="2" style="text-align: center;">{{ $customer_principal_code->store_code }}</th>
          <th colspan="2" style="text-align: center;">{{ $customer->store_name }}</th>
          <th colspan="2" style="text-align: center;">{{ $sales_register->principal->principal }}</th>
          <th colspan="2" style="text-transform: uppercase;text-align: center;">{{ $sales_register->agent->name }}</th>
          <th>DELIVERY RECEIPT</th>
      </tr>
      <tr>
          <th colspan="2" style="text-align: center;">
              {{ 'BO RGS-'. $bo_rgs_name ."-". $date ."".$time }}
              <input type="hidden" name="bo_rgs_name" value="{{ 'BO-'. $bo_rgs_name ."-". $date ."".$time }}">
          </th>
          <th colspan="2" style="text-align: center;">{{ $customer->id }}</th>
          <th colspan="2" style="text-align: center;">{{ $sales_register->principal_id }}</th>
          <th colspan="2" style="text-align: center;">{{ $sales_register->user_id }}</th>
          <th style="text-align: center;">{{ $sales_register->dr }}</th>
      </tr>
      <tr>
        <th>ID</th>
          <th>CODE</th>
          <th>DESCRIPTION</th>
          <th>UOM</th>
          <th>RGS QTY</th>
          <th>BO QTY</th>
          <th>PRICE</th>
          <th>AMOUNT</th>
          <th>REMARKS</th>
      </tr>
      @foreach($sku as $data)
         <tr>
            <td>
              {{ $data }}
              <input type="hidden" name="sku_id[]" value="{{ $data }}">
            </td>
            <td>{{ $sku_code[$data] }}</td>
            <td>{{ $description[$data] }}</td>
            <td>{{ $unit_of_measurement[$data] }}</td>
            <td>
              @php
                $rgs_amount = $rgs_quantity[$data] * $unit_price[$data];
                echo $rgs_quantity[$data];
                $sum_rgs_quantity[] = $rgs_quantity[$data];
              @endphp
              <input type="hidden" name="rgs_quantity[{{ $data }}]" value="{{ $rgs_quantity[$data] }}">
            </td>
            <td>
              @php
                $bo_amount = $bo_quantity[$data] * $unit_price[$data];
                echo $bo_quantity[$data];
                $sum_bo_quantity[] = $bo_quantity[$data];
              @endphp
              <input type="hidden" name="bo_quantity[{{ $data }}]" value="{{ $bo_quantity[$data] }}">
            </td>
            <td>
              {{ $unit_price[$data] }}
              <input type="hidden" name="unit_price[{{ $data }}]" value="{{ $unit_price[$data] }}">
            </td>
            <td>
              @php
                echo $amount = $rgs_amount + $bo_amount;
                $sum_amount[] = $amount;
              @endphp
            </td>
            <td>
              {{ $remarks[$data] }}
              <input type="hidden" name="remarks[{{ $data }}]" value="{{ $remarks[$data] }}">
            </td>
         </tr>
      @endforeach
          <tr>
              <td style="text-align-last: center;font-weight: bold">TOTAL BO AMOUNT</td>
              <td></td>
              <td></td>
              <td></td>
              <td>{{ array_sum($sum_rgs_quantity) }}</td>
              <td>{{ array_sum($sum_bo_quantity) }}</td>
              <td></td>
              <td>
                {{ array_sum($sum_amount) }}
                <input type="hidden" name="total_bo_amount" value="{{ array_sum($sum_amount) }}">
              </td>
              <td></td>
          </tr>
  </table>
  <input type="hidden" name="bo_number" value="{{ 'BO RGS-'.$bo_rgs_name ."-". $date ."". $time }}">
  <input type="hidden" name="customer_id" value="{{ $customer_id }}">
  <input type="hidden" name="principal_id" value="{{ $principal_id }}">
  <button class="btn btn-block btn-success"  onclick="exportTableToCSV('{{'BO RGS-'.$bo_rgs_name ."-". $date ."". $time }}.csv')">Export HTML Table To CSV File</button>

</form>
<script type="text/javascript">

function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        // CSV file
        csvFile = new Blob([csv], {type: "text/csv"});

        // Download link
        downloadLink = document.createElement("a");

        // File name
        downloadLink.download = filename;

        // Create a link to the file
        downloadLink.href = window.URL.createObjectURL(csvFile);

        // Hide download link
        downloadLink.style.display = "none";

        // Add the link to DOM
        document.body.appendChild(downloadLink);

        // Click download link
        downloadLink.click();
    }


function exportTableToCSV(filename) {
     $('.loading').show();
     Swal.fire({
       position: 'top-end',
       icon: 'success',
       title: 'Your work has been saved',
       showConfirmButton: false,
       timer: 1500
     })

        var csv = [];
        var rows = document.querySelectorAll("#daily_routine_bo_export tr");
        
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");
            
            for (var j = 0; j < cols.length; j++) 
                row.push(cols[j].innerText);
            
            csv.push(row.join(","));        
        }

        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
        document.getElementById("trigger_button").click();
    }
 
</script>