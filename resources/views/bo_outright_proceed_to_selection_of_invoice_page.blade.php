<label>SELECT INVOICE:</label>
<select class="form-control select2" name="van_selling_transaction_id" required>
	<option value="" default>SELECT</option>
	@foreach($van_selling_transaction as $data)
		<option value="{{ $data->id }}">{{ $data->store_name ." - ". $data->delivery_receipt ." [ ". $data->total_amount ." ] "  }}</option>
	@endforeach
</select>

<script type="text/javascript">
	$('.select2').select2()
</script>