
<table class="table table-sm" style="font-size: 20px;font-family: Arial, Helvetica, sans-serif;" id="export_table">
	<thead>
		<tr>
			<th colspan="2">SUMMARY OF DATA ACCOUNTS</th>
		</tr>
		<tr>
			<th>{{ $agent_user }}</th>
			<th style="text-align: right;">{{ $date }}</th>
		</tr>
		<tr>
			<th>PREV: OUTSTANDING BALANCE:</th>
			<th style="text-align: right;">{{ $prev_outstanding_balance }}</th>
		</tr>
		<tr>
			<th>(PLUS) SHIPMENT STOCK DELIVERED BY:</th>
			<th style="text-align: right;">
				{{ $total_shipment_stock  }}
				@php
					$total_van_load = $total_shipment_stock;
				@endphp
			</th>
		</tr>
		<tr>
			<th>SUB TOTAL:</th>
			<th style="text-align: right;">{{ $total_van_load + $prev_outstanding_balance  }}</th>
		</tr>
		<tr>
			<th>LESS REMITTANCE:</th>
			<th style="text-align: right;">{{ $less_remittance }}</th>
		</tr>
		<tr>
			<th>ACTUAL OUTSTANDING:</th>
			<th style="text-align: right;">
				@php
					 $actual_outstanding = round($prev_outstanding_balance + $total_van_load - $less_remittance,2);
					 echo $actual_outstanding;
				@endphp
			</th>
		</tr>
		<tr>
			<th>LESS CM:</th>
			<th style="text-align: right;">{{ $less_cm }}</th>
		</tr>
		<tr>
			<th>DEBIT:</th>
			<th style="text-align: right;">{{ $debit }}</th>
		</tr>
		<tr>
			<th>TOTAL OUTSTANDING:</th>
			<th style="text-align: right;">
				@php
				 echo	$total_outstanding = $actual_outstanding - $less_cm + $debit;
				
				@endphp
			</th>
		</tr>
		<tr>
			<th colspan="2">&nbsp;</th>
		</tr>
		<tr>
			<th colspan="2">OUTSTANDING BALANCE</th>
		</tr>
		<tr>
			<th></th>
			<th style="text-align: right;">{{ $total_outstanding }}</th>
		</tr>
		<tr>
			<th colspan="2">STOCKS ON HAND:</th>
		</tr>
		<tr>
			<th style="text-align: right;">{{ $stocks_on_hand }}</th>
			<th></th>
		</tr>
		<tr>
			<th colspan="2">BO SUBMITTED:</th>
		</tr>
		<tr>
			<th style="text-align: right;">{{ $bo_submitted }}</th>
			<th></th>
		</tr>
		<tr>
			<th colspan="2">BO NOT SUBMITTED:</th>
		</tr>
		<tr>
			<th style="text-align: right;">{{ $bo_not_submitted }}</th>
			<th></th>
		</tr>
		<tr>
			<th colspan="2">SUB TOTAL:</th>
		</tr>
		<tr>
			<th style="text-align: right;">{{ $stocks_on_hand  + $bo_submitted + $bo_not_submitted }}</th>
			<th style="text-align: right;">{{ $total_outstanding  }}</th>
		</tr>
		<tr>
			@php
				$sub_total_1 = $bo_submitted + $bo_not_submitted + $stocks_on_hand;
				$sub_total_2 =  $total_outstanding;
				$short_over = $sub_total_2 - $sub_total_1;
			@endphp
			@if($short_over < 0)
				<tr>
					<th>(OVER):</th>
					<th style="text-align: right;">{{ $short_over }}</th>
					
				</tr>
			@else
				<tr>
					<th>SHORT:</th>
					<th style="text-align: right;">{{ $short_over }}</th>
				</tr>
			@endif
		</tr>
		<tr>
			<th colspan="2">TOTAL:</th>
		</tr>
		<tr>
			<th style="text-align: right;">{{ $sub_total_1  }}</th>
			<th style="text-align: right;">{{ $sub_total_2  }}</th>
		</tr>
	</thead>
</table>



<div class="row">
	<div class="col-md-6">
		<button class="btn btn-info btn-block" id="convert">DOWNLOAD INVENTORY</button>
	</div>
	<div class="col-md-6">
		<button class="btn btn-success btn-block" onclick="exportTableToCSV('SDA-{{ $agent_user }}-{{ $date }}.csv')">EXPORT AS EXCEL</button>
	</div>
</div>



<div style="" id="result"></div>
<script type="text/javascript">
	$("#convert").on('click',(function(e){
	      	$('.loading').show();
	        var resultDiv = document.getElementById("result");
	        html2canvas(document.getElementById("export_table"), {
            onrendered: function(canvas) {
              var img = canvas.toDataURL("image/png");
              result.innerHTML = '<a download="summary of data accounts.jpeg" style="display:block;width:100%;border:none;background-color: #04AA6D;padding: 14px 28px;font-size: 16px;cursor: pointer;text-align: center;color:white;" href="'+img+'" id="download_button">DOWNLOAD IMAGE</a>';
                 $('.loading').hide();
                 document.getElementById('download_button').click();
				
            }
        });
	}));

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
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}



</script>