<div class="table table-responsive">
	<form action="{{ route('bo_outright_reports_export_save') }}" method="post">
		<table class="table table-bordered table-hover" id="export_table">
			<thead>
				<tr>
					<th>EXPORTED BO OUTRIGHT DEDUCTION REPORT</th>
					<th>{{ uniqid() }}</th>
				</tr>
				<tr>
					<th>DATA FROM:</th>
					<th>{{ $date_from }} TO {{ $date_to }}</th>
					<th>{{ $user_id }}</th>
					<th>{{ $full_name }}</th>
				</tr>
				<tr>
					<th style="text-transform: uppercase;">sku_code</th>
					<th style="text-transform: uppercase;">description</th>
					<th style="text-transform: uppercase;">purchase_quantity</th>
					<th style="text-transform: uppercase;">bo_quantity</th>
					<th style="text-transform: uppercase;">unit_price</th>
					<th style="text-transform: uppercase;">sub-total</th>
				</tr>
			</thead>
			<tbody>
				@foreach($van_selling_bo_outright as $data)
					@foreach($data->van_selling_bo_outright_details as $details)
						<tr>
							<th>{{ $details->sku_code }}</th>
							<th>{{ $details->description }}</th>
							<th>{{ $details->purchase_quantity }}</th>
							<th>{{ $details->bo_quantity }}</th>
							<th>{{ $details->unit_price }}</th>
							<th>
								{{ $details->unit_price * $details->bo_quantity }}
								<input type="hidden" name="van_selling_bo_outright_id[]" value="{{ $data->id }}">
							</th>
						</tr>
					@endforeach
				@endforeach
			</tbody>
		</table>
		<br />
		@if(count($van_selling_bo_outright) != 0)
			<button onclick="exportTableToCSV('BO OUTRIGHT DEDUCTION - {{ $full_name ." ". $date_from ." - ". $date_to}} .csv')" class="btn btn-block btn-success">EXPORT DATA</button>
		@endif
	</form>
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