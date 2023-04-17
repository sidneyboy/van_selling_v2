@extends('layouts.master')
@section('title', 'Agent - Customer')
@section('navbar')
@section('sidebar')
@section('content')

<br />
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="font-weight: bold;">APPLIED CUSTOMER TO CUSTOMER</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      <form id="agent_applied_customer_upload">
        <div class="form-group">
          <label for="exampleInputFile">File input</label>
          <input type="file" name="agent_csv_file" required class="form-control">
        </div>
        <div class="form-group">
          
          <button type="submit" class="btn btn-success btn-block">UPDATED INVENTORY</button>
        </div>
      </form>
      <!-- /.card-body -->
      <div class="card-footer">
        
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
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
  
  // $("#location_id" ).change(function() {
  //    var location_id = $(this).val(); 
  //    // $('.loading').show();       
  //     $.post({
  //     type: "POST",
  //     url: "/customer_show_location_details",
  //     data: 'location_id=' + location_id,
  //     success: function(data){

  //     console.log(data);
  //     // $('.loading').hide();
  //     $('#customer_show_location_details').html(data);

  //     },
  //     error: function(error){
  //       console.log(error);
  //     }
  //   });
  // });


  $("#agent_applied_customer_upload").on('submit',(function(e){
        e.preventDefault();
        //$('.loading').show();
          $.ajax({
            url: "agent_applied_customer_upload",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
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
























