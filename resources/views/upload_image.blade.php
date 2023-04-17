 @extends('layouts.master')

 @section('title', 'UPLOAD DEPOSIT SLIP / CHECK')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">UPLOAD DEPOSIT SLIP / CHECK</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
             @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
               
                    <select class="form-control select2" required name="customer_id">
                      <option value="" default>SELECT CUSTOMER</option>
                      @foreach($customer as $data)
                        <option value="{{ $data->id }}">{{ $data->store_name }}</option>
                      @endforeach
                    </select>
                 
                </div>

                <div class="form-group">
                  <img id="blah" src="{{ asset('/adminLte/default_image.jpg') }}" style="width:100%;border-radius: 1px 1px 0px 0px;" alt="your image" class="img img-thumbnail"/>
                  <input type='file' name="image" class="form-control" onchange="readURL(this);" required/>
                  
                 
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success btn-block">UPLOAD DEPOSIT SLIP/CHECK</button>
                </div>
              </div>
            </div>
              
          </form>

          <div class="row">
            <div class="col-md-12">
              <div class="table table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Customer</th>
                      <th>Image</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($collection_image as $data)
                      <tr>
                        <td>{{ $data->customer->store_name }}</td>
                        <td>
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $data->id }}">
                            VIEW IMAGE
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                   <img src="{{  asset('/images/'. $data->image) }}" style="width:100%;">
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary">Save changes</button>
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

   function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

</script>

</body>
</html>
@endsection
























