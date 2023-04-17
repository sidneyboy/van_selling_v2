<div class="table table-responsive" >
	<table class="table table-bordered table-hover" id="example2">
		<thead>
			<tr>
				<th>DATE</th>
				<th>CUSTOMER</th>
				<th>SO #</th>
				<th>SO AMOUNT</th>
				<th>REF #</th>
				<th>COLLECTION</th>
				<th>BO</th>
				<th>REMARKS</th>
			</tr>
		</thead>
		<tbody>
			@foreach($ledger as $data)
				<tr>
					<td>{{ $data->date }}</td>
					<td>{{ $data->customer->store_name }}</td>
					<td>{{ $data->so_number }}</td>
					<td>{{ number_format($data->so_amount,2,".",",")  }}</td>
					
					<td>
						<button class="btn btn-link ref_id" value="{{ $data->ref_id ."-". $data->remarks }}">{{ $data->ref_id }}</button>
					</td>
					
					<td>{{ number_format($data->collection,2,".",",") }}</td>
					<td>{{ number_format($data->bo,2,".",",") }}</td>

					<td>
						{{-- 
						@if($data->remarks == 'COLLECTION')
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $data->id }}">
								  {{ $data->remarks }}
								</button>

								<!-- Modal -->
								<div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">UPLOAD IMAGE</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								    <form action="{{ route('summary_of_transaction_ledger_upload_image') }}" method="POST" enctype="multipart/form-data">
					     				@csrf
								      <div class="modal-body">
					     					<input type='file' name="image" class="form-control" required/>
						      				<input type="hidden" name="ref_id" value="{{ $data->ref_id }}">
					     					<input type="hidden" name="customer_id" value="{{ $data->customer_id }}">
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								        <button type="submit" class="btn btn-primary">Upload</button>
								      </div>
								    </form>
								    </div>
								  </div>
								</div>
						@else
							
						@endif --}}
						{{ $data->remarks }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$("#example1").DataTable();
    $('#example2').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    });

    $( ".ref_id" ).click(function(e) {
    	e.preventDefault();
    	//$('.loading').show();
    	var ref_id = $(this);
		$.ajax({
	      type: "POST",
	      url: "summary_of_transaction_ledger_generate_detailed_report",
	      data: 'ref_id=' + ref_id.val(),
	      cache: false,
	      success: function(data){
	      	console.log(data);
	      	$('.loading').hide();
			$('#summary_of_transaction_ledger_generate_detailed_report_page').html(data);
	      },
	      error: function(error){
	        console.log(error);
	      }
	    });
	});
</script>