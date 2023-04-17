 @extends('layouts.master')

 @section('title', 'DAILY BO')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">DAILY ROUTINE BO</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="bad_order_proceed">
            @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>SELECT PRINCIPAL:</label>
                <select class="form-conrol select2" style="width:100%;" id="principal_id" name="principal_id"  required>
                  <option value="" default>SELECT</option>
                  @foreach($principal as $data)
                  <option value="{{ $data->id }}">{{ $data->principal }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>SELECT CUSTOMER:</label>
                <select class="form-conrol select2" style="width:100%;" id="customer" name="customer"  required>
                  <option value="" default>SELECT</option>
                  @foreach($customer as $data)
                  <option value="{{ $data->id }}">{{ $data->store_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>



            <div class="col-md-12">
              <div id="bad_order_show_dr_page"></div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn btn-info btn-block">PROCEED TO BO FINAL SUMMARY</button>
              </div>
            </div>
          </div>
         </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
         <div id="bad_order_proceed_page"></div>
        </div>


        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

        <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">DAILY ROUTINE BO FINAL SUMMARY</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div id="bad_order_proceed_to_final_summary_page"></div>
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
  $('.select2').select2()
 $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $("#customer" ).change(function() {
     var customer = $(this).val(); 
     //$('.loading').show();       
      $.post({
      type: "POST",
      url: "/bad_order_show_dr",
      data: 'customer=' + customer,
      success: function(data){

      //console.log(data);
      $('.loading').hide();
      $('#bad_order_show_dr_page').html(data);

      },
      error: function(error){
        console.log(error);
      }
    });
  });

   $("#bad_order_proceed").on('submit',(function(e){
        e.preventDefault();
        //$('.loading').show();
          $.ajax({
            url: "bad_order_proceed",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
              $('#bad_order_proceed_page').html(data);
              $('.loading').hide();
            },
      });
    }));


</script>
</body>
</html>
@endsection
























