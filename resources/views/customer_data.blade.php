 @extends('layouts.master')

 @section('title', 'CUSTOMER DATA')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">CUSTOMER LIST & PROFILE</h3>
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
                  <th>Store Code</th>
                  <th>Store Name</th>
                  <th>Detailed Location</th>
                  
                  <th>Uploaded at</th>
                  <th>Price Level</th>
                </tr>
              </thead>
              <tbody>
                @foreach($customer as $data)
                  <tr>
                    <td>{{ $data->location->location }}</td>
                    <td style="text-align: center;">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $data->id }}">
                        VIEW STORE CODE PER PRINCIPAL
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">CUSTOMER PRINCIPAL CODE DETAILS</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <th>PRINCIPAL</th>
                                      <th>STORE CODE</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($data->customer_principal_code as $store_code)
                                      <tr>
                                        <td>{{ $store_code->principal->principal }}</td>
                                        <td>{{ $store_code->store_code }}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>{{ $data->store_name }}</td>
                    <td>{{ $data->detailed_location }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td style="text-align: center">
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2{{ $data->id }}">
                        VIEW PRICE LEVEL PER PRINCIPAL
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal2{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">CUSTOMER PRICE LEVEL</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <th>PRINCIPAL</th>
                                      <th>PRICE LEVEL</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($data->customer_principal_price as $store_price)
                                      <tr>
                                        <td>{{ $store_price->principal->principal }}</td>
                                        <td style="text-transform: uppercase;">{{ $store_price->price_level }}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
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


  // $("#customer_upload").on('submit',(function(e){
  //       e.preventDefault();
  //       $('.loading').show();
  //         $.ajax({
  //           url: "customer_upload",
  //           type: "POST",
  //           data:  new FormData(this),
  //           contentType: false,
  //           cache: false,
  //           processData:false,
  //           success: function(data){
  //             console.log(data);
  //                 if (data == 'saved') {
  //                 Swal.fire({
  //                   position: 'top-end',
  //                   icon: 'success',
  //                   title: 'New customers uploaded',
  //                   showConfirmButton: false,
  //                   timer: 1500
  //                 })
  //                 location.reload();
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
























