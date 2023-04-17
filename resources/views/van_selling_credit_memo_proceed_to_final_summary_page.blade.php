<form id="van_selling_credit_memo_save">
	<div class="table table-responsive">
		<table class="table table-bordered table-hover" style="display: none;">
			<thead>
				<tr>
					<th>DESCRIPTION</th>
					<th>RGS</th>
					<th>BO</th>
					<th>AMOUNT</th>
					<th>REMARKS</th>
				</tr>
			</thead>
			<tbody>
				@foreach($details_id as $data)
				<tr>
					<td>
						<span style="font-weight:bold;color:blue;">{{ $sku_code[$data] }} <br /></span>
						<span style="font-weight:bold;color:blue;"> {{ $description[$data] }} </span><br />
						Qty - <span style="font-weight:bold;color: green;">{{ $quantity[$data] }}</span><br />
						U/P - <span style="font-weight:bold;color: green;">{{ $unit_price[$data] }}</span><br />
						<input type="hidden" name="description[{{ $data }}]" value="{{ $description[$data] }}">
						<input type="hidden" name="sku_code[{{ $data }}]" value="{{ $sku_code[$data] }}">
						<input type="hidden" name="quantity[{{ $data }}]" value="{{ $quantity[$data] }}">
						<input type="hidden" name="details_id[]" value="{{ $data }}">
					</td>
					<td>
						@php
						$sum_rgs_quantity[] = $rgs_quantity[$data];
						echo $rgs_quantity[$data];
						@endphp
						<input type="hidden" name="rgs_quantity[{{ $data }}]" value="{{ $rgs_quantity[$data] }}">
					</td>
					<td>
						@php
						$sum_bo_quantity[] = $bo_quantity[$data];
						echo $bo_quantity[$data];
						@endphp
						<input type="hidden" name="bo_quantity[{{ $data }}]" value="{{ $bo_quantity[$data] }}">
					</td>
					<td style="text-align: right;">
						@php
						$amount = ($bo_quantity[$data] + $rgs_quantity[$data]) * $unit_price[$data];
						$sum_amount[] = $amount;
						echo number_format($amount,2,".",",");
						@endphp
						<input type="hidden" name="unit_price[{{ $data }}]" value="{{ $unit_price[$data] }}">
					</td>
					<th>
						{{ $remarks[$data] }}
						<input type="hidden" name="remarks[{{ $data }}]" value="{{ $remarks[$data] }}">
					</th>
				</tr>
				@endforeach
				<tr>
					<th>TOTAL</th>
					<th>{{ array_sum($sum_rgs_quantity) }}</th>
					<th>{{ array_sum($sum_bo_quantity) }}</th>
					<th style="text-align: right;">{{ number_format(array_sum($sum_amount),2,".","") }}</th>
					<th></th>
				</tr>
			</tbody>
		</table>
		<table class="table table-bordered table-hover" id="export_table" >
			<thead>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th colspan="2">VAN SELLING FOR CREDIT MEMO</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th>{{ $user_id }}</th>
					<th></th>
					<th></th>
					<th colspan="2"></th>
					<th></th>
					<th></th>
					<th>{{ $export_code }}</th>

				</tr>
				<tr>
					<th>SKU CODE</th>
					<th>DESCRIPTION</th>
					<th>DR QUANTITY</th>
					<th>UNIT PRICE</th>
					<th>RGS</th>
					<th>BO</th>
					<th>AMOUNT</th>
					<th>REMARKS</th>
				</tr>
			</thead>
			<tbody>
				@foreach($details_id as $data)
					@if($rgs_quantity[$data] + $bo_quantity[$data] * $unit_price[$data] != 0)
						<tr>
							<td>{{ $sku_code[$data] }} </td>
							<td>{{ $description[$data] }} </td>
							<td>{{ $quantity[$data] }}</td>
							<td>{{ $unit_price[$data] }}</td>
							<td>
								@php
								$sum_rgs_quantity[] = $rgs_quantity[$data];
								echo $rgs_quantity[$data];
								@endphp
							</td>
							<td>
								@php
								$sum_bo_quantity[] = $bo_quantity[$data];
								echo $bo_quantity[$data];
								@endphp
							</td>
							<td style="text-align: right;">
								@php
								echo $amount = ($bo_quantity[$data] + $rgs_quantity[$data]) * $unit_price[$data];
								$sum_amount[] = $amount;
								@endphp
							</td>
							<th>{{ $remarks[$data] }}</th>
							
						</tr>
					@endif
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-md-12">
			<button style="display: none;" onclick="exportTableToCSV('{{ 'VANSELLING - '. $agent->name ." - $date" }}.csv')" id="export_csv_trigger_button">Export HTML Table To CSV File</button>
			<input type="hidden" name="van_selling_transaction_id" value="{{ $van_selling_transaction_id }}">
			<input type="hidden" name="delivery_receipt" value="{{ $delivery_receipt }}">
			<button type="submit" class="btn btn-success btn-block">SAVE FOR CREDIT MEMO TRANSACTION</button>
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
		var csv = [];
		var rows = document.querySelectorAll("#export_table tr");

		for (var i = 0; i < rows.length; i++) {
			var row = [], cols = rows[i].querySelectorAll("td, th");

			for (var j = 0; j < cols.length; j++)
			row.push(cols[j].innerText);

			csv.push(row.join(","));
		}
		downloadCSV(csv.join("\n"), filename);
	}

	  $("#van_selling_credit_memo_save").on('submit',(function(e){
        e.preventDefault();
       $('.loading').show();
       $( "#export_csv_trigger_button" ).trigger( "click" );
          $.ajax({
            url: "van_selling_credit_memo_save",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){

                if (data == 'saved') {
                	
                	Swal.fire({
					  position: 'top-end',
					  icon: 'success',
					  title: 'Your work has been saved',
					  showConfirmButton: false,
					  timer: 1500
					})

					location.reload();
                }else{
                	Swal.fire(
					  'Error',
					  'Something went wrong',
					  'error'
					)
					$('.loading').hide();
                }
            },
      });
    }));

</script>