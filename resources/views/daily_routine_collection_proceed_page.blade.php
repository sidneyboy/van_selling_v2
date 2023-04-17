@if($sales_register_status == 'set')
	<form id="daily_routine_collection_proceed_to_final_summary">
		@csrf
		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th colspan="6" style="text-align: center;">OVER ALL COLLECTION(<span style="color:blue;">INPUT</span>)</th>
					</tr>
					<tr>
						<th>PARTICULARS</th>
						<th>BANK</th>
						<th>CHECK #</th>
						<th>DATE</th>
						<th>AMOUNT</th>
						<th>REMARKS</th>
					</tr>
				</thead>
				<tbody>
					@for ($i=0; $i < $particulars; $i++)
					<tr>
						<td>
							<select style="width:100px;" class="form-control select2" required name="particular_cash_or_check[]">
								<option value="" default>SELECT PARTICULARS</option>
								<option value="CASH">CASH</option>
								<option value="CHECK">CHECK</option>
								<option value="REFER CASH">REFER CASH</option>
								<option value="REFER CHECK">REFER CHECK</option>
							</select>
						</td>
						<td>
							<input style="width:100px;" type="text" name="bank[]" class="form-control">
						</td>
						<td>
							<input style="width:100px;" type="text" name="check_no[]" class="form-control">
						</td>
						<td><input style="width:150px;" type="date" name="date_collected[]" class="form-control"></td>
						<td>
							<input type="text" name="amount[]" class="currency-default" required style="display: block;
							width: 100px;
							height: calc(2.25rem + 2px);
							padding: .375rem .75rem;
							font-size: 1rem;
							font-weight: 400;
							line-height: 1.5;
							color: #495057;
							background-color: #fff;
							background-clip: padding-box;
							border: 1px solid #ced4da;
							border-radius: .25rem;
							box-shadow: inset 0 0 0 transparent;
							transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;">
						</td>
						<td><input type="text" name="remarks[]" class="form-control" style="width:100px;" value="NONE" required></td>
					</tr>
					@endfor
				</tbody>
			</table>
		</div>
		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th colspan="6" style="text-align: center;">PAYMENT APPLIED AS FOLLOWS(<span style="color:blue">INPUT</span>):</th>
					</tr>
					<tr>
						<th>DR NO</th>
						<th>BALANCE</th>
						<th>CASH</th>
						<th>CHECK</th>
						<th>REMARKS</th>
					</tr>
				</thead>
				<tbody>
					@for ($i=0; $i < $counter; $i++)
					<tr>
						<td>
							{{ $delivery_receipt[$i] }}
							<input type="hidden" name="locpd_delivery_receipt[{{ $ar_ledger_id[$i] }}]" value="{{ $delivery_receipt[$i] }}">
							<input type="hidden" name="ar_ledger_id[]" value="{{ $ar_ledger_id[$i] }}">
						</td>
						<td>
							{{ number_format($final_balance[$i],2,".",",") }}
							<input type="hidden" name="locpd_total_amount[{{ $ar_ledger_id[$i] }}]" value="{{ $final_balance[$i] }}">
						</td>
						<td>
							<input type="text" name="locpd_cash[{{ $ar_ledger_id[$i] }}]" required class="currency-default" style="display: block;
							width: 100px;
							height: calc(2.25rem + 2px);
							padding: .375rem .75rem;
							font-size: 1rem;
							font-weight: 400;
							line-height: 1.5;
							color: #495057;
							background-color: #fff;
							background-clip: padding-box;
							border: 1px solid #ced4da;
							border-radius: .25rem;
							box-shadow: inset 0 0 0 transparent;
							transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;">
						</td>
						<td>
							<input type="text" name="locpd_check[{{ $ar_ledger_id[$i] }}]" required class="currency-default" style="display: block;
							width: 100px;
							height: calc(2.25rem + 2px);
							padding: .375rem .75rem;
							font-size: 1rem;
							font-weight: 400;
							line-height: 1.5;
							color: #495057;
							background-color: #fff;
							background-clip: padding-box;
							border: 1px solid #ced4da;
							border-radius: .25rem;
							box-shadow: inset 0 0 0 transparent;
							transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;">
						</td>
						<td><input style="width:100px;" type="text" name="locpd_remarks[{{ $ar_ledger_id[$i] }}]" class="form-control" value="NONE" required></td>
					</tr>
					@endfor
				</tbody>
			</table>
		</div>
		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th colspan="6" style="text-align: center;">LESS REFER(<span style="color:blue">INPUT</span>)</th>
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
						<input type="text" name="less_refer_agent[]" required class="form-control" style="width:100px;">
					</td>
					<td>
						<input type="text" name="less_refer_principal[]" required class="form-control" style="width:100px;">
					</td>
					<td>
						<input type="text" name="less_refer_dr[]" required class="form-control" style="width:100px;">
					</td>
					<td><input type="text" name="less_refer_cash[]" required class="currency-default" style="display: block;
						width: 100px;
						height: calc(2.25rem + 2px);
						padding: .375rem .75rem;
						font-size: 1rem;
						font-weight: 400;
						line-height: 1.5;
						color: #495057;
						background-color: #fff;
						background-clip: padding-box;
						border: 1px solid #ced4da;
						border-radius: .25rem;
						box-shadow: inset 0 0 0 transparent;
					transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"></td>
					<td><input type="text" name="less_refer_check[]" required class="currency-default" style="display: block;
						width: 100px;
						height: calc(2.25rem + 2px);
						padding: .375rem .75rem;
						font-size: 1rem;
						font-weight: 400;
						line-height: 1.5;
						color: #495057;
						background-color: #fff;
						background-clip: padding-box;
						border: 1px solid #ced4da;
						border-radius: .25rem;
						box-shadow: inset 0 0 0 transparent;
					transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"></td>
					<td><input type="text" name="less_refer_remarks[]" value="NONE" required class="form-control" style="width:100px;"></td>
						</tr>
					@endfor
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input type="hidden" name="particulars" value="{{ $particulars }}">
				<input type="hidden" name="counter" value="{{ $counter }}">
				<input type="hidden" name="less_referals" value="{{ $less_referals }}">
				<input type="hidden" name="sales_register_status" value="{{ $sales_register_status }}">
				<input type="hidden" name="or_number" value="{{ $or_number }}">
				<button type="submit" class="btn btn-block btn-info">PROCEED TO FINAL SUMMARY</button>
			</div>
		</div>
	</form>



@else
	<form id="daily_routine_collection_proceed_to_final_summary">
		<div class="table table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th colspan="6" style="text-align: center;">OVER ALL COLLECTION(<span style="color:blue;">INPUT</span>)</th>
					</tr>
					<tr>
						<th>PARTICULARS</th>
						<th>BANK</th>
						<th>CHECK #</th>
						<th>DATE</th>
						<th>AMOUNT</th>
						<th>REMARKS</th>
					</tr>
				</thead>
				<tbody>
					@for ($i=0; $i < $particulars; $i++)
					<tr>
						<td>
							<select style="width:100px;" class="form-control select2" required name="particular_cash_or_check[]">
								<option value="" default>SELECT PARTICULARS</option>
								<option value="CASH">CASH</option>
								<option value="CHECK">CHECK</option>
								<option value="REFER CASH">REFER CASH</option>
								<option value="REFER CHECK">REFER CHECK</option>
							</select>
						</td>
						<td>
							<input style="width:100px;" type="text" name="bank[]" class="form-control">
						</td>
						<td>
							<input style="width:100px;" type="text" name="check_no[]" class="form-control">
						</td>
						<td><input style="width:150px;" type="date" name="date_collected[]" class="form-control"></td>
						<td>
							<input type="text" name="amount[]" class="currency-default" required style="display: block;
							width: 100px;
							height: calc(2.25rem + 2px);
							padding: .375rem .75rem;
							font-size: 1rem;
							font-weight: 400;
							line-height: 1.5;
							color: #495057;
							background-color: #fff;
							background-clip: padding-box;
							border: 1px solid #ced4da;
							border-radius: .25rem;
							box-shadow: inset 0 0 0 transparent;
							transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;">
						</td>
						<td><input type="text" name="remarks[]" class="form-control" style="width:100px;" value="NONE" required></td>
					</tr>
					@endfor
				</tbody>
			</table>
		</div>
		
		@if($less_referals != 0)
			<div class="table table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th colspan="6" style="text-align: center;">LESS REFER(<span style="color:blue">INPUT</span>)</th>
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
						<td>
							<input type="text" name="less_refer_agent[]" required class="form-control" style="width:100px;">
						</td>
						<td>
							<input type="text" name="less_refer_principal[]" required class="form-control" style="width:100px;">
						</td>
						<td>
							<input type="text" name="less_refer_dr[]" required class="form-control" style="width:100px;">
						</td>
						<td><input type="text" name="less_refer_cash[]" required class="currency-default" style="display: block;
							width: 100px;
							height: calc(2.25rem + 2px);
							padding: .375rem .75rem;
							font-size: 1rem;
							font-weight: 400;
							line-height: 1.5;
							color: #495057;
							background-color: #fff;
							background-clip: padding-box;
							border: 1px solid #ced4da;
							border-radius: .25rem;
							box-shadow: inset 0 0 0 transparent;
						transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"></td>
						<td><input type="text" name="less_refer_check[]" required class="currency-default" style="display: block;
							width: 100px;
							height: calc(2.25rem + 2px);
							padding: .375rem .75rem;
							font-size: 1rem;
							font-weight: 400;
							line-height: 1.5;
							color: #495057;
							background-color: #fff;
							background-clip: padding-box;
							border: 1px solid #ced4da;
							border-radius: .25rem;
							box-shadow: inset 0 0 0 transparent;
						transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;"></td>
						<td><input type="text" name="less_refer_remarks[]" value="NONE" required class="form-control" style="width:100px;"></td>
						@endfor
					</tbody>
				</table>
			</div>
		@else

			<input type="hidden" value="" name="less_refer_agent[]" required class="form-control" style="width:100px;">
			<input type="hidden" value="" name="less_refer_principal[]" required class="form-control" style="width:100px;">
			<input type="hidden" value="" name="less_refer_dr[]" required class="form-control" style="width:100px;">
			<input type="hidden" value="" name="less_refer_cash[]" required class="currency-default" style="display: block;
				width: 100px;
				height: calc(2.25rem + 2px);
				padding: .375rem .75rem;
				font-size: 1rem;
				font-weight: 400;
				line-height: 1.5;
				color: #495057;
				background-color: #fff;
				background-clip: padding-box;
				border: 1px solid #ced4da;
				border-radius: .25rem;
				box-shadow: inset 0 0 0 transparent;
				transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;">
			<input type="hidden" value="" name="less_refer_check[]" required class="currency-default" style="display: block;
				width: 100px;
				height: calc(2.25rem + 2px);
				padding: .375rem .75rem;
				font-size: 1rem;
				font-weight: 400;
				line-height: 1.5;
				color: #495057;
				background-color: #fff;
				background-clip: padding-box;
				border: 1px solid #ced4da;
				border-radius: .25rem;
				box-shadow: inset 0 0 0 transparent;
				transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;">
			<input type="hidden" value="" name="less_refer_remarks[]" value="NONE" required class="form-control" style="width:100px;">
		@endif

		<div class="row">
			<div class="col-md-12">
				<input type="hidden" name="particulars" value="{{ $particulars }}">
				<input type="hidden" name="counter" value="{{ 0 }}">
				<input type="hidden" name="less_referals" value="{{ $less_referals }}">
				<input type="hidden" name="sales_register_status" value="{{ $sales_register_status }}">
				<input type="hidden" name="or_number" value="{{ $or_number }}">
				<button type="submit" class="btn btn-block btn-info">PROCEED TO FINAL SUMMARY</button>
			</div>
		</div>
	</form>
@endif

<script type="text/javascript">
	$('[class=currency-default]').maskNumber();
    $('[class=currency-data-attributes]').maskNumber();
    $('[class=currency-configuration]').maskNumber({decimal: '_', thousands: '*'});
    $('[class=integer-default]').maskNumber({integer: true});
    $('[class=integer-data-attribute]').maskNumber({integer: true});
    $('[class=integer-configuration]').maskNumber({integer: true, thousands: '_'});

    $("#daily_routine_collection_proceed_to_final_summary").on('submit',(function(e){
        e.preventDefault();
        //$('.loading').show();
          $.ajax({
            url: "daily_routine_collection_proceed_to_final_summary",
            type: "post",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
             
              if (data == 'EXISTING_OR_NUMBER') {
              	Swal.fire(
				  'ERROR OR NUMBER',
				  'EXISTING_OR_NUMBER',
				  'error'
				)
				$('.loading').hide();
              }else{
              	 $('#daily_routine_collection_proceed_to_final_summary_page').html(data);
              	 $('.loading').hide();

              }

            },
      });
    }));
</script>