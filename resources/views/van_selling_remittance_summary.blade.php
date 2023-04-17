<form id="van_selling_remittance_save">
	<div class="table table-responsive">
		<table class="table table-bordered table-sm">
			<thead>
				<tr>
					<th colspan="2" style="text-align: center;">SUMMARY OF DATA ACCOUNTS</th>
				</tr>
				<tr>
					<th>PREV OUTSTANDING BALANCE:</th>
					<th>{{ number_format($prev_outstanding_balance,2,".",",") }}</th>
				</tr>
				<tr>
					<th>REMITTANCE:</th>
					<th>{{ number_format($remittance,2,".",",") }}</th>
				</tr>
				<tr>
					<th>RUNNING BALANCE:</th>
					<th>
						@php
						$running_balance = $prev_outstanding_balance - $remittance;
						echo number_format($running_balance,2,".",",");
						@endphp
					</th>
				</tr>
			</thead>
			<tfoot>
			<tr>
				<th colspan="2">
					<input type="hidden" name="prev_outstanding_balance" value="{{ $prev_outstanding_balance }}">
					<input type="hidden" name="remittance" value="{{ $remittance }}">
					<input type="hidden" name="running_balance" value="{{ $running_balance }}">
					<button type="submit" class="btn btn-block btn-success">SUBMIT TRANSACTION</button>
				</th>
			</tr>
			</tfoot>
		</table>
	</div>
</form>

<script type="text/javascript">
	  $("#van_selling_remittance_save").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "van_selling_remittance_save",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
            
                 if (data == 'saved') {
                  Swal.fire(
                    'TRANSACTION SUBMITTED',
                    'PLEASE SEE VAN SELLING AR LEDGER',
                    'success'
                  )
                  $('.loading').hide();
                  window.location.href = "van_selling_ar_ledger";
                 }else{
                  Swal.fire(
                    'SOMETHING WENT WRONG',
                    'CONTACT ADMIN',
                    'error'
                  )
                  $('.loading').hide();
                 }
            },
      });
    }));
</script>