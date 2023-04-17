<style type="text/css">
.wrapper {
position: relative;
height: 200px;
-moz-user-select: none;
-webkit-user-select: none;
-ms-user-select: none;
user-select: none;
}
.signature-pad {
position: absolute;
left: 0;
top: 0;
width:100%;
height:200px;
background-color: white;
}
</style>
<form method="post" action="{{ route('bo_outright_save_transaction') }}" accept-charset="UTF-8">
{{-- <form id="bo_outright_save_transaction"> --}}
	<div id="print_table">
	<table class="table table-sm table-borderless" style="font-size:19.5px;font-family: Arial, Helvetica, sans-serif;">
		<thead>
			<tr>
				<th style="text-align: center;" colspan="4">JULMAR COMMERCIAL INC.</th>
			</tr>
			<tr>
				<th style="text-align: center;" colspan="4">GENERAL MERCHANDISE WHOLESALE & RETAIL</th>
			</tr>
			<tr>
				<th style="text-align: center;" colspan="4">OSMENA ST., COGON MARKET CAGAYAN DE ORO CITY</th>
			</tr>
			<tr>
				<th style="text-align: center;" colspan="4">TEL 857-6197, 858-5771</th>
			</tr>
			<tr>
				<th style="text-align: center;" colspan="4">Vat Reg. TIN 486-701-947-000</th>
			</tr>
			<tr>
				<th style="text-align: center;" colspan="4">REP: {{ $full_name }}</th>
			</tr>
			<tr>
				
				<th style="text-align: center;">
					STORE NAME: {{ $store_name }}
					<input type="hidden" name="store_name" value="{{ $store_name }}">
				</th>
			</tr>
			<tr>
				
				<th style="text-align: center;">
					STORE TYPE:{{ $store_type }}
					<input type="hidden" name="store_type" value="{{ $store_type }}">
				</th>
			</tr>
			<tr>
				<th style="text-align: center;">
					FULL ADDRESS:{{ $full_address }}
					<input type="hidden" name="full_address" value="{{ $full_address }}">
				</th>
			</tr>
		</thead>
	</table>
	<table class="table table-sm table-borderless" style="font-size:19.5px;font-family: Arial, Helvetica, sans-serif;">
		<thead>
			<tr>
				<th style="text-align: center;" colspan='3'>PREVIOUS TRANSACTION </th>
			</tr>
			<tr>
				<th style="text-align: center;" colspan="3">DR: {{ $van_selling_transaction->delivery_receipt }}</th>
			</tr>
			<tr>
				<th style="text-align: center;" colspan="3">DATE: {{ $van_selling_transaction->date }}</th>
			</tr>
			<tr>
				<th>DESC</th>
				<th>QTY</th>
				<th>SUB</th>
			</tr>
		</thead>
		<tbody>
			@foreach($van_selling_transaction->van_selling_transaction_details as $details)
			<tr>
				<th>
					{{ $details->description }} - {{ $details->price }}
				</th>
				<th>{{ $details->quantity }}</th>
				<th>
					{{ $details->quantity * $details->price }}
					@php
						$prev_total[] = $details->quantity * $details->price;
					@endphp
				</th>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
		<tr>
			<th>TOTAL</th>
			<th></th>
			<th>{{ array_sum($prev_total) }}</th>
		</tr>
		</tfoot>
	</table>
	<table class="table table-sm table-borderless" style="font-size:19.5px;font-family: Arial, Helvetica, sans-serif;">
		<thead>
			<tr>
				<th></th>
			</tr>
			<tr>
				<th style="text-align: center" colspan="3">NEW TRANSACTION</th>
			</tr>
			<tr>
				<th style="text-align: center" colspan="3">DR: {{ $delivery_receipt }}</th>
			</tr>
			<tr>
				<th style="text-align: center" colspan="3">DATE: {{ $date }}</th>
			</tr>
			<tr>
				<th>DESC</th>
				<th>QTY</th>
				<th>SUB</th>
			</tr>
		</thead>
		<tbody>
			@foreach($van_selling_cart_data as $data)
			<tr>
				<th>
					<span style="font-weight: bold;color:green;"></span>{{  $data->description }}<br />
				</th>
				<th style="text-align: right;">{{ $data->quantity }}</th>
				<th style="text-align: right;">
					@php
					$sub_total = $data->quantity * $data->price;
					$sum_total[] = $sub_total;
					echo number_format($sub_total,2,".",",");
					@endphp
					<input type="hidden" name="amount[{{ $data->sku_code }}]" value="{{ $sub_total }}">
				</th>
			</tr>
			@endforeach
			<tr>
				<th colspan="2">TOTAL</th>
				<th style="text-align: right;">{{ number_format(array_sum($sum_total),2,".",",") }}</th>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-borderless" style="font-size:19.5px;font-family: Arial, Helvetica, sans-serif;">
		<thead>
			<tr>
				<th></th>
			</tr>
			<tr>
				<th style="text-align: center" colspan="3">BO OUTRIGHT DEDUCTION</th>
			</tr>
			<tr>
				<th style="text-align: center" colspan="3">DATE: {{ $date }}</th>
			</tr>
			<tr>
				<th>DESC</th>
				<th>QTY</th>
				<th>SUB</th>
			</tr>
		</thead>
		<tbody>
			@foreach($van_selling_transaction->van_selling_transaction_details as $details)
				@if($bo_quantity[$details->sku_code] != 0)
					<tr>
						<th>{{ $details->description }} - {{ $unit_price[$details->sku_code] }}</th>
						<th style="text-align: right;">{{ $bo_quantity[$details->sku_code] }}</th>
						<th style="text-align: right;">
							{{ number_format($bo_quantity[$details->sku_code]*-1 * $unit_price[$details->sku_code],2,".",",") }}
							@php
							$bo_total[] = $bo_quantity[$details->sku_code]*-1 * $unit_price[$details->sku_code];
							@endphp
							<input type="hidden" name="bo_quantity[{{ $details->sku_code }}]" value="{{ $bo_quantity[$details->sku_code] }}">
							<input type="hidden" name="bo_description[{{ $details->sku_code }}]" value="{{ $details->description }}">
							<input type="hidden" name="bo_sku_code[]" value="{{ $details->sku_code }}">
							<input type="hidden" name="bo_purchase_quantity[{{ $details->sku_code }}]" value="{{ $details->quantity }}">
							<input type="hidden" name="bo_unit_price[{{ $details->sku_code }}]" value="{{ $unit_price[$details->sku_code] }}">
						</th>
					</tr>
				@endif
			@endforeach
			<tr>
				<th colspan="2">TOTAL</th>
				<th>{{ number_format(array_sum($bo_total),2,".",",")  }}</th>
			</tr>
		</tbody>
	</table>

	<table class="table table-sm table-borderless" style="font-size:19.5px;font-family: Arial, Helvetica, sans-serif;">
		<thead>
			<tr>
				<th colspan="3" style="text-align: center;">FINAL SUMMARY</th>
			</tr>
			<tr>
				<th colspan="2">PREV. TOTAL</th>
				<th style="text-align: right;">{{ number_format(array_sum($sum_total),2,".",",") }}</th>
			</tr>
			<tr>
				<th colspan="2">BO. TOTAL</th>
				<th style="text-align: right;">{{ number_format(array_sum($bo_total),2,".",",") }}</th>
			</tr>
			<tr>
				<th colspan="2">GRANDTOTAL</th>
				<th style="text-align: right;">
					@php
						$grandtotal = array_sum($sum_total) + array_sum($bo_total);
					@endphp
					{{ number_format($grandtotal,2,".",",") }}
					<input type="hidden" name="van_selling_transaction_id" value="{{ $van_selling_transaction_id }}">
					<input type="hidden" name="total_bo_amount" value="{{ array_sum($bo_total) }}">
					<input type="hidden" name="delivery_receipt" value="{{ $delivery_receipt }}">
					<input type="hidden" name="user_id" value="{{ $user_id }}">
					<input type="hidden" name="total_amount" value="{{ array_sum($sum_total) }}">
					<input type="hidden" name="prev_total" value="{{ array_sum($prev_total) }}"> 
				</th>
			</tr>
		</thead>
	</table>
		
		<div class="wrapper">
			<canvas id="signature-pad" style="border:dotted;width:100%;height:150px;" class="signature-pad"></canvas>
		</div>
	</div>

<br />

@if($grandtotal > 0)
	<button type="submit" id="submit" class="btn btn-success btn-block" style="display:none ;">SUBMIT</button>
	<button class="btn btn-info btn-block" type="button" id="convert">CONVERT TO IMAGE</button>
@else
	<span style="color:red;">CANNOT PROCEED! GRANDTOTAL MUST NOT BE NEGATIVE!</span>
@endif

<div style="" id="result">
	<!-- Result will appear be here -->
</div>
<input type="hidden" id="download_button_counter" value="1">
</form>
<script>
 $("#convert").on('click',(function(e){
      var counter = parseInt($('#download_button_counter').val());
      if (counter >= 3) {
        $('#convert').hide();
        $('#submit').show();
      }else{
        var resultDiv = document.getElementById("result");
        html2canvas(document.getElementById("print_table"), {
            onrendered: function(canvas) {
              var img = canvas.toDataURL("image/png");
              result.innerHTML = '<a download="{{ $store_name }}.jpeg" style="display:block;width:100%;border:none;background-color: #04AA6D;padding: 14px 28px;font-size: 16px;cursor: pointer;text-align: center;color:white;" href="'+img+'" id="download_button">DOWNLOAD IMAGE</a>';
                 $('#new_transaction').show();
                 document.getElementById('download_button').click();
                 $('#download_button').hide();
                 $('#convert').show();
            }
        });
        
        counter++;
        $('#download_button_counter').val(counter);
        $('#convert').show();
        $('#submit').show();
      }
 }));
   
 $("#submit").on('click',(function(e){
  $('.loading').show();
 }));

  // $("#bo_outright_save_transaction").on('submit',(function(e){
  //       e.preventDefault();
  //       //$('.loading').show();
  //         $.ajax({
  //           url: "bo_outright_save_transaction",
  //           type: "POST",
  //           data:  new FormData(this),
  //           contentType: false,
  //           cache: false,
  //           processData:false,
  //           success: function(data){
              
  //             console.log(data);
  //              // if (data === 'saved') {
  //              //    Swal.fire({
  //              //      position: 'top-end',
  //              //      icon: 'success',
  //              //      title: 'Your work has been saved,Reloading Page!',
  //              //      showConfirmButton: false,
  //              //      timer: 1500
  //              //    })
  //              //    location.href = 'van_selling_transaction ';
  //              // }else{
  //              //    Swal.fire(
  //              //      'Something Went Wrong',
  //              //      'Code Error!',
  //              //      'Error'
  //              //    )
  //              //    $('.loading').hide();
  //              // }
              
  //         },
  //     });
  //   }));
</script>

<script src="{{ asset('js/signature_pad.umd.js') }}"></script>
<script src="{{ asset('js/app2.js') }}"></script>



<script type="text/javascript">
var canvas = document.getElementById('signature-pad');
// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
// When zoomed out to less than 100%, for some very strange reason,
// some browsers report devicePixelRatio as less than 1
// and only part of the canvas is cleared then.
var ratio =  Math.max(window.devicePixelRatio || 1, 1);
canvas.width = canvas.offsetWidth * ratio;
canvas.height = canvas.offsetHeight * ratio;
canvas.getContext("2d").scale(ratio, ratio);
}
window.onresize = resizeCanvas;
resizeCanvas();
var signaturePad = new SignaturePad(canvas, {
backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
});
document.getElementById('save-png').addEventListener('click', function () {
if (signaturePad.isEmpty()) {
return alert("Please provide a signature first.");
}

var data = signaturePad.toDataURL('image/png');
console.log(data);
window.open(data);
});
document.getElementById('save-jpeg').addEventListener('click', function () {
if (signaturePad.isEmpty()) {
return alert("Please provide a signature first.");
}
var data = signaturePad.toDataURL('image/jpeg');
console.log(data);
window.open(data);
});
document.getElementById('save-svg').addEventListener('click', function () {
if (signaturePad.isEmpty()) {
return alert("Please provide a signature first.");
}
var data = signaturePad.toDataURL('image/svg+xml');
console.log(data);
console.log(atob(data.split(',')[1]));
window.open(data);
});
document.getElementById('clear').addEventListener('click', function () {
signaturePad.clear();
});
document.getElementById('draw').addEventListener('click', function () {
var ctx = canvas.getContext('2d');
console.log(ctx.globalCompositeOperation);
ctx.globalCompositeOperation = 'source-over'; // default value
});
document.getElementById('erase').addEventListener('click', function () {
var ctx = canvas.getContext('2d');
ctx.globalCompositeOperation = 'destination-out';
});
</script>

