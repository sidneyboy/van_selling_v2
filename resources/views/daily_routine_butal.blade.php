 @extends('layouts.master')

 @section('title', 'DAILY ROUTINE BUTAL')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">DAILY ROUTINE BUTAL INVENTORY FORasdasd <span style="color:blue;">({{ $customer->store_name }} - {{ $principal->principal }} - {{ $customer_principal_code->store_code }})</span></h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="{{ route('daily_routine_collection') }}" class="btn btn-info float-right">PROCEED TO COLLECTION</a>
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-12">
                    <form id="daily_routine_butal_proceed_to_suggested_so">
                        <input type="hidden" name="store_code" value="{{ $customer_principal_code->store_code }}">
                        <input type="hidden" name="store_name" value="{{ $customer->store_name }}">
                        
                        <div class="table table-responsive">
                            <table class="table table-bordered table-hover" id="example2">
                                <thead>
                                    <tr>
                                        <th>SKU CODE</th>
                                        <th>DESCRIPTION</th>
                                        <th>UOM</th>
                                        <th>QTY</th>
                                        <th>CM QTY</th>
                                        <th>REMARKS</th>
                                        <th><input type="checkbox" class="form-control" id="select_all" style="height: 25px;width: 25px;background-color: #eee"/></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sku as $data)
                                    @if($data->sku_type != 'Case')
                                    <tr>
                                        <td>
                                            <input type="hidden" name="sku_code[{{ $data->id }}]" value="{{ $data->sku_code }}">
                                            {{ $data->sku_code }}
                                        </td>
                                        <td>
                                            {{ $data->description }}
                                            <input type="hidden" name="description[{{ $data->id }}]" value="{{ $data->description }}">
                                        </td>
                                        <td>
                                            {{ $data->unit_of_measurement }}
                                            <input type="hidden" name="unit_of_measurement[{{ $data->id }}]" value="{{ $data->unit_of_measurement }}">
                                        </td>
                                        <td><input type="number" style="text-align: center;" class="form-control" name="quantity[{{ $data->id }}]" value="0" min="0" ></td>
                                        <td><input type="number" style="text-align: center;" class="form-control" name="cm_quantity[{{ $data->id }}]" value="0" min="0" ></td>
                                        <td><input type="text" class="form-control" name="remarks[{{ $data->id }}]"></td>
                                        <td><input class="checkbox form-control" style="height: 25px;width: 25px;background-color: #eee" type="checkbox" name="sku[]" value="{{ $data->id }}"></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block">PROCEED TO INVENTORY SUMMARY</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div id="daily_routine_butal_proceed_to_suggested_so_page"></div>
        </div>


        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">DAILY ROUTINE BUTAL FINAL SALES ORDER SUMMARY</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <div id="daily_routine_butal_proceed_to_final_summary_page"></div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        
        </div>


        <!-- /.card-footer-->
      </div>

     

      
    </section>
    <!-- /.content -->
 @endsection

 
@section('footer')
  @parent
<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  
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


  $("#daily_routine_butal_proceed_to_suggested_so").on('submit',(function(e){
        e.preventDefault();
        //$('.loading').show();
          $.ajax({
            url: "daily_routine_butal_proceed_to_suggested_so",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
               $('.loading').hide();
              $('#daily_routine_butal_proceed_to_suggested_so_page').html(data);

                // if(data != 'error'){
                //  Swal.fire({
                //     title: data,
                //     text: "Please send above code to agent",
                //     icon: 'success',
                //     showCancelButton: false,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'Yes, i will send it!'
                //   }).then((result) => {
                //     if (result.value) {
                //       Swal.fire(
                //         'Success',
                //         'Reloading Page',
                //         'success'
                //       )
                //       location.reload();
                //       $('.loading').hide();
                //     }
                //   })
                  
                // }else{
                //   Swal.fire(
                //   'Something went wrong!',
                //   'Redo process or contact system administrator',
                //   'error'
                //   )
                //   $('.loading').hide();
                // }
            },
      });
    }));


</script>
</body>
</html>
@endsection
























