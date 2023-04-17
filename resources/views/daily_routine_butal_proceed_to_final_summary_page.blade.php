<form method="post" action="{{ route('daily_routine_butal_save') }}" accept-charset="UTF-8">
	@csrf
	<div class="table table-responsive">
		<table class="table table-bordered table-hover" id="daily_routine_sales_order_export_butal">
			<thead>
				<tr>
					<th>SO BUTAL</th>
					<th>MOT</th>
					<th>SO #</th>
					<th>{{ $principal->principal }}</th>
					<th style="text-transform: uppercase;">{{ $agent->name }}</th>
					<th>{{ $customer->location->location }}</th>
					<th>{{ $store_name ." (". $store_code .')' }}</th>
					<th>SKU ID</th>
					<th>SKU CODE</th>
					<th>DESCRIPTION</th>
					<th>UOM</th>
					<th>QTY</th>
					<th>PRICE</th>
					<th>AMOUNT</th>
				</tr>
			</thead>
			<tbody>
				@foreach($sku_data as $data)
					<tr>
						<td>SALES ORDER BUTAL</td>
						<td>{{ $mode_of_transaction }}</td>
						<td>{{ 'SOBUTAL-'.$sales_order_name ."". $time }}</td>
						<td>{{ $principal->id }}</td>
						<td>{{ auth()->user()->id }}</td>
						<td>{{ $customer->location->id }}</td>
						<td style="color:blue;">{{ $customer->id }}</td>
						<td>{{ $data->id }}</td>
						<td>
							<input type="hidden" name="sku[]" value="{{ $data->id }}">
							{{ $sku_code[$data->id] }}
						</td>
						<td>{{ $description[$data->id] }}</td>
						<td>{{ $data->unit_of_measurement }}
							<input type="hidden" name="unit_of_measurement[{{ $data->id }}]" value="{{ $data->unit_of_measurement }}">
						</td>
						<td>
							<input type="hidden" name="final_quantity_ordered[{{ $data->id }}]" value="{{ $final_quantity_ordered[$data->id] }}">
							<input type="hidden" name="ending_inventory[{{ $data->id }}]" value="{{ $ending_inventory[$data->id] }}">
							{{ $final_quantity_ordered[$data->id] }}
						</td><td style="text-align: right;">
							@if($customer_principal_price->price_level == 'price_1')
								@php
									$price = $data->price_1;
								@endphp
							@elseif($customer_principal_price->price_level == 'price_2')
								@php
									$price = $data->price_2;
								@endphp
							@elseif($customer_principal_price->price_level == 'price_3')
								@php
									$price = $data->price_3;
								@endphp
							@elseif($customer_principal_price->price_level == 'price_4')
								@php
									$price = $data->price_4;
								@endphp
							@endif
							{{ $price }}
							<input type="hidden" name="price[{{ $data->id }}]" value="{{ $price }}">
						</td>
						<td style="text-align: right;">
							@php
								$amount = $price * $final_quantity_ordered[$data->id];
								$sum_amount[] = $amount;
								echo $amount;
							@endphp
						</td>
					</tr>
				@endforeach
					<tr>
						<td style="text-align: center;font-weight: bold">TOTAL AMOUNT</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td style="text-align: right;">
							{{ array_sum($sum_amount) }}
							<input type="hidden" name="so_amount" value="{{ array_sum($sum_amount) }}">
						</td>
					</tr>
			</tbody>
		</table>
	</div>

	<input type="hidden" name="principal_id" value="{{ $principal->id }}">
	<input type="hidden" name="mode_of_transaction" value="{{ $mode_of_transaction }}">
	<input type="hidden" name="sales_order_number" value="{{ 'SOBUTAL-'.$sales_order_name ."". $time }}">
	<button class="btn btn-block btn-success" onclick="exportTableToCSV('{{ 'SOBUTAL-'.$sales_order_name ."-". $date }}.csv')">Export HTML Table To CSV File</button>
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
	    var rows = document.querySelectorAll("#daily_routine_sales_order_export_butal tr");
	    
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