 @extends('layouts.master')

 @section('title', 'DAILY ROUTINE')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">DAILY ROUTINE INVENTORY <span style="color:blue;">(CASE)</span></h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="daily_routine_proceed">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Location</label>
                  <select class="form-control select2" name="location" style="width:100%;" required>
                    <option value="" default>SELECT</option>
                    @foreach($location as $location_data)
                      <option value="{{ $location_data->id }}">{{ $location_data->location }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-info btn-block">PROCEED</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div id="daily_routine_proceed_page"></div>
        </div>


        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">CUSTOMER INVENTORY <span style="color:blue;">(CASE)</span></h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div id="daily_routine_proceed_to_inventory_page"></div>
        </div>
        
        <div class="card-footer">
          <div id="daily_routine_proceed_to_final_summary_page"></div>
        </div>
        <!-- /.card-footer-->
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">FINAL SALES ORDER SUMMARY <span style="color:blue;">(CASE)</span></h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div id="daily_routine_proceed_to_final_page"></div>
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
  
  


  $("#daily_routine_proceed").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "daily_routine_proceed",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
               $('.loading').hide();
              $('#daily_routine_proceed_page').html(data);

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
























