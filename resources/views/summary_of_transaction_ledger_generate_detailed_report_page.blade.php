<div class="table table-responsive">
	@if($remarks == 'SO CASE' OR $remarks == 'SO BUTAL' OR $remarks == 'VERY FIRST INVENTORY')
		<table class="table table-bordered table-hover" id="daily_routine_sales_order_export">
				<thead>
					<tr>
						<th colspan="7" style="text-align: center;">
							@if($remarks == 'SO CASE')
								SALES ORDER CASE
							@else
								SALES ORDER BUTAL
							@endif
						</th>
					</tr>
					<tr>
						<th colspan="3" style="text-align: center">{{ $data->mode_of_transaction }}</th>
						<th colspan="4" style="text-align: center">{{ $data->sales_order_number }}</th>
					</tr>
					<tr>
						<th style="text-align: center;">{{ $data->principal->principal }}</th>
						<th style="text-transform: uppercase;text-align: center;">{{ $data->agent->name }}</th>
						<th style="text-align: center;">{{ $data->customer->location->location }}</th>
						<th style="color:blue;text-align: center;" colspan="4">{{ $data->customer->store_name ." (". $customer_principal_code->store_code .')' }}</th>
					</tr>
					<tr>
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
					@foreach($data->sales_order_details as $data)
						<tr>
							<td>{{ $data->sku_id }}</td>
							<td>{{ $data->sku->sku_code }}</td>
							<td>{{ $data->sku->description }}</td>
							<td>{{ $data->sku->unit_of_measurement }}</td>
							<td style="text-align: right;">{{ $data->quantity }}</td>
							<td style="text-align: right;">{{ number_format($data->price,2,".",",")  }}</td>
							<td style="text-align: right;">
								@php
									$amount = $data->price * $data->quantity;
									$sum_amount[] = $amount;
									echo number_format($amount,2,".",",");
								@endphp
							</td>
						</tr>
					@endforeach
						<tr>
							<td colspan="6" style="text-align: center;font-weight: bold">TOTAL SO AMOUNT</td>
							<td style="text-align: right;">{{ number_format(array_sum($sum_amount),2,".",",") }}</td>
						</tr>
				</tbody>
		</table>
	@elseif($remarks == 'COLLECTION')
		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th colspan="7" style="text-align: center;">OVER ALL COLLECTION(<span style="color:green;">SUMMARY</span>)</th>
					</tr>
					<tr>
						<th colspan="3" style="text-align: center;">{{ $data->customer->store_name }}</th>
						<th></th>
						<th colspan="3" style="text-align: center;">{{ $customer_principal_code->store_code }}</th>
					</tr>
					<tr>
						<th>PARTICULARS</th>
						<th>BANK</th>
						<th>CHECK #</th>
						<th>DATE</th>
						<th>AMOUNT</th>
						<th>TOTAL</th>
						<th>REMARKS</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->collection_cash_check as $cash_check)
						<tr>
							<td>{{ $cash_check->particulars }}</td>
							<td>{{ $cash_check->bank }}</td>
							<td>{{ $cash_check->check_no }}</td>
							<td>{{ $cash_check->check_date }}</td>
							<td style="text-align: right;">
								@php
									$sum_amount[] = $cash_check->amount;
									echo number_format($cash_check->amount,2,".",",");
								@endphp
							</td>
							<td style="text-align: right;">
								@if($cash_check->particulars == 'CASH' OR $cash_check->particulars == 'CHECK')
								{{ number_format($cash_check->amount,2,".",",") }}
									@php
										$sum_total[] = $cash_check->amount;
									@endphp
								@endif
								@if($cash_check->particulars == 'CASH' OR $cash_check->particulars == 'REFER CASH')
									@php
										$sum_all_cash_amount[] = $cash_check->amount;
									@endphp		
								@endif
							</td>
							<td>{{ $cash_check->remarks }}</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>TOTAL CASH</th>
						<th></th>
						<th></th>
						<th></th>
						<th style="text-align: right;">
							{{ number_format(array_sum($sum_all_cash_amount),2,".",",") }}
						</th>
						<th style="text-align: right;">
							
						</th>
						<th></th>
					</tr>
					<tr>
						<th>GRAND TOTAL</th>
						<th></th>
						<th></th>
						<th></th>
						<th style="text-align: right;">
							{{ number_format(array_sum($sum_amount),2,".",",") }}
						</th>
						<th style="text-align: right;">
							{{ number_format(array_sum($sum_total),2,".",",") }}
						</th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>

		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th style="text-align: center;" colspan="7">PAYMENT APPLIED AS FOLLOWS:(<span style="color:green;">SUMMARY</span>)</th>
					</tr>
					<tr>
						<th>DATE</th>
						<th>DR NO</th>
						<th>BALANCE</th>
						<th>CASH</th>
						<th>CHECK</th>
						<th>REMARKS</th>
						<th>OVERPAYMENT</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->collection_details as $details)
						<tr>
							<td>{{ $data->date_collected }}</td>
							<td>{{ $details->delivery_receipt }}</td>
							<td style="text-align: right;">{{ number_format($details->total_dr_amount,2,".",",")  }}</td>
							<td style="text-align: right;">
								{{ number_format($details->cash,2,".",",")  }}
								@php
									$sum_details_cash[] = $details->cash;
								@endphp		
							</td>
							<td style="text-align: right;">
								{{ number_format($details->check,2,".",",")  }}
								@php
									$sum_details_check[] = $details->check;
								@endphp	
							</td>
							<td>{{ $details->remarks }}</td>
							<td style="text-align: right;">
								{{ number_format($details->over_payment,2,".",",")  }}
								@php
									$sum_details_over_payment[] = $details->over_payment;
								@endphp	
							</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>TOTAL</th>
						<th></th>
						<th></th>
						<th style="text-align: right;">
							{{ number_format(array_sum($sum_details_cash),2,".",",") }}
						</th>
						<th style="text-align: right;">
							{{ number_format(array_sum($sum_details_check),2,".",",") }}
						</th>
						
						<th></th>
						<th style="text-align: right;">
							{{ number_format(array_sum($sum_details_over_payment),2,".",",") }}
						</th>
					</tr>
				</tfoot>
			</table>
		</div>

		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th style="text-align: center;" colspan="7">LESS REFER:(<span style="color:green;">SUMMARY</span>)</th>
					</tr>
					<tr>
						<th>DATE</th>
						<th>AGENT</th>
						<th>PRINCIPAL</th>
						<th>DR</th>
						<th>CASH</th>
						<th>CHECK</th>
						<th>REMARKS</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->collection_referal as $referal)
						<tr>
							<td>{{ $data->date_collected }}</td>
							<td>{{ $referal->refer_agent }}</td>
							<td>{{ $referal->refer_principal }}</td>
							<td>{{ $referal->refer_delivery_receipt }}</td>
							<td style="text-align: right;">
								@php
									$sum_refer_cash[] = $referal->refer_cash;
									echo number_format($referal->refer_cash,2,".",",");
								@endphp
							</td>
							<td style="text-align: right;">
								@php
									$sum_refer_check[] = $referal->refer_check;
									echo number_format($referal->refer_check,2,".",",");
								@endphp
							</td>
							<td>{{ $referal->refer_remarks }}</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>TOTAL</th>
						<th></th>
						<th></th>
						<th></th>
						<th  style="text-align: right;">
							{{ number_format(array_sum($sum_refer_cash),2,".",",") }}
						</th>
						<th  style="text-align: right;">
							{{ number_format(array_sum($sum_refer_check),2,".",",") }}
						</th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>

		<div class="table table-responsive">
			<table class="table table-bordered tablehover">
				<thead>
					<tr>
						<th>ASSOCIATED DEPO SLIP/CHECK IMAGE</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data->collection_image as $image)
						<tr>
							<td><img src="{{ asset('/images/'.$image->image) }}" class="img img-thumbnail" style="width:100%;"></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		
		{{-- <button id="daily_routine_collection_hide_button" class="btn btn-warning btn-block" onclick="exportTableToExcel('daily_routine_collection_export', '{{ $collection_name ."-". $time }}')">Export Table Data To Excel File</button> --}}
@elseif($remarks == 'BO')

	<table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th colspan="8" style="text-align: center;">BO INVENTORY</th>
            </tr>
            <tr>
                <th>{{ $customer_principal_code->store_code }}</th>
                <th>{{ $data->customer->store_name }}</th>
                <th>{{ $data->principal->principal }}</th>
                <th colspan="5" style="text-transform: uppercase;">{{ $data->agent->name }}</th>
            </tr>
            <tr>
                <th>CODE</th>
                <th>DESCRIPTION</th>
                <th>SKU TYPE</th>
                <th>RGS QTY</th>
                <th>BO QTY</th>
                <th>PRICE</th>
                <th>AMOUNT</th>
                <th>REMARKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data->bo_details as $bo)
                    <tr>
                        <td>{{ $bo->sku->sku_code }}</td>
                        <td>{{ $bo->sku->description }}</td>
                        <td>{{ $bo->sku->unit_of_measurement }}</td>
                        <td style="text-align: right;">{{ $bo->rgs_quantity }}</td>
                        <td style="text-align: right;">{{ $bo->bo_quantity }}</td>
                        <td style="text-align: right;">
                            {{ number_format($bo->price,2,".",",") }}
                        </td>
                        <td style="text-align: right;">
                            @php
                                $amount = $bo->price * ($bo->rgs_quantity + $bo->bo_quantity);
                                $sum_amount[] = $amount;
                                echo number_format($amount,2,".",",");
                            @endphp
                        </td>
                        <td>{{ $bo->remarks }}</td>
                    </tr>
            @endforeach 
                <tr>
                    <td colspan="6" style="text-align-last: center;font-weight: bold">TOTAL BO AMOUNT</td>
                    <td style="text-align: right;">{{ number_format(array_sum($sum_amount),2,".",",") }}</td>
                    <td></td>
                </tr>
        </tbody>
    </table>

@endif
</div>

<script type="text/javascript">
	function exportTableToExcel(tableID, filename = ''){
	   				var downloadLink;
				    var dataType = 'application/vnd.ms-excel';
				    var tableSelect = document.getElementById(tableID);
				    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
				    
				    // Specify file name
				    filename = filename?filename+'.xls':'excel_data.xls';
				    
				    // Create download link element
				    downloadLink = document.createElement("a");
				    
				    document.body.appendChild(downloadLink);
				    
				    if(navigator.msSaveOrOpenBlob){
				        var blob = new Blob(['\ufeff', tableHTML], {
				            type: dataType
				        });
				        navigator.msSaveOrOpenBlob( blob, filename);
				    }else{
				        // Create a link to the file
				        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
				    
				        // Setting the file name
				        downloadLink.download = filename;
				        
				        //triggering the function
				        downloadLink.click();
				    }
		
	}

	
</script>