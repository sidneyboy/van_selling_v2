<div class="table table-responsive">
	<table class="table table-bordered table-sm table-hover" id="export_table">
		<thead>
			<tr>
				<th>NAME</th>
				<th colspan="2" style="text-transform: uppercase;text-align: center;">{{ $collection[0]->agent->name }}</th>
				<th></th>
				<th></th>
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
				<th>DATE</th>
				<th colspan="2" style="text-align: center;">{{ $date }}</th>
				<th></th>
				<th></th>
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
				<th>OR</th>
				<th>COLLECTION</th>
				<th>STORE NAME</th>
				<th>DATE</th>
				<th>DR</th>
				<th>AMOUNT</th>
				<th>CASH</th>
				<th>REFER</th>
				<th>CHEQUE</th>
				<th>REFER</th>
				<th>LESS </th>
				<th>SPECIFY</th>
				<th>REMARKS</th>
			</tr>
		</thead>
		<tbody>
			@foreach($collection as $data)
				@foreach($data->collection_details as $details)
				<tr>
					<td>{{ $data->or_number }}</td>
					<td>{{ $data->date_collected }}</td>
					<td>{{ $data->customer->store_name }}</td>
					<td></td>
					<td>{{ $details->delivery_receipt }}</td>
					<td style="width:100px;">{{ $details->total_dr_amount }}</td>
					<td style="width:100px;">{{ $details->cash }}</td>
					@if($details->delivery_receipt == 'REFER CASH')
						<td style="width:100px;">
							{{ $details->cash }}
							@php
								$add_refer_cash = $details->cash;
							@endphp
						</td>
					@else
						<td style="width:100px;">
							{{ 0 }}
							@php
								$add_refer_cash = 0;
							@endphp
						</td>
					@endif
					<td style="width:100px;">{{ $details->check }}</td>
					@if($details->delivery_receipt == 'REFER CHECK')
						<td>
							{{ $details->check }}
							@php
								$add_refer_check = $details->check;
							@endphp
						</td>
					@else
						<td>
							{{ 0 }}
							@php
								$add_refer_check = 0;
							@endphp
						</td>
					@endif
						@php
							$sum_cash_amount[] = $details->cash;
							$sum_check_amount[] = $details->check;
							$sum_add_refer_amount[] = $add_refer_cash + $add_refer_check;
						@endphp
					<td></td>
					<td></td>
					<td></td>
				</tr>
				@endforeach

						@foreach($data->collection_referal as $referal)
							<tr>
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
								<td>
									{{ $referal->refer_cash + $referal->refer_check }}
									@php
										$total_less_refer_cash[] = $referal->refer_cash;
										$total_less_refer_check[] = $referal->refer_check;
									@endphp	
								</td>
								<td>{{ $referal->refer_agent ."  ". $referal->refer_principal ."  ". $referal->refer_delivery_receipt }}</td>
								<td>{{ 'REFER CASH - '.$referal->refer_cash ."  ". 'REFER CHECK - '. $referal->refer_check ."  ". $referal->refer_remarks }}</td>
							</tr>
						@endforeach
			@endforeach
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
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
				<th style="text-align: right;">Total Cash</th>
				<th style="text-align: right;">{{ array_sum($sum_cash_amount) }}</th>
				<th style="text-align: right;">Total Check</th>
				<th style="text-align: right;">{{ array_sum($sum_check_amount) }}</th>
				<th></th>
				<th style="text-align: right;">Add</th>
				<th>{{ array_sum($sum_add_refer_amount) }}</th>
				<th></th>
			</tr>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th style="text-align: right;">Less Refer</th>
				<th style="text-align: right;">{{ array_sum($total_less_refer_cash) }}</th>
				<th style="text-align: right;">Less Refer</th>
				<th style="text-align: right;">{{ array_sum($total_less_refer_check) }}</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<th>GRAND TOTAL</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th style="text-align: right;">{{ array_sum($sum_cash_amount) - array_sum($total_less_refer_cash) }}</th>
				<th></th>
				<th style="text-align: right;">{{ array_sum($sum_check_amount) - array_sum($total_less_refer_check) }}</th>
				<th></th>
				<th></th>
				<th>{{ array_sum($sum_add_refer_amount) }}</th>
				<th></th>
			</tr>
		</tbody>
	</table>
</div>

<div class="row">
	<div class="col-md-12">
		<button style="text-transform: uppercase;" class="btn btn-success btn-block" onclick="exportTableToCSV('{{ strtoupper($collection[0]->agent->name)." - ". $date .' - LOCPD' }}.csv')">EXPORT TABLE TO CSV</button>
	</div>
</div>

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