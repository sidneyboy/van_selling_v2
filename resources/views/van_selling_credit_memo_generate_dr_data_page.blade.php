<form id="van_selling_credit_memo_proceed_to_final_summary">
	<div class="table table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>DESCRIPTION</th>
					<th>RGS</th>
					<th>BO</th>
					<th>REMARKS</th>
				</tr>
			</thead>
			<tbody>
				@foreach($van_selling_transaction->van_selling_transaction_details as $data)
				<tr>
					<td>
						<span style="font-weight:bold;color:blue;">{{ $data->sku_code }} <br /></span>
						<span style="font-weight:bold;color:blue;"> {{ $data->description }} </span><br />
						Qty - <span style="font-weight:bold;color: green;">{{ $data->quantity }}</span>
						<input type="hidden" name="description[{{ $data->id }}]" value="{{ $data->description }}">
						<input type="hidden" name="sku_code[{{ $data->id }}]" value="{{ $data->sku_code }}">
						<input type="hidden" name="quantity[{{ $data->id }}]" value="{{ $data->quantity }}">
						<input type="hidden" name="details_id[]" value="{{ $data->id }}">
            <input type="hidden" name="unit_price[{{ $data->id }}]" value="{{ $data->price }}">
            <input type="hidden" name="van_selling_transaction_id" value="{{ $van_selling_transaction->id }}">
            <input type="hidden" name="delivery_receipt" value="{{ $van_selling_transaction->delivery_receipt }}">
					</td>
					<td><input type="number" min="0" style="width:100%;" name="rgs_quantity[{{ $data->id }}]" class="form-control" required value="0"></td>
					<td><input type="number" min="0" style="width:100%;" name="bo_quantity[{{ $data->id }}]" class="form-control" required value="0"></td>
					<th><input type="text" name="remarks[{{ $data->id }}]" value="NONE" required class="form-control"></th>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-info btn-block">PROCEED TO FINAL SUMMARY</button>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	  $("#van_selling_credit_memo_proceed_to_final_summary").on('submit',(function(e){
        e.preventDefault();
       //$('.loading').show();
          $.ajax({
            url: "van_selling_credit_memo_proceed_to_final_summary",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){

                if (data == 'over_quantity_for_rgs_and_bo') {
                  Swal.fire(
                    'CANNOT PROCEED RGS AND BO QTY ERROR!',
                    'Total Quantity of Rgs and Bo cannot exceed DR Quantity',
                    'error'
                  )
                  $('.loading').hide();
                }else if(data == 'over_rgs_quantity'){
                  Swal.fire(
                    'CANNOT PROCEED RGS QTY ERROR!',
                    'Rgs Quantity cannot exceed DR Quantity',
                    'error'
                  )
                  $('.loading').hide();
                }else if(data == 'over_bo_quantity'){
                  Swal.fire(
                    'CANNOT PROCEED BO QTY ERROR!',
                    'Bo Quantity cannot exceed DR Quantity',
                    'error'
                  )
                  $('.loading').hide();
                }else{
                  $('#van_selling_credit_memo_proceed_to_final_summary_page').html(data);
                  $('.loading').hide();
                }
            },
      });
    }));

</script>