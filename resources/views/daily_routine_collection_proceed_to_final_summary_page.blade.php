@if($sales_register_status == 'set')
	<form method="post" action="{{ route('daily_routine_collection_end_and_proceed') }}" accept-charset="UTF-8">
	{{-- <form id="daily_routine_collection_end_and_proceed"> --}}
		@csrf
		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>REMITTANCE FORM</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th style="text-align: right;">AGENT NAME:</th>
						<th style="text-align: center;text-transform: uppercase;">{{ $agent->name }}</th>
					</tr>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th style="text-align: center;">OVER ALL COLLECTION(<span style="color:green;">SUMMARY</span>)</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th style="width:14.28px;text-align: center;">PARTICULARS</th>
						<th style="width:14.28px;text-align: center;">BANK</th>
						<th style="width:14.28px;text-align: center;">CHECK #</th>
						<th style="width:14.28px;text-align: center;">DATE</th>
						<th style="width:14.28px;text-align: center;">AMOUNT</th>
						<th style="width:14.28px;text-align: center;">TOTAL AMOUNT FOR DEPOSIT</th>
						<th style="width:14.28px;text-align: center;">REMARKS</th>
					</tr>
				</thead>
				<tbody>
					@for ($i=0; $i < $particulars; $i++)
					<tr>
						<td>
							{{ $particular_cash_or_check[$i] }}
							<input type="hidden" name="particular_cash_or_check[]" value="{{ $particular_cash_or_check[$i] }}">
						</td>
						<td>
							{{ $bank[$i] }}
							<input type="hidden" name="bank[]" value="{{ $bank[$i] }}">
						</td>
						<td>
							{{ $check_no[$i] }}
							<input type="hidden" name="check_no[]" value="{{ $check_no[$i] }}">
						</td>
						<td>
							{{ $date_collected[$i] }}
							<input type="hidden" name="check_date[]" value="{{ $date_collected[$i] }}">
						</td>
						<td style="text-align: right;">
							{{ number_format($particular_amount[$i],2,".",",")   }}
							@php
							$sum_amount[] = $particular_amount[$i];
							@endphp
							<input type="hidden" name="particular_amount[]" value="{{ $particular_amount[$i] }}">
						</td>
						<td style="text-align: right;">
							@if($particular_cash_or_check[$i] == 'CASH' OR $particular_cash_or_check[$i] == 'CHECK')
								{{ number_format($particular_amount[$i],2,".",",") }}
								@php
									$sum_total[] = $particular_amount[$i];
								@endphp
							@else
								@php
									$particular_refer_amount[] = $particular_amount[$i];
									$particular_refer_cash_or_check[] = $particular_cash_or_check[$i];
									$particular_refer_remarks[] = $remarks[$i];
								@endphp
							@endif
							@if($particular_cash_or_check[$i] == 'CASH' OR $particular_cash_or_check[$i] == 'REFER CASH')
								@php
									$sum_all_cash[] = $particular_amount[$i];
								@endphp		
							@endif
							@if($particular_cash_or_check[$i] == 'CASH')
								@php
									$sum_all_cash_total_for_deposit[] = $particular_amount[$i];
								@endphp		
							@endif
							@if($particular_cash_or_check[$i] == 'CHECK' OR $particular_cash_or_check[$i] == 'REFER CHECK')
								@php
									$sum_all_check_amount[] = $particular_amount[$i];
								@endphp		
							@endif
							@if($particular_cash_or_check[$i] == 'CHECK')
								@php
									$sum_all_check_total_for_deposit[] = $particular_amount[$i];
								@endphp		
							@endif
						</td>
						<td>
							{{ $remarks[$i] }}
							<input type="hidden" name="remarks[]" value="{{ $remarks[$i] }}">
						</td>
					</tr>
					@endfor
				</tbody>
				<tfoot>
				
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: center;">GRAND TOTAL</th>
					<th style="text-align: right;">{{  number_format(array_sum($sum_amount),2,".",",") }}</th>
					<th style="text-align: right;">
						{{ number_format(array_sum($sum_total),2,".",",") }}
						<input type="hidden" name="total_collected_sum_amount" id="total_collected_sum_amount" value="{{ array_sum($sum_amount) }}">
						<input type="hidden" name="total_collected_sum_total" value="{{ array_sum($sum_total) }}">
					</th>
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
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: center;">TOTAL CASH</th>
					<th style="text-align: right;">
						{{ number_format(array_sum($sum_all_cash),2,".",",") }}
					</th>
					<th style="text-align: right;">
						{{ number_format(array_sum($sum_all_cash_total_for_deposit),2,".",",") }}
					</th>
					<th></th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: center;">TOTAL CHECK</th>
					<th style="text-align: right;">
						{{ number_format(array_sum($sum_all_check_amount),2,".",",") }}
					</th>
					<th style="text-align: right;">
						{{ number_format(array_sum($sum_all_check_total_for_deposit),2,".",",") }}
					</th>
					<th></th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: center;">GRAND TOTAL</th>
					<th style="text-align: right;">{{  number_format(array_sum($sum_all_cash) + array_sum($sum_all_check_amount),2,".",",") }}</th>
					<th style="text-align: right;">
						{{  number_format(array_sum($sum_all_cash_total_for_deposit) + array_sum($sum_all_check_total_for_deposit),2,".",",") }}
						<input type="hidden" name="total_collected_sum_total" value="{{ array_sum($sum_all_cash_total_for_deposit) + array_sum($sum_all_check_total_for_deposit) }}">
					</th>
					<th></th>
				</tr>
				</tfoot>
			</table>
		</div>
		{{-- @if(isset($particular_refer_cash_or_check))
			@php
				$particular_counter = count($particular_refer_cash_or_check);
			@endphp
		@else
			@php
				$particular_counter = 0;
			@endphp
		@endif --}}
		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th colspan="2" style="text-align: center;">PAYMENT APPLIED AS FOLLOWS:(<span style="color:green;">SUMMARY</span>)</th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th style="width:16.67px;text-align: center;">DR NO</th>
						<th style="width:16.67px;text-align: center;">BALANCE</th>
						<th style="width:16.67px;text-align: center;">CASH</th>
						<th style="width:16.67px;text-align: center;">CHECK</th>
						<th style="width:16.67px;text-align: center;">REMARKS</th>
						<th style="width:16.67px;text-align: center;">OVERPAYMENT</th>
					</tr>
				</thead>
				<tbody>
					@foreach($ar_ledger_id as $data)
					<tr>
						<td>
							{{ $locpd_delivery_receipt[$data] }}
							<input type="hidden" name="ar_ledger_id[]" value="{{ $data }}">
							<input type="hidden" name="locpd_delivery_receipt[{{ $data }}]" value="{{ $locpd_delivery_receipt[$data] }}">
						</td>
						<td style="text-align: right;">
							{{ number_format($locpd_total_amount[$data],2,".",",") }}
							<input type="hidden" name="locpd_total_amount[{{ $data }}]" value="{{ $locpd_total_amount[$data] }}">
						</td>
						<td style="text-align: right;">
							{{  number_format($locpd_cash[$data],2,".",",")  }}
							@php
							$sum_locpd_cash[] = $locpd_cash[$data];
							@endphp
							<input type="hidden" name="locpd_cash[{{ $data }}]" value="{{ $locpd_cash[$data] }}">
						</td>
						<td style="text-align: right;">
							{{  number_format($locpd_check[$data],2,".",",")  }}
							@php
							$sum_locpd_check[] = $locpd_check[$data];
							@endphp
							<input type="hidden" name="locpd_check[{{ $data }}]" value="{{ $locpd_check[$data] }}">
						</td>
						<td>
							{{ $locpd_remarks[$data] }}
							<input type="hidden" name="locpd_remarks[{{ $data }}]" value="{{ $locpd_remarks[$data] }}">
						</td>
						<td style="text-align: right;">
							@if($locpd_total_amount[$data] > $locpd_cash[$data] + $locpd_check[$data])
							@php
							$over_payment = 0;
							@endphp
							@else
							@php
							$over_payment = ($locpd_cash[$data] + $locpd_check[$data]) - $locpd_total_amount[$data];
							@endphp
							@endif
							@php
							echo number_format($over_payment,2,".",",");
							$sum_over_payment[] = $over_payment;
							@endphp
							<input type="hidden" name="locpd_over_payment[{{ $data }}]" value="{{ $over_payment }}">
						</td>
					</tr>
					@endforeach
					{{-- @if($particular_counter != 0)
						@for ($i=0; $i < $particular_counter; $i++)
							<tr>
								<td>
									{{ $particular_refer_cash_or_check[$i] }}
									<input type="hidden" name="particular_refer_delivery_receipt[]" value="{{ $particular_refer_cash_or_check[$i] }}">
								</td>
								<td>
									NO BALANCE DATA
									<input type="hidden" name="particular_refer_total_amount[]" value="{{ 0 }}">
								</td>
								@if($particular_refer_cash_or_check[$i] == 'REFER CASH')
								<td style="text-align: right;">{{ number_format($particular_refer_amount[$i],2,".",",")  }}</td>
								<td style="text-align: right;">0.00</td>
								@php
								$particular_refer_cash = $particular_refer_amount[$i];
								$particular_refer_check = 0;
								@endphp
								@else
								<td style="text-align: right;">0.00</td>
								<td style="text-align: right;">{{ number_format($particular_refer_amount[$i],2,".",",") }}</td>
								@php
								$particular_refer_cash = 0;
								$particular_refer_check = $particular_refer_amount[$i];
								@endphp
								@endif
								
								<input type="hidden" name="particular_refer_cash[]" value="{{ $particular_refer_cash }}">
								<input type="hidden" name="particular_refer_check[]" value="{{ $particular_refer_check }}">
								@php
								$sum_particular_refer_cash[] = $particular_refer_cash;
								$sum_particular_refer_check[] = $particular_refer_check;
								@endphp
								<td>
									{{ $particular_refer_remarks[$i] }}
									<input type="hidden" name="particular_refer_remarks[]" value="{{ $particular_refer_remarks[$i] }}">
								</td>
								<td style="text-align: right;">
									0.00
									<input type="hidden" name="particular_refer_over_payment[]" value="{{ 0 }}">
								</td>
							</tr>
						@endfor
					@else	
						@php
							$sum_particular_refer_cash[] = 0;
							$sum_particular_refer_check[] = 0;
						@endphp --}}
					{{-- @endif --}}
				</tbody>
				<tfoot>
				<tr>
					<th>TOTAL</th>
					<th></th>
					{{-- <th style="text-align: right;">{{  number_format(array_sum($sum_locpd_cash)  + array_sum($sum_particular_refer_cash),2,".",",")  }}</th>
					<th style="text-align: right;">{{  number_format(array_sum($sum_locpd_check) +  array_sum($sum_particular_refer_check),2,".",",")  }}</th> --}}
					<th style="text-align: right;">{{  number_format(array_sum($sum_locpd_cash),2,".",",")  }}</th>
					<th style="text-align: right;">{{  number_format(array_sum($sum_locpd_check),2,".",",")  }}</th>
					<th></th>
					<th style="text-align: right;">{{  number_format(array_sum($sum_over_payment),2,".",",")  }}</th>
				</tr>
				</tfoot>
			</table>
		</div>
		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th style="text-align: center;" colspan="2">LESS REFER:(<span style="color:green;">SUMMARY</span>)</th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th style="width:16.67px;text-align: center;">AGENT</th>
						<th style="width:16.67px;text-align: center;">PRINCIPAL</th>
						<th style="width:16.67px;text-align: center;">DR</th>
						<th style="width:16.67px;text-align: center;">CASH</th>
						<th style="width:16.67px;text-align: center;">CHECK</th>
						<th style="width:16.67px;text-align: center;">REMARKS</th>
					</tr>
				</thead>
				<tbody>
					@for ($i=0; $i < $less_referals; $i++)
					<tr>
						<td>
							{{ $less_refer_agent[$i] }}
							<input type="hidden" name="less_refer_agent[]" value="{{ $less_refer_agent[$i] }}">
						</td>
						<td>
							{{ $less_refer_principal[$i] }}
							<input type="hidden" name="less_refer_principal[]" value="{{ $less_refer_principal[$i] }}">
						</td>
						<td>
							{{ $less_refer_dr[$i] }}
							<input type="hidden" name="less_refer_delivery_receipt[]" value="{{ $less_refer_dr[$i] }}">
						</td>
						<td style="text-align: right;">
							{{ number_format($less_refer_cash[$i],2,".",",") }}
							@php
							$sum_less_refer_cash[] = $less_refer_cash[$i];
							@endphp
							<input type="hidden" name="less_refer_cash[]" value="{{ $less_refer_cash[$i] }}">
						</td>
						<td style="text-align: right;">
							{{ number_format($less_refer_check[$i],2,".",",") }}
							@php
							$sum_less_refer_check[] = $less_refer_check[$i];
							@endphp
							<input type="hidden" name="less_refer_check[]" value="{{ $less_refer_check[$i] }}">
						</td>
						<td>
							{{ $less_refer_remarks[$i] }}
							<input type="hidden" name="less_refer_remarks[]" value="{{ $less_refer_remarks[$i] }}">
						</td>
					</tr>
					@endfor
				</tbody>
				<tfoot>
				<tr>
					<th>TOTAL</th>
					<th></th>
					<th></th>
					<th style="text-align: right;">
						{{ number_format(array_sum($sum_less_refer_cash),2,".",",") }}
					</th>
					<th style="text-align: right;">
						{{ number_format(array_sum($sum_less_refer_check),2,".",",") }}
					</th>
					<th></th>
				</tr>
				<tr>
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
					<th style="text-align: center;">TOTAL CASH</th>
					<th>{{ number_format(array_sum($sum_less_refer_cash) + array_sum($sum_locpd_cash) ,2,".",",") }}</th>
					<th>{{ number_format(+ array_sum($sum_locpd_check) + array_sum($sum_less_refer_check),2,".",",") }}</th>
					<th></th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th style="text-align: center;">GRAND TOTAL</th>
					<th colspan="2" style="text-align: center;">{{ number_format(array_sum($sum_less_refer_cash) + array_sum($sum_locpd_cash) + array_sum($sum_locpd_check) + array_sum($sum_less_refer_check),2,".",",") }}</th>
					<th></th>
				</tr>
				</tfoot>
			</table>
		</div>
		<div class="row">
			<div class="col-md-12">
				{{-- <input type="hidden" id="total_distribued_amount" value="{{ array_sum($sum_locpd_cash)  + array_sum($sum_particular_refer_cash) + array_sum($sum_locpd_check) +  array_sum($sum_particular_refer_check) + array_sum($sum_over_payment) + array_sum($sum_less_refer_cash) + array_sum($sum_less_refer_check) }}"> --}}
				<input type="hidden" id="total_distribued_amount" value="{{ array_sum($sum_locpd_cash) + array_sum($sum_locpd_check) + array_sum($sum_over_payment) + array_sum($sum_less_refer_cash) + array_sum($sum_less_refer_check) }}">
				<input type="hidden" name="particulars" value="{{ $particulars }}">
				<input type="hidden" name="less_referals" value="{{ $less_referals }}">
				<input type="hidden" name="sales_register_status" value="{{ $sales_register_status }}">
				{{-- <input type="hidden" name="particular_counter" value="{{ $particular_counter }}"> --}}
				<input type="hidden" name="or_number" value="{{ $or_number }}">
				<button type="submit" id="submit" class="btn btn-success btn-block">SUBMIT COLLECTION</button>
			</div>
		</div>
	</form>
@else
<form method="post" action="{{ route('daily_routine_collection_end_and_proceed') }}" accept-charset="UTF-8">
{{-- <form id="daily_routine_collection_end_and_proceed"> --}}
		@csrf
		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th colspan="7" style="text-align: center;">OVER ALL COLLECTION(<span style="color:green;">SUMMARY</span>)</th>
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
					@for ($i=0; $i < $particulars; $i++)
					<tr>
						<td>
							{{ $particular_cash_or_check[$i] }}
							<input type="hidden" name="particular_cash_or_check[]" value="{{ $particular_cash_or_check[$i] }}">
						</td>
						<td>
							{{ $bank[$i] }}
							<input type="hidden" name="bank[]" value="{{ $bank[$i] }}">
						</td>
						<td>
							{{ $check_no[$i] }}
							<input type="hidden" name="check_no[]" value="{{ $check_no[$i] }}">
						</td>
						<td>
							{{ $date_collected[$i] }}
							<input type="hidden" name="check_date[]" value="{{ $date_collected[$i] }}">
						</td>
						<td style="text-align: right;">
							{{ number_format($particular_amount[$i],2,".",",")   }}
							@php
							$sum_amount[] = $particular_amount[$i];
							@endphp
							<input type="hidden" name="particular_amount[]" value="{{ $particular_amount[$i] }}">
						</td>
						<td style="text-align: right;">
							@if($particular_cash_or_check[$i] == 'CASH' OR $particular_cash_or_check[$i] == 'CHECK')
							{{ number_format($particular_amount[$i],2,".",",") }}
							@php
							$sum_total[] = $particular_amount[$i];
							@endphp
							@else
							@php
							$particular_refer_amount[] = $particular_amount[$i];
							$particular_refer_cash_or_check[] = $particular_cash_or_check[$i];
							$particular_refer_remarks[] = $remarks[$i];
							$sum_total[] = 0;
							@endphp
							@endif
						</td>
						<td>
							{{ $remarks[$i] }}
							<input type="hidden" name="remarks[]" value="{{ $remarks[$i] }}">
						</td>
					</tr>
					@endfor
				</tbody>
				<tfoot>
				<tr>
					<th>TOTAL</th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align: right;">{{  number_format(array_sum($sum_amount),2,".",",") }}</th>
					<th style="text-align: right;">
					{{-- 	{{ number_format(array_sum($sum_total),2,".",",") }}
						<input type="hidden" name="total_amount_collected" value="{{ array_sum($sum_total) }}"> --}}
						{{ number_format(array_sum($sum_total),2,".",",") }}
						<input type="hidden" name="total_collected_sum_amount" id="total_collected_sum_amount" value="{{ array_sum($sum_amount) }}">
						<input type="hidden" name="total_collected_sum_total" value="{{ array_sum($sum_total) }}">
					</th>
					<th></th>
				</tr>
				</tfoot>
			</table>
		</div>
		{{-- @if(isset($particular_refer_cash_or_check))
			@php
				$particular_counter = count($particular_refer_cash_or_check);
			@endphp
		@else
			@php
				$particular_counter = 0;
			@endphp
		@endif --}}
		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th style="text-align: center;" colspan="6">PAYMENT APPLIED AS FOLLOWS:(<span style="color:green;">SUMMARY</span>)</th>
					</tr>
					<tr>
						<th>DR NO</th>
						<th>BALANCE</th>
						<th>CASH</th>
						<th>CHECK</th>
						<th>REMARKS</th>
						<th>OVERPAYMENT</th>
					</tr>
				</thead>
				<tbody>
					@if($particular_counter != 0)
						@for ($i=0; $i < $particular_counter; $i++)
					<tr>
						<td>
							{{ $particular_refer_cash_or_check[$i] }}
							<input type="hidden" name="particular_refer_delivery_receipt[]" value="{{ $particular_refer_cash_or_check[$i] }}">
						</td>
						<td>
							NO BALANCE DATA
							<input type="hidden" name="particular_refer_total_amount[]" value="{{ 0 }}">
						</td>
						@if($particular_refer_cash_or_check[$i] == 'REFER CASH')
							<td style="text-align: right;">{{ number_format($particular_refer_amount[$i],2,".",",")  }}</td>
							<td style="text-align: right;">0.00</td>
							@php
								$particular_refer_cash = $particular_refer_amount[$i];
								$particular_refer_check = 0;
							@endphp
						@else
							<td style="text-align: right;">0.00</td>
							<td style="text-align: right;">{{ number_format($particular_refer_amount[$i],2,".",",") }}</td>
							@php
								$particular_refer_cash = 0;
								$particular_refer_check = $particular_refer_amount[$i];
							@endphp
						@endif
							
							<input type="hidden" name="particular_refer_cash[]" value="{{ $particular_refer_cash }}">
							<input type="hidden" name="particular_refer_check[]" value="{{ $particular_refer_check }}">
							@php
								$sum_particular_refer_cash[] = $particular_refer_cash;
								$sum_particular_refer_check[] = $particular_refer_check;
							@endphp
							<td>
								{{ $particular_refer_remarks[$i] }}
								<input type="hidden" name="particular_refer_remarks[]" value="{{ $particular_refer_remarks[$i] }}">
							</td>
							<td style="text-align: right;">
								0.00
								<input type="hidden" name="particular_refer_over_payment[]" value="{{ 0 }}">
							</td>
					</tr>
					@endfor
					@else
						@php
							$sum_particular_refer_cash[] = 0;
							$sum_particular_refer_check[] = 0;
						@endphp
					@endif
				</tbody>
				<tfoot>
				<tr>
					<th>TOTAL</th>
					<th></th>
					<th style="text-align: right;">{{  number_format(array_sum($sum_particular_refer_cash),2,".",",")  }}</th>
					<th style="text-align: right;">{{  number_format(array_sum($sum_particular_refer_check),2,".",",")  }}</th>
					<th></th>
					<th style="text-align: right;">{{  number_format(0,2,".",",")  }}</th>
				</tr>
				</tfoot>
			</table>
		</div>

		@if($less_referals != 0)
			<div class="table table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th style="text-align: center;" colspan="6">LESS REFER:(<span style="color:green;">SUMMARY</span>)</th>
						</tr>
						<tr>
							<th>AGENT</th>
							<th>PRINCIPAL</th>
							<th>DR</th>
							<th>CASH</th>
							<th>CHECK</th>
							<th>REMARKS</th>
						</tr>
					</thead>
					<tbody>
						@for ($i=0; $i < $less_referals; $i++)
						<tr>
							<td>
								{{ $less_refer_agent[$i] }}
								<input type="hidden" name="less_refer_agent[]" value="{{ $less_refer_agent[$i] }}">
							</td>
							<td>
								{{ $less_refer_principal[$i] }}
								<input type="hidden" name="less_refer_principal[]" value="{{ $less_refer_principal[$i] }}">
							</td>
							<td>
								{{ $less_refer_dr[$i] }}
								<input type="hidden" name="less_refer_delivery_receipt[]" value="{{ $less_refer_dr[$i] }}">
							</td>
							<td style="text-align: right;">
								{{ number_format($less_refer_cash[$i],2,".",",") }}
								@php
								$sum_less_refer_cash[] = $less_refer_cash[$i];
								@endphp
								<input type="hidden" name="less_refer_cash[]" value="{{ $less_refer_cash[$i] }}">
							</td>
							<td style="text-align: right;">
								{{ number_format($less_refer_check[$i],2,".",",") }}
								@php
								$sum_less_refer_check[] = $less_refer_check[$i];
								@endphp
								<input type="hidden" name="less_refer_check[]" value="{{ $less_refer_check[$i] }}">
							</td>
							<td>
								{{ $less_refer_remarks[$i] }}
								<input type="hidden" name="less_refer_remarks[]" value="{{ $less_refer_remarks[$i] }}">
							</td>
						</tr>
						@endfor
					</tbody>
					<tfoot>
					<tr>
						<th>TOTAL</th>
						<th></th>
						<th></th>
						<th colspan="2" style="text-align: center;">
							{{ number_format(array_sum($sum_less_refer_cash),2,".",",") }}
						</th>
						<th colspan="2" style="text-align: center;">
							{{ number_format(array_sum($sum_less_refer_check),2,".",",") }}
						</th>
						<th></th>
					</tr>
					</tfoot>
				</table>
			</div>
		@else
			<td>
				{{ $less_refer_agent[$i] }}
				<input type="hidden" name="less_refer_agent[]" value="{{ $less_refer_agent[$i] }}">
			</td>
			<td>
				{{ $less_refer_principal[$i] }}
				<input type="hidden" name="less_refer_principal[]" value="{{ $less_refer_principal[$i] }}">
			</td>
			<td>
				{{ $less_refer_dr[$i] }}
				<input type="hidden" name="less_refer_delivery_receipt[]" value="{{ $less_refer_dr[$i] }}">
			</td>
			<td style="text-align: right;">
				{{ number_format($less_refer_cash[$i],2,".",",") }}
				@php
				$sum_less_refer_cash[] = $less_refer_cash[$i];
				@endphp
				<input type="hidden" name="less_refer_cash[]" value="{{ $less_refer_cash[$i] }}">
			</td>
			<td style="text-align: right;">
				{{ number_format($less_refer_check[$i],2,".",",") }}
				@php
				$sum_less_refer_check[] = $less_refer_check[$i];
				@endphp
				<input type="hidden" name="less_refer_check[]" value="{{ $less_refer_check[$i] }}">
			</td>
			<td>
				{{ $less_refer_remarks[$i] }}
				<input type="hidden" name="less_refer_remarks[]" value="{{ $less_refer_remarks[$i] }}">
			</td>
		@endif



		<div class="row">
			<div class="col-md-12">
				<input type="hidden" id="total_distribued_amount" value="{{ array_sum($sum_particular_refer_cash) +  array_sum($sum_particular_refer_check) + array_sum($sum_less_refer_cash) + array_sum($sum_less_refer_check) }}">
				<input type="hidden" name="particulars" value="{{ $particulars }}">
				<input type="hidden" name="less_referals" value="{{ $less_referals }}">
				<input type="hidden" name="sales_register_status" value="{{ $sales_register_status }}">
				<input type="hidden" name="particular_counter" value="{{ $particular_counter }}">
				<input type="hidden" name="or_number" value="{{ $or_number }}">
				<button type="submit" id="submit" class="btn btn-success btn-block">SUBMIT COLLECTION</button>
			</div>
		</div>
	</form>
@endif
<script type="text/javascript">

	  //$("#daily_routine_collection_end_and_proceed").on('submit',(function(e){
   //        e.preventDefault();
   //        $('.loading').show();
		
		 // if ($('#total_distribued_amount').val() != $('#total_collected_sum_amount').val()) {
   //           Swal.fire(
		 // 	  'INPUT ERROR',
		 // 	  'TOTAL AMOUNT COLLECTED NOT EQUAL TO AMOUNT DISTRIBUTED',
		 // 	  'error'
		 // 	)
		 // 	$('.loading').hide();
   //       }else{
   //           $.ajax({
   //            url: "daily_routine_collection_end_and_proceed",
   //            type: "POST",
   //            data:  new FormData(this),
   //            contentType: false,
   //            cache: false,
   //            processData:false,
   //            success: function(data){
   //              console.log(data);
            
   //            },
   //           });
   //       }
		
		
		
          
   //    }));


	$( "#submit" ).click(function() {
		if ($('#total_distribued_amount').val() != $('#total_collected_sum_amount').val()) {
            Swal.fire(
			  'INPUT ERROR',
			  'TOTAL AMOUNT COLLECTED NOT EQUAL TO AMOUNT DISTRIBUTED',
			  'error'
			)
			$('.loading').hide();
        }else{
		    $('.loading').show();
	        Swal.fire({
			  position: 'top-end',
			  icon: 'success',
			  title: 'Your work has been saved',
			  showConfirmButton: false,
			  timer: 1500
			})
        }
	});
</script>