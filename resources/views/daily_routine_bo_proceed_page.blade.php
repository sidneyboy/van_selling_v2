<form id="daily_routine_bo_proceed_final_summary">
    @csrf
    <div class="table table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>DESC</th>
                    <th>RGS - QTY</th>
                    <th>BO - QTY</th>
                    <th>REMARKS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales_register_details as $data)
                <tr>
                    <td>
                        <span style="color:blue;">[{{ $data->sku->sku_code }}]</span> <br />
                        {{ $data->sku->description }} <br />
                        UOM - <span style="color:blue;">{{ $data->sku->unit_of_measurement }}</span> <br />
                        D Qty - <span style="color:blue">{{ $data->quantity }}</span> <br />
                        U/P - <span style="color:blue;">{{ number_format($data->price,2,".",",") }}</span>
                        <input type="hidden" name="sku[]" value="{{ $data->sku_id }}">
                        <input type="hidden" name="sku_code[{{ $data->sku_id }}]" value="{{ $data->sku->sku_code }}">
                        <input type="hidden" name="description[{{ $data->sku_id }}]" value="{{ $data->sku->description }}">
                        <input type="hidden" name="unit_of_measurement[{{ $data->sku_id }}]" value="{{ $data->sku->unit_of_measurement }}">
                        <input type="hidden" name="delivered_quantity[{{ $data->sku_id }}]" value="{{ $data->quantity }}">
                        <input type="hidden" name="unit_price[{{ $data->sku_id }}]" value="{{ $data->price }}">
                    </td>
                    <td><input style="text-align: center;" class="form-control" type="number" min="0" value="0" name="rgs_quantity[{{ $data->sku_id }}]"></td>
                    <td><input style="text-align: center;" class="form-control" type="number" min="0" value="0" name="bo_quantity[{{ $data->sku_id }}]"></td>
                    <td><input class="form-control" type="text" value="NONE" name="remarks[{{ $data->sku_id }}]"></td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">
                        <input type="hidden" name="customer_id" value="{{ $customer_id }}">
                        <input type="hidden" name="principal_id" value="{{ $principal_id }}">
                        <input type="hidden" name="sales_register_id" value="{{ $sales_register_id }}">
                        <button type="submit" class="btn btn-info btn-block">PROCEED TO FINAL SUMMARY</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>

<script type="text/javascript">
      $("#daily_routine_bo_proceed_final_summary").on('submit',(function(e){
        e.preventDefault();
        // /$('.loading').show();
          $.ajax({
            url: "daily_routine_bo_proceed_final_summary",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
               $('.loading').hide();
               $('#daily_routine_bo_proceed_final_summary').html(data);
            },
        });
    }));
</script>