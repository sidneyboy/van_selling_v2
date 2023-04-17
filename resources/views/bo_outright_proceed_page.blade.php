<form id="bo_outright_proceed_generate_sku_and_deduction">
	@csrf
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>DESC</th>
				<th>QTY</th>
				<th>BO</th>
			</tr>
		</thead>
		<tbody>
			@foreach($van_selling_transaction->van_selling_transaction_details as $details)
				<tr>
					<th>
						{{ $details->description }} - {{ $details->price }}
						<input type="hidden" name="unit_price[{{ $details->sku_code }}]" value="{{ $details->price }}">
						<input type="hidden" name="purchase_sku_code[]" value="{{ $details->sku_code }}">
					</th>
					<th>
						{{ $details->quantity }}
						<input type="hidden" name="purchase_quantity[{{ $details->sku_code }}]" value="{{ $details->quantity }}">
					</th>
					<th><input type="number" name="bo_quantity[{{ $details->sku_code }}]" min="0" value="0" required class="form-control"></th>
				</tr>
			@endforeach
		</tbody>
	</table>
	<input type="hidden" name="van_selling_transaction_id" value="{{ $van_selling_transaction_id }}">
	<input type="hidden" name="delivery_receipt" value="{{ $van_selling_transaction->delivery_receipt }}">
	<input type="hidden" name="date" value="{{ $van_selling_transaction->date }}">
	<input type="hidden" name="customer_id" value="{{ $van_selling_transaction->id }}">
	<input type="hidden" name="store_name" value="{{ $van_selling_transaction->store_name }}">
	<input type="hidden" name="store_type" value="{{ $van_selling_transaction->store_type }}">
	<input type="hidden" name="full_address" value="{{ $van_selling_transaction->full_address }}">
	<input type="hidden" name="user_id" value="{{ $user_id }}">
	<input type="hidden" name="full_name" value="{{ $full_name }}">
	<label>SKU:</label>
	<select class="form-control select2" id="sku_code" name="sku_code" required style="width:100%;">
		<option value="" default>SELECT</option>
		@foreach($van_selling_details as $data)
			<option value="{{ $data->sku_code }}">{{ $data->sku_code ." - ". $data->description ."[₱ ". $data->unit_price ."](". $data->butal_equivalent .") - ". $data->unit_of_measurement  }}</option>
		@endforeach
	</select>
	<label>SKU:</label>
	<input type="number" name="quantity" required class="form-control">
	<br />
	<button class="btn btn-block btn-info">GENERATE SKU AND OUTRIGHT DEDUCTION</button>
</form>

<script type="text/javascript">
	$('.select2').select2()
	$("#bo_outright_proceed_generate_sku_and_deduction").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "bo_outright_proceed_generate_sku_and_deduction",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
               
                $('#bo_outright_proceed_generate_sku_and_deduction_page').html(data);
                $('.loading').hide();
                
            },
      });
    }));
</script>