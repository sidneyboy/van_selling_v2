<div id="html-content-holder">
	<table class="table table-sm" style="font-size: 18px;font-family: Arial, Helvetica, sans-serif;" id=export_table>
		<thead>
			<tr>
				<th colspan="4" style="text-align: center;">{{ $agent_user }}</th>
			</tr>
			<tr>
				<th colspan="4" style="text-align: center;">{{ $principal }} INVENTORY</th>
			</tr>
			<tr>
				<th colspan="4" style="text-align: center;">{{ $date_from }} TO {{ $date_to }}</th>
			</tr>
			<tr>
				<th>Principal</th>
				<th>Description</th>
				<th>End</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			@if($counter != 0)
				@for ($i=0; $i < $counter; $i++)
					<tr>
						<th>{{ $van_selling_details[$i]->principal }}</th>
						<th>{{ $van_selling_details[$i]->description ." ". $van_selling_details[$i]->sku_code }}</th>
						<th>
							@php
								echo $ending_balance = $van_selling_details[$i]->beg + $van_selling_details[$i]->total_van_load + $van_selling_details[$i]->total_sales + $van_selling_details[$i]->total_adjustments;
							@endphp
						</th>
						<th style='font-size:15px;'>
							@php
								$total = $ending_balance * $new_query_for_van_selling_ledger[$i]->unit_price;
								$sum_total[] = $total;
								echo "₱". number_format($total,2,".",",");
							@endphp
						</th>
					</tr>
				@endfor
			@else
				<tr>
					<th colspan="6" style="text-align:center;font-weight: bold;color:red;">NO DATA FOUND USING THIS DATE RANGE</th>
				</tr>
			@endif
		</tbody>
		<tfoot>
			<tr>
				<th colspan="4" style="text-align: center;">GRAND TOTAL: {{ "₱".number_format(array_sum($sum_total),2,".",",") }}</th>
			</tr>
		</tfoot>
	</table>

	

    <input type="button" value="DOWNLOAD INVENTORY" class="btn btn-success btn-block" id="btnConvert" >
    <br />
    <div id="previewImg">
    </div>

</div>
<script type="text/javascript">
	$( ".show_ledger_details" ).click(function(e) {
		e.preventDefault();
    	$('.loading').show();
    	var data = $(this);
		$.ajax({
	      type: "POST",
	      url: "van_selling_ledger_show_details",
	      data: 'data=' + data.val(),
	      cache: false,
	      success: function(data){
	      	console.log(data);
	      	$('.loading').hide();
			$('#van_selling_ledger_show_details_page').html(data);
	      },
	      error: function(error){
	        console.log(error);
	      }
	    });
	});

	$("#example1").DataTable();
    $('.example2').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    });


	$("#btnConvert").on('click', function () {
		$('.loading').show();
			html2canvas(document.getElementById("html-content-holder")).then(function (canvas) {
				var anchorTag = document.createElement("a");
				document.body.appendChild(anchorTag);
				document.getElementById("previewImg").appendChild(canvas);
				anchorTag.download = "INVENTORY - {{ uniqid() }}.jpg";
				anchorTag.href = canvas.toDataURL();
				anchorTag.target = '_blank';
				anchorTag.click();
				$('#previewImg').hide();
				$('#btnConvert').hide();
				$('.loading').hide();
			});
	});
	
</script>