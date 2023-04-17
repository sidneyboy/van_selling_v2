<form id="daily_routine_butal_proceed_to_final_summary">
	<div class="table table-responsive" >
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th colspan="4">PREVIOUS SALES REGISTER OF <span style="color:blue">{{ $store_name ." (". $store_code .")" }} BUTAL</span></th>
				</tr>
				<tr>
					<th>SKU CODE</th>
					<th>DESCRIPTION</th>
					<th>UOM</th>
					<th>QTY</th>
				</tr>
			</thead>
			<tbody>
				@if($sales_register_butal)
					@foreach($sales_register_butal->sales_register_details as $data_sales_register)
						@if($data_sales_register->sku->sku_type == 'Butal')
							<tr>
								<td>{{ $data_sales_register->sku->sku_code }}</td>
								<td>{{ $data_sales_register->sku->description }}</td>
								<td>{{ $data_sales_register->sku->unit_of_measurement }}</td>
								<td>
									{{ $data_sales_register->quantity }}
								</td>
							</tr>
						@endif
					@endforeach
				@else
				<tr>
					<td colspan="4" style="font-weight: bold;text-align: center;color:red;">
						NO PREVIOUS SALES REGISTER
						
					</td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>


	<div class="table table-responsive">
		<table class="table table-bordered table-hover" >
			<thead>
				<tr>
					<th colspan="6">BEGINNING INVENTORY <span style="color:blue">{{ $store_name ." (". $store_code .")" }} BUTAL</span></th>
				</tr>
				<tr>
					<th>SKU CODE</th>
					<th>DESCRIPTION</th>
					<th>UOM</th>
					<th>QTY</th>
					<th>REMARKS</th>
					<th>DATE</th>
				</tr>
			</thead>
			<tbody>
				@if($sales_order_details)
					@foreach($sales_order_details as $data_sales_order)
						<tr>
							<td>{{ $data_sales_order->sku->sku_code }}</td>
							<td>{{ $data_sales_order->sku->description }}</td>
							<td>{{ $data_sales_order->sku->unit_of_measurement }}</td>
							<td>
								{{ $data_sales_order->ending_inventory }}
							</td>
							<td>{{ $data_sales_order->remarks }}</td>
							<td>
								{{ $data_sales_order->date }}
							</td>
						</tr>
					@endforeach
				@else
				<tr>
					<td colspan="6" style="font-weight: bold;text-align: center;color:red;">
						NO PREVIOUS SALES ORDER
					</td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>

	<div class="table table-responsive">
		<table class="table table-bordered table-hover" >
			<thead>
				<tr>
					<th colspan="5">ENDING INVENTORY <span style="color:blue">{{ $store_name ." (". $store_code .")" }} BUTAL</span></th>
				</tr>
				<tr>
					<th>SKU CODE</th>
					<th>DESCRIPTION</th>
					<th>UOM</th>
					<th>QTY</th>
					<th>REMARKS</th>
				</tr>
			</thead>
			<tbody>
				@foreach($sku as $data)
				<tr>
					<td>{{ $sku_code[$data] }}</td>
					<td>{{ $description[$data] }}</td>
					<td>{{ $unit_of_measurement[$data] }}</td>
					<td>
						{{ $quantity[$data] }}
					</td>
					<td>{{ $remarks[$data] }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="table table-responsive">
		<table class="table table-bordered table-hover" >
			<thead>
				<tr>
					<th colspan="9">SUGGEST SALES ORDER FOR <span style="color:blue"><span style="color:blue">{{ $store_name ." (". $store_code .")" }} BUTAL</span></th>
					<th colspan="3">
						<select class="form-control select2" required name="mode_of_transaction_butal">
							<option value="" default>SELECT MOT</option>
							<option value="COD">COD</option>
							<option value="VALE">VALE</option>
							<option value="PDC">PDC</option>
						</select>
					</th>
				</tr>
				<tr>
					<th>SKU CODE</th>
					<th>UOM</th>
					<th>DESCRIPTION</th>
					<th>INVENTORY BEG</th>
					<th>DELIVERY</th>
					<th>INVENTORY END</th>
					<th>SALES/OFFTAKE</th>
					<th>NO. OF DAYs</th>
					<th>AVERAGE DAILY SALE</th>
					<th>CM QTY</th>
					<th>SUGGESTED SO</th>
					<th>FINAL SO QTY</th>
				</tr>
			</thead>
			<tbody>
				@for ($i=0; $i < $sku_counter; $i++)
				<tr>
					<td>
						<input type="hidden" name="sku[]" value="{{ $sku_data[$i]->id }}">
						<input type="hidden" name="sku_code[{{ $sku_data[$i]->id }}]" value="{{ $sku_data[$i]->sku_code }}">
						{{ $sku_data[$i]->sku_code }}
					</td>
					<td style="text-transform: uppercase;">
						{{ $sku_data[$i]->unit_of_measurement }}
					</td>
					<td>
						<input type="hidden" name="description[{{ $sku_data[$i]->id }}]" value="{{ $sku_data[$i]->description }}">
						<input type="hidden" name="unit_of_measurement[{{ $sku_data[$i]->id }}]" value="{{ $sku_data[$i]->unit_of_measurement }}">
						{{ $sku_data[$i]->description }}
					</td>
					<td>
						@if(!isset($sales_order_details[$i]))
							@php
								$beginning_inventory = 0;
							@endphp
						@else
							@php
								$beginning_inventory = $sales_order_details_ending_inventory[$sku_data[$i]->id];
							@endphp
						@endif
						{{ $beginning_inventory }}
					</td>
					<td>
						@if(!isset($sales_register_details[$i]))
						@php
						$delivery = 0;
						@endphp
						@else
						@php
						$delivery = $sales_register_details[$i]->quantity;

						@endphp
						@endif
						{{ $delivery }}
					</td>
					<td>
						@php
						$ending_inventory = $quantity[$sku_data[$i]->id];
						@endphp
						{{ $ending_inventory }}
						<input type="hidden" name="ending_inventory[{{ $sku_data[$i]->id }}]" value="{{ $ending_inventory }}">
					</td>
					<td>
						@if($beginning_inventory + $delivery - $ending_inventory < 0)
						@php
						$sales_offtake = ($beginning_inventory + $delivery - $ending_inventory)*-1;
						@endphp
						@else
						@php
						$sales_offtake = $beginning_inventory + $delivery - $ending_inventory;
						@endphp
						@endif
						{{ $sales_offtake }}
					</td>
					<td>
						@if(!isset($sales_order_details[$i]))
						@php
						$number_of_days = 0;
						@endphp
						@else
						@php
						$diff = abs(strtotime($sales_order_details[$i]->date) - strtotime($date));
						$years = floor($diff / (365*60*60*24));
						$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
						$number_of_days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
						@endphp
						@endif
						{{ $number_of_days }}
					</td>
					<td>
						@if($number_of_days == 0)
						@php
						$average_daily_sales = 0;
						@endphp
						@else
						@php
						$average_daily_sales = round($sales_offtake / $number_of_days);
						@endphp
						@endif
						{{ $average_daily_sales }}
					</td>
					<td>{{ $cm_quantity[$sku_data[$i]->id] }}</td>
					<td>
						@php
						$suggested_sales_order = $average_daily_sales*($number_of_days+5);
						@endphp
						{{ $suggested_sales_order + $cm_quantity[$sku_data[$i]->id] }}
					</td>
					<td>
						<input type="number" name="final_quantity_ordered[{{ $sku_data[$i]->id }}]" class="form-control" required min="0">
					</td>
				</tr>
				@endfor
			</tbody>
		</table>
	</div>
	<div class="form-group">
		<input type="hidden" name="store_name" value="{{ $store_name }}">
		<input type="hidden" name="store_code" value="{{ $store_code }}">
		<button type="submit" class="btn btn-info btn-block">PROCEED TO FINAL SUMMARY</button>
	</div>
</form>

<script type="text/javascript">
	 $("#daily_routine_butal_proceed_to_final_summary").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "daily_routine_butal_proceed_to_final_summary",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
              $('#daily_routine_butal_proceed_to_final_summary_page').html(data);
              $('.loading').hide();
                // if(data != 'error'){
                //  Swal.fire({
                //     title: data,
                //     text: "Please send above code to agent",
                //     icon: 'success',
                //     showCancelButton: false,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'Yes, i will send it!'
                //   }).then((result) => {
                //     if (result.value) {
                //       Swal.fire(
                //         'Success',
                //         'Reloading Page',
                //         'success'
                //       )
                //       location.reload();
                //       $('.loading').hide();
                //     }
                //   })
                  
                // }else{
                //   Swal.fire(
                //   'Something went wrong!',
                //   'Redo process or contact system administrator',
                //   'error'
                //   )
                //   $('.loading').hide();
                // }
            },
      });
    }));
</script>