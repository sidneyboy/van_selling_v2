<form id="bo_outright_report_proceed_to_export">
	<div class="table table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>DATE</th>
					<th>DELIVERY RECEIPT</th>
					<th>TOTAL BO AMOUNT</th>
					<th>REMARKS</th>
				</tr>
			</thead>
			<tbody>
				@foreach($van_selling_bo_outright as $data)
					<tr>
						<th>{{ $data->date }}</th>
						<th>{{ $data->van_selling_transaction->delivery_receipt }}</th>
						<th style="text-align: right;">{{ $data->total_bo_amount }}</th>
						<th>{{ $data->remarks }}</th>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4">
						<input type="hidden" name="date_from" value="{{ $date_from }}">
						<input type="hidden" name="date_to" value="{{ $date_to }}">
						<input type="hidden" name="full_name" value="{{ $full_name }}">
						<input type="hidden" name="user_id" value="{{ $user_id }}">
						<button type="submit" class="btn btn-info btn-block">PROCEED TO EXPORT</button>
					</th>
				</tr>
			</tfoot>
		</table>
	</div>
</form>

<script type="text/javascript">
	$("#bo_outright_report_proceed_to_export").on('submit',(function(e){
        e.preventDefault();
        //$('.loading').show();
          $.ajax({
            url: "bo_outright_report_proceed_to_export",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
                if (data == 'NO_DATA_FOUND') {
                    Swal.fire(
                        'CANNOT PROCEED!',
                        'NO DATA FOUND!',
                        'error'
                    )
                    $('.loading').hide();
                    $('#bo_outright_report_proceed_to_export_page').hide();
                }else{
                  $('#bo_outright_report_proceed_to_export_page').html(data);
                  $('.loading').hide();
                }
            },
      });
    }));

</script>