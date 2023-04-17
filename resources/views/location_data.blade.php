 @extends('layouts.master')

 @section('title', 'LOCATION DATA')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">LOCATION DATA</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
         <div class="table table-responsive">
           <table class="table table-bordered table-hover" id="example2">
             <thead>
               <tr>
                 <th>Location</th>
                 <th>Uploaded</th>
               </tr>
             </thead>
             <tbody>
                @if($location_counter != 0)
                   @foreach($location as $data)
                    <tr>
                      <td>{{ $data->location }}</td>
                      <td>{{ $data->created_at }}</td>
                    </tr>
                   @endforeach
                @else
                  <tr>
                    <td colspan="2" style="color:red;text-align: center;">NO DATA FOUND</td>
                  </tr>
                @endif
             </tbody>
           </table>
         </div>
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

  // $("#location_upload").on('submit',(function(e){
  //       e.preventDefault();
  //       $('.loading').show();
  //         $.ajax({
  //           url: "location_upload",
  //           type: "POST",
  //           data:  new FormData(this),
  //           contentType: false,
  //           cache: false,
  //           processData:false,
  //           success: function(data){
  //             console.log(data);
  //             if (data == 'saved') {
  //               Swal.fire({
  //                 position: 'top-end',
  //                 icon: 'success',
  //                 title: 'Location Data Uploaded',
  //                 showConfirmButton: false,
  //                 timer: 1500
  //               })

  //               // location.reload();
  //               window.location.href = "/location_data";
  //             }else{
  //               Swal.fire(
  //                 'Something went wrong!',
  //                 data,
  //                 'error'
  //               )
  //                $('.loading').hide();
  //             }
  //           },
  //     });
  //   }));


</script>
</body>
</html>
@endsection
























