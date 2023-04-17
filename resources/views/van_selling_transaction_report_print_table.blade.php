	<link rel="stylesheet" href="{{ asset('/adminLte/dist/css/adminlte.min.css') }}">

	<table class="table table-bordered table-hovered" id="export_table" style="text-align: center;">
		<thead>
			<tr>
				<th colspan="5" style="text-align: center;">VAN LOAD TRANSACTION</th>
			</tr>
			<tr>
				<th>SALESMAN: {{ $full_name }}</th>
				<th></th>
				<th></th>
				<th><span class="float-right">DATE RANGE</span></th>
				<th>{{ $date_from ." - ". $date_to }}</th>
			</tr>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<th style="text-align: center;">DATE</th>
				<th style="text-align: center;">CUSTOMER</th>
				<th style="text-align: center;">CSI NO</th>
				<th style="text-align: center;">AMOUNT</th>
				<th style="text-align: center;">STATUS</th>
			</tr>
		</thead>
		<tbody>
			@foreach($van_selling_transaction as $data)
					<tr>
						<td>{{ $data->date }}</td>
						<td>{{ $data->store_name }}</td>
						<td>{{ $data->delivery_receipt }}</td>
						<td style="text-align: right;">
							@if($data->status != 'CANCELLED')
								
								@php
									$data_sales = $data->total_amount;
									echo number_format($data_sales,2,".",",");
								@endphp
							@else
								
								@php
									 $data_sales = $data->total_amount*-1;
									 echo number_format($data_sales,2,".",",");
								@endphp
							@endif
							@php
									$sum_total[] = $data_sales;
							@endphp
						</td>
						<td>{{ $data->status }}</td>
						
					</tr>
			@endforeach
			<tr>
				<th style="text-align: center;">GRAND TOTAL</th>
				<th></th>
				<th></th>
				<th style="text-align: right;">{{ number_format(array_sum($sum_total),2,".",",") }}</th>
				<th></th>
			
			</tr>
		</tbody>
	</table>

	<script type="text/javascript">
		window.print();
	</script>