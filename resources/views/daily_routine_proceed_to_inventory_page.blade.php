@if($sales_order_counter != 0)
    <div class="table table-responsive" >
    <form id="daily_routine_proceed_to_final_summary">
        @csrf
        <input type="hidden" name="customer_id" value="{{ $customer_id }}">
        <input type="hidden" name="principal_id" value="{{ $principal_id }}">
        <table class="table table-bordered table-hover" id="example2">
            <thead>
                <tr>
                    <th>DESCRIPTION</th>
                    <th>QTY</th>
                    <th>CM QTY</th>
                    <th>REMARKS</th>
                    <th><input type="checkbox" class="form-control" id="select_all" style="height: 25px;width: 25px;background-color: #eee"/></th>

                </tr>
            </thead>
            <tbody>
                @foreach($sku as $data)
                    @if($data->sku_type != 'Butal')
                        <tr>
                            <td>
                                <span style="color:blue;">[{{ $data->sku_code }}] - </span> {{ $data->description }} <br />
                                    <span style="color:orange"> {{ $data->unit_of_measurement }}</span> <br />
                                <input type="hidden" name="description[{{ $data->id }}]" value="{{ $data->description }}">
                                 <input type="hidden" name="sku_code[{{ $data->id }}]" value="{{ $data->sku_code }}">
                                 <input type="hidden" name="unit_of_measurement[{{ $data->id }}]" value="{{ $data->unit_of_measurement }}">
                                 <input type="hidden" name="sku_type[{{ $data->id }}]" value="{{ $data->sku_type }}">
                            </td>
                            <td><input type="number" style="text-align: center;" class="form-control" name="quantity[{{ $data->id }}]" value="0" min="0" ></td>
                            <td><input type="number" style="text-align: center;" class="form-control" name="cm_quantity[{{ $data->id }}]" value="0" min="0"></td>
                            <td><input type="text" class="form-control" name="remarks[{{ $data->id }}]"></td>
                            <td><input class="checkbox form-control" style="height: 25px;width: 25px;background-color: #eee" type="checkbox" name="sku[]" value="{{ $data->id }}"></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <input type="hidden" name="customer_id" value="{{ $customer_id }}">
        <div class="form-group">
            <button type="submit" class="btn btn-info btn-block">PROCEED TO INVENTORY SUMMARY</button>
        </div>
    </form>
</div>

@else
<form method="post" action="{{ route('daily_routine_proceed_to_submit_beginning_inventory') }}" accept-charset="UTF-8">
    @csrf
    <p style="color:blue;"><i>Note: Please Provide Beginning Inventory First!</i></p>
    <div class="row">
        <div class="col-md-12">
           <div class="form-group">
                <label>Last Visit:</label>
                <input type="date" name="date" class="form-control" required>
           </div>
        </div>
    </div>
    <div class="table table-responsive">
        

            <input type="hidden" name="customer_id" value="{{ $customer_id }}">
            <input type="hidden" name="principal_id" value="{{ $principal_id }}">
            <table class="table table-bordered table-hover" id="example2">
                <thead>
                    <tr>
                        <th>DESCRIPTION</th>
                        <th>QTY BEG.</th>
                        <th>REMARKS</th>
                        <th>PREV DELIVERY</th>
                        <th><input type="checkbox" class="form-control" id="select_all" style="height: 25px;width: 25px;background-color: #eee"/></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sku as $data)
                    <tr>
                        <td>
                            <span style="color:blue;">[{{ $data->sku_code }}] - </span> {{ $data->description }} <br />
                            <span style="color:orange"> {{ $data->unit_of_measurement }}</span><br />
                            
                            <input type="hidden" name="description[{{ $data->id }}]" value="{{ $data->description }}">
                            <input type="hidden" name="sku_code[{{ $data->id }}]" value="{{ $data->sku_code }}">
                            <input type="hidden" name="unit_of_measurement[{{ $data->id }}]" value="{{ $data->unit_of_measurement }}">
                            <input type="hidden" name="sku_type[{{ $data->id }}]" value="{{ $data->sku_type }}">
                        </td>
                        <td><input type="number" class="form-control" name="quantity[{{ $data->id }}]" value="0" min="0" ></td>
                        <td><input type="text" class="form-control" name="remarks[{{ $data->id }}]"></td>
                        <td><input type="number" class="form-control" name="prev_delivery_quantity[{{ $data->id }}]" value="0" min="0" ></td>
                        <td><input class="checkbox form-control" style="height: 25px;width: 25px;background-color: #eee" type="checkbox" name="sku[]" value="{{ $data->id }}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <input type="hidden" name="customer_id" value="{{ $customer_id }}">
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">SUBMIT BEGINNING INVENTORY</button>
            </div>
        </form>
    </div>
@endif


<script type="text/javascript">
    var select_all = document.getElementById("select_all"); //select all checkbox
    var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

    //select all checkboxes
    select_all.addEventListener("change", function(e){
        for (i = 0; i < checkboxes.length; i++) { 
            checkboxes[i].checked = select_all.checked;
        }
    });


    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
            //uncheck "select all", if one of the listed checkbox item is unchecked
            if(this.checked == false){
                select_all.checked = false;
            }
            //check "select all" if all checkbox items are checked
            if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
                select_all.checked = true;
            }
        });
    }

    $("#example1").DataTable();
    $('#example2').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    });

     $("#daily_routine_proceed_to_final_summary").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "daily_routine_proceed_to_final_summary",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
             
                if(data == 'no_sales_register'){
                  Swal.fire(
                  'NO SALES REGISTER UPLOADED',
                  'PLEASE UPLOAD SALES REGISTER FOR THIS CUSTOMER!',
                  'error'
                  )
                  $('.loading').hide();
                  
                }else{
                   $('#daily_routine_proceed_to_final_summary_page').html(data);
                     $('.loading').hide();
                }
            },
      });
    }));

</script>

