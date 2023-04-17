<form action="{{ route('van_selling_audit_export_sales_save') }}" method="post">
				@csrf
				<div class="table table-responsive">
					<table class="table table-bordered table-hovered" id="export_table">
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th colspan="2" style="text-align: center;">VAN SELLING EXPORT</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
							<tr>
								<th>{{ $full_name }}</th>
								<th>{{ $user_id }}</th>
								<th></th>
								<th style="text-transform: uppercase;" colspan="2">{{ $full_name ."-VAN_SELLING_EXPORTED_DATA". $date ."-". $time  }}</th>
								<th></th>
								<th>DATE EXPORTED</th>
								<th>{{ $date }}</th>
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
								<th>DATE</th>
								<th>CUSTOMER</th>
								<th>DR NO</th>
								<th>CODE</th>
								<th>DESCRIPTION</th>
								<th>QTY</th>
								<th>U/P</th>
								<th>AMOUNT</th>
							</tr>
						</thead>
						<tbody>
							@foreach($van_selling_transaction as $data)
								@foreach($data->van_selling_transaction_details as $details)
									@if($data->status != 'CANCELLED')
											<tr>
												<td>
													{{ $data->date }}
													<input type="hidden" name="details_id[]" value="{{ $details->id }}">
												</td>
												<td>{{ $data->store_name }}</td>
												<td>{{ $data->delivery_receipt }}</td>
												<td>{{ $details->sku_code }}</td>
												<td>{{ $details->description }}</td>
												<td>{{ $details->quantity }}</td>
												<td>{{ $details->price }}</td>
												<td>{{ $details->amount }}</td>
											</tr>
									@endif
								@endforeach
							@endforeach
						</tbody>
					</table>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label>&nbsp;</label>
						<button class="btn btn-block btn-success" style="text-transform: uppercase;" onclick="exportTableToCSV('{{ $full_name ."-VAN_SELLING_SALES-". $date ."-". $time }}.csv')">EXPORT TABLE DATA</button>
					</div>
				</div>
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