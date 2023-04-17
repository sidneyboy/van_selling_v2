<div class="form-group">
	<label>SELECT DR</label>
	<select class="form-control select2" name="sales_register_id" required>
		<option value="" default>SELECT</option>
		@foreach($sales_register as $data)
		<option value="{{ $data->id }}">{{ $data->dr }}</option>
		@endforeach
	</select>
</div>
<script type="text/javascript">
	$('.select2').select2()
</script>