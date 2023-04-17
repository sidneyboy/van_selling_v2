<div class="table table-responsive">
  <table class="table table-bordered table-hover" id="tblData">
    <thead>
      <tr>
        <th style="text-align: center;text-transform: uppercase;">REMITANCE FORM </th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: right;">AGENT NAME</th>
        <th style="text-align: center;text-transform: uppercase;"> {{ $agent }}</th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: center;">OVER ALL COLLECTION(<span style="color:green;">SUMMARY</span>)</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th style="text-align: center;">PARTICULARS</th>
        <th style="text-align: center;">BANK</th>
        <th style="text-align: center;">CHECK NO</th>
        <th style="text-align: center;">DATE</th>
        <th style="text-align: center;">AMOUNT</th>
        <th style="text-align: center;">TOTAL AMOUNT FOR DEPOSIT</th>
        <th style="text-align: center;">REMARKS</th>
      </tr>
    </thead>
    <tbody>
      @foreach($collection as $collection_data)
      @foreach($collection_data->collection_cash_check as $cash_check)
      <tr>
        <td>{{ $cash_check->particulars }}</td>
        <td>{{ $cash_check->bank }}</td>
        <td>{{ $cash_check->check_no }}</td>
        <td>{{ $cash_check->check_date }}</td>
        <td style="text-align: right;">
          @php
          $sum_amount[] = $cash_check->amount;
          echo $cash_check->amount;
          @endphp
        </td>
        <td style="text-align: right;">
          @if($cash_check->particulars == 'CASH' OR $cash_check->particulars == 'CHECK')
          {{ $cash_check->amount }}
          @php
          $sum_total[] = $cash_check->amount;
          @endphp
          @endif
          @if($cash_check->particulars == 'CHECK')
          @php
          $sum_total_check_amount[] = $cash_check->amount;
          @endphp
          @endif
          @if($cash_check->particulars == 'CASH' OR $cash_check->particulars == 'REFER CASH' )
          @php
          $sum_all_cash_amount[] = $cash_check->amount;
          @endphp
          @endif
          @if($cash_check->particulars == 'CHECK' OR $cash_check->particulars == 'REFER CHECK' )
          @php
          $sum_all_check_amount[] = $cash_check->amount;
          @endphp
          @endif
        </td>
        <td>{{ $cash_check->remarks }}</td>
      </tr>
      @endforeach
      @endforeach
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: center;">GRAND TOTAL</th>
        
        <th style="text-align: right;">
          {{ array_sum($sum_amount) }}
        </th>
        <th style="text-align: right;">
          {{ array_sum($sum_total) }}
        </th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: center;">TOTAL CASH</th>
        <th style="text-align: right;">{{ array_sum($sum_all_cash_amount) }}</th>
        <th style="text-align: right;">{{ array_sum($sum_all_cash_amount) }}</th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: center;">TOTAL CHECK</th>
        <th style="text-align: right;">
          {{ array_sum($sum_all_check_amount) }}
        </th>
        <th style="text-align: right;">
          {{ array_sum($sum_total_check_amount) }}
        </th>
        <th></th>
       
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: center;">GRAND TOTAL</th>
        
        <th style="text-align: right;">
          {{ array_sum($sum_all_cash_amount) + array_sum($sum_all_check_amount) }}
        </th>
        <th style="text-align: right;">
          {{ array_sum($sum_all_cash_amount) + array_sum($sum_total_check_amount) }}
        </th>
        <th></th>
        
      </tr>
        <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: center;" colspan="2">PAYMENT APPLIED AS FOLLOWS:(<span style="color:green;">SUMMARY</span>)</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th>DATE</th>
        <th>STORE NAME</th>
        <th>DR NO</th>
        <th>BALANCE</th>
        <th>CASH</th>
        <th>CHECK</th>
        <th>REMARKS</th>
        <th>OVERPAYMENT</th>
      </tr>
      @foreach($collection as $collection_data)
      @foreach($collection_data->collection_details as $details)
      <tr>
        <td>{{ $collection_data->date_collected }}</td>
        <td>{{ $details->collection->customer->store_name }}</td>
        <td>{{ $details->delivery_receipt }}</td>
        <td style="text-align: right;">{{ $details->total_dr_amount  }}</td>
        <td style="text-align: right;">
        
          {{ $details->cash }}
          @php
          $sum_details_cash[] = $details->cash;
          @endphp
        </td>
        <td style="text-align: right;">

          {{ $details->check }}
          @php
          $sum_details_check[] = $details->check;
          @endphp
        </td>
        <td>{{ $details->remarks }}</td>
        <td style="text-align: right;">
          
          {{ $details->over_payment }}
          @php
          $sum_details_over_payment[] = $details->over_payment;
          @endphp
        </td>
      </tr>
      @endforeach
      @endforeach
      <tr>
        <th></th>
        <th></th>
        <th style="text-align: center;">TOTAL</th>
        <th></th>
        <th style="text-align: right;">
    
          {{ array_sum($sum_details_cash) }}
        </th>
        <th style="text-align: right;">
      
          {{ array_sum($sum_details_check) }}
        </th>
        <th></th>
        <th style="text-align: right;">
        
          {{ array_sum($sum_details_over_payment) }}
        </th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: center;">LESS REFER:(<span style="color:green;">SUMMARY</span>)</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th>DATE</th>
        <th>STORE NAME</th>
        <th>PRINCIPAL</th>
        <th>DR</th>
        <th>CASH</th>
        <th>CHECK</th>
        <th>REMARKS</th>
        <th></th>
      </tr>
      @foreach($collection as $data_collection)
      @foreach($data_collection->collection_referal as $referal)
      <tr>
        <td>{{ $data_collection->date_collected }}</td>
        <td>{{ $referal->collection->customer->store_name }}</td>
        <td>{{ $referal->refer_principal }}</td>
        <td>{{ $referal->refer_delivery_receipt }}</td>
        <td style="text-align: right;">
          @php
          $sum_refer_cash[] = $referal->refer_cash;
       
          echo $referal->refer_cash;
          @endphp
        </td>
        <td style="text-align: right;">
          @php
          $sum_refer_check[] = $referal->refer_check;
         
          echo $referal->refer_check
          @endphp
        </td>
        <td>{{ $referal->refer_remarks }}</td>
        <td></td>
      </tr>
      @endforeach
      @endforeach
      <tr>
        <th></th>
        <th></th>
        <th style="text-align: center;">TOTAL</th>
        <th></th>
        <th style="text-align: right;">
     
          {{ array_sum($sum_refer_cash)}}
        </th>
        <th style="text-align: right;">
  
          {{ array_sum($sum_refer_check) }}
        </th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th style="text-align: center;">GRAND TOTAL</th>
        <th></th>
        <th style="text-align: right;">
          {{ array_sum($sum_refer_cash) + array_sum($sum_details_cash) }}
        </th>
        <th style="text-align: right;">
          {{ array_sum($sum_refer_check) + array_sum($sum_details_check) }}
        </th>
        <th style="text-align: right;">
          {{ array_sum($sum_refer_check) + array_sum($sum_details_check) + array_sum($sum_refer_cash) + array_sum($sum_details_cash) }}
        </th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: center;">ASSOCIATED DEPO SLIP/CHECK IMAGE</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      @foreach($collection as $data_collection)
        @foreach($data_collection->collection_image as $image)
           <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><img src="{{ asset('/images/'.$image->image) }}" class="img img-thumbnail" style="width:500px;"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        @endforeach
      @endforeach
      
      
    </tbody>
  </table>
</div>
<button onclick="exportTableToExcel('tblData', 'REMITANCE FORM - {{ $date_from ." - ". $date_to }}')">Export Table Data To Excel File</button>
<script type="text/javascript">
function exportTableToExcel(tableID, filename = ''){
var downloadLink;
var dataType = 'application/vnd.ms-excel';
var tableSelect = document.getElementById(tableID);
var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

// Specify file name
filename = filename?filename+'.xls':'excel_data.xls';

// Create download link element
downloadLink = document.createElement("a");

document.body.appendChild(downloadLink);

if(navigator.msSaveOrOpenBlob){
var blob = new Blob(['\ufeff', tableHTML], {
type: dataType
});
navigator.msSaveOrOpenBlob( blob, filename);
}else{
// Create a link to the file
downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

// Setting the file name
downloadLink.download = filename;

//triggering the function
downloadLink.click();
}
}
</script>