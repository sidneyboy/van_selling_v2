 @extends('layouts.master')

 @section('title', 'UPLOAD PRINCIPAL')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">UPLOAD PRINCIPAL</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="principal_upload">
            <div class="form-group">
              <label for="exampleInputFile">File input</label>
              <input type="file" name="agent_csv_file" required class="form-control">
            </div>
             <div class="form-group">
              
              <button type="submit" class="btn btn-success btn-block">SUBMIT NEW LOCATION</button>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          {{--  <div class="table table-responsive">
             <table class="table table-bordered table-hover" id="example2">
               <thead>
                 <tr>
                   <th>ID</th>
                   <th>Principal</th>
                 </tr>
               </thead>
               <tbody>
                 @if($principal_counter != 0)
                  @foreach($principal as $data)
                     <tr>
                      <td>{{ $data->id }}</td>
                      <td>{{ $data->principal }}</td>
                    
                    </tr>
                  @endforeach
                 @else  
                  <tr>
                    <td colspan="5" style="font-weight: bold;text-align: center;color:red;">NO DATA</td>
                  </tr>
                 @endif
               </tbody>
             </table>
          </div> --}}
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


  $("#principal_upload").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "principal_upload",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
              if (data == 'saved') {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Principal Data Uploaded',
                  showConfirmButton: false,
                  timer: 1500
                })

                window.location.href = "/van_selling_upload";
              }else{
                Swal.fire(
                  'Something went wrong!',
                  data,
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
























