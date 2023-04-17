<div class="table table-responsive">
	<table class="table table-bordered table-hover table-sm" id="export_table">
	<thead>	
			<tr>
				<th>CANCELLATION REPORT</th>
				<th>{{ $full_name }}</th>
				<th>FROM</th>
				<th>{{ $date_from }}</th>
				<th>TO</th>
				<th>{{ $date_to }}</th>
				<th>	</th>
				
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
	</thead>
	<tbody>
		@foreach($van_selling_cancellation as $data)
		<tr>
			<th>DATA CANCELLED</th>
			<th></th>
			<th>DELIVERY RECEIPT</th>
			<th>STORE NAME</th>
			<th>REMARKS</th>
			<th></th>
			<th>TOTAL AMOUNT</th>
		</tr>
		<tr>
			<th>{{ $data->van_selling_transaction->date }}</th>
			<th></th>
			<th>{{ $data->van_selling_transaction->delivery_receipt }}</th>
			<th>{{ $data->van_selling_transaction->store_name }}</th>
			<th style="text-transform: 	uppercase;	">{{ $data->remarks }}</th>
			<th></th>
			<th style="text-align: right;">{{ $data->van_selling_transaction->total_amount }}</th>
		</tr>
		<tr>
			<th>PRINCIPAL</th>
			<th>SKU</th>
			<th>DESC</th>
			<th>UOM</th>
			<th>QTY</th>
			<th>U/P</th>
			<th>SUB-TOTAL</th>
		</tr>
			@foreach($data->van_selling_cancellation_details as $details)
				<tr>
					<th>{{ $details->principal }}</th>
					<th>{{ $details->sku_code }}</th>
					<th>{{ $details->description }}</th>
					<th>{{ $details->unit_of_measurement }}</th>
					<th>{{ $details->quantity }}</th>
					<th style="text-align: 	right;	">{{ $details->unit_price }}</th>
					<th style="text-align: 	right;	">
						@php
						$sub_total = $details->unit_price * $details->quantity;
						$sum_total[] = $sub_total;
						echo $sub_total;
						@endphp
					</th>
				</tr>
			@endforeach
			<tr>	
				<th></th>
				<th>	</th>
				<th>	</th>
				<th>	</th>
				<th>	</th>
				<th>	</th>
				<th>	</th>	
			</tr>
			<tr>	
				<th></th>
				<th>	</th>
				<th>	</th>
				<th>	</th>
				<th>	</th>
				<th>	</th>
				<th>	</th>	
			</tr>
		@endforeach
	</tbody>
</table>
</div>		
<br />
<button class="btn btn-block btn-success" onclick="exportTableToCSV('CANCELLATION REPORT {{ strtoupper($full_name) ." ". $date_from ." - ". $date_to }}.csv')">EXPORT TABLE DATA</button>

<script>
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
	    var rows = document.querySelectorAll("#export_table tr");
	    
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