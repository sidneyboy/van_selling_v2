 @extends('layouts.master')

 @section('title', 'INVENTORY DATA')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">SKU INVENTORY DATA</h3>
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
                  <th>Sku Code</th>
                  <th>Description</th>
                  <th>Principal</th>
                  <th>Sku Type</th>
                  <th>Quantity</th>
                </tr>
              </thead>
              <tbody>
                @if($sku_counter != 0)
                  @foreach($sku_inventory as $data)
                    <tr>
                      <td>{{ $data->sku_code }}</td>
                      <td>{{ $data->description }}</td>
                      <td>{{ $data->principal->principal }}</td>
                      <td>{{ $data->sku_type }}</td>
                      <td>{{ $data->running_balance }}</td>
                    </tr>
                  @endforeach
                @else

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



  // $("#sku_inventory_upload").on('submit',(function(e){
  //       e.preventDefault();
  //       $('.loading').show();
  //         $.ajax({
  //           url: "sku_inventory_upload",
  //           type: "POST",
  //           data:  new FormData(this),
  //           contentType: false,
  //           cache: false,
  //           processData:false,
  //           success: function(data){
  //             console.log(data);
  //               if (data == 'saved') {
  //                 Swal.fire({
  //                   position: 'top-end',
  //                   icon: 'success',
  //                   title: 'New Sku Inventory Uploaded',
  //                   showConfirmButton: false,
  //                   timer: 1500
  //                 })
  //                 window.location.href = "/sku_inventory_data";
  //               }else{
  //                 Swal.fire(
  //                   'Something went wrong',
  //                   data,
  //                   'error'
  //                 )
  //                  $('.loading').hide();
  //               }
  //           },
  //     });
  //   }));


</script>
</body>
</html>
@endsection
























