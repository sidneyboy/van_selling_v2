<div class="table table-responsive">
	<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Description</th>
			<th>Beg</th>
			<th>Van Load</th>
			<th>Sales</th>
			<th>Adjustments</th>
			<th>End</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach($van_selling_details as $data)
			<tr>
				<td style="font-weight: bold;text-align: left;">
					
					<span style="color:green;">
						[{{ $data->sku_code }}]
					</span>
					- {{ $data->description }}
					
					<br />
					<span style="color:red;">
						{{ $data->principal }} -
					</span>
					<span style="color:green;">({{ $data->unit_of_measurement }})</span><br />
					
					B/C - <span style="color:blue;">{{ $data->butal_equivalent }}</span>  <br />
					U/P - <span style="color:blue;">{{ number_format($data->unit_price,2,".",",") }}</span> <br />
					
					
					{{-- QTY CASE - <span style="color:blue">{{ $data->end / $data->butal_equivalent }} --}}
					</span> <br />
					DATE - <span style="color:blue;">{{ $data->date }}</span> <br />
					REFERENCE - <span style="color:blue;">{{ $data->reference }}</span>
				</td>
				<td style="text-align: right;">
					{{ $data->beg }}
				</td>
				<td style="text-align: right;">
					@php
						$total_van_load[] = $data->van_load;
					@endphp
					{{ $data->van_load }}</td>
				<td style="text-align: right;">
					{{ $data->sales }}
					@php
							$total_sales[] = $data->sales;
					@endphp
				</td>
				<td style="text-align: right;">
					@if($data->status_cancel == 'CANCELLED')
						@php
							echo $adjustments = $data->adjustments;
						@endphp
					@else
						@php
							echo $adjustments = 0;
						@endphp
					@endif
					@php
							$total_adjustments[] = $data->adjustments;
					@endphp
				</td>
				<td style="text-align: right;">
					@if($data->status_cancel != 'CANCELLED')
						{{ $data->beg + $data->van_load + $data->sales + $data->adjustments }}
					@else
						{{ $data->beg + $data->van_load + $data->adjustments}}
					@endif
				</td>
				<td style="text-align: right;">
					@if($data->status_cancel != 'CANCELLED')
						NONE
					@else
						{{ $data->status_cancel }}
					@endif
				</td>
			</tr>
		@endforeach
			<tr>
				<th style="font-weight: bold;text-align: center;">GRAND TOTAL</th>
				<th style="text-align: right;font-weight: bold;">{{ $van_selling_details[0]->beg }}</th>
				<th style="text-align: right;font-weight: bold;">{{ array_sum($total_van_load) }}</th>
				<th style="text-align: right;font-weight: bold;">{{ array_sum($total_sales) }}</th>
				<th style="text-align: right;font-weight: bold;">{{ array_sum($total_adjustments) }}</th>
				<th style="text-align: right;font-weight: bold;">
					@php
						echo $end = $van_selling_details[0]->beg + array_sum($total_van_load) + array_sum($total_sales) + array_sum($total_adjustments);
					@endphp
				</th>
				<th></th>
			</tr>
	</tbody>
</table>
</div>