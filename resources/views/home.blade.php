 @extends('layouts.master')

 @section('title', 'Customer')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">DASHBOARD</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          
        </div>
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
  
  $("#location_id" ).change(function() {
     var location_id = $(this).val(); 
     // $('.loading').show();       
      $.post({
      type: "POST",
      url: "/customer_show_location_details",
      data: 'location_id=' + location_id,
      success: function(data){

      console.log(data);
      // $('.loading').hide();
      $('#customer_show_location_details').html(data);

      },
      error: function(error){
        console.log(error);
      }
    });
  });


  $("#customer_save").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "customer_save",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
                if(data != 'error'){
                 Swal.fire({
                    title: data,
                    text: "Please send above code to agent",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, i will send it!'
                  }).then((result) => {
                    if (result.value) {
                      Swal.fire(
                        'Success',
                        'Reloading Page',
                        'success'
                      )
                      location.reload();
                      $('.loading').hide();
                    }
                  })
                  
                }else{
                  Swal.fire(
                  'Something went wrong!',
                  'Redo process or contact system administrator',
                  'error'
                  )
                  $('.loading').hide();
                }
            },
      });
    }));


</script>
</body>
</html>
@endsection
























